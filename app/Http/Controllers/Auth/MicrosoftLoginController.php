<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MicrosoftLoginController extends Controller
{
    /**
     * Redirection vers Microsoft pour l'authentification
     * Le paramètre 'prompt=login' force Microsoft à afficher la page de login
     * même si l'utilisateur est déjà connecté (utile pour tester plusieurs comptes)
     */
    public function redirect(Request $request)
    {
        try {
            Log::info('Redirection vers Microsoft SSO');
            // 🔐 prompt=login force Microsoft à afficher la page login à chaque fois
            return Socialite::driver('microsoft')
                ->with(['prompt' => 'login'])
                ->redirect();
        } catch (\Exception $e) {
            Log::error('Erreur lors de la redirection Microsoft: ' . $e->getMessage());
            return redirect()->route('login')
                ->withErrors(['email' => 'Erreur lors de la redirection vers Microsoft']);
        }
    }

    /**
     * Callback après authentification Microsoft
     */
    public function callback(Request $request)
    {
        try {
            // Récupère les informations de l'utilisateur depuis Microsoft
            try {
                $microsoftUser = Socialite::driver('microsoft')->user();
            } catch (\Laravel\Socialite\Two\InvalidStateException $ise) {
                // Échec de la vérification d'état - essai stateless en secours
                Log::warning('InvalidStateException during Microsoft callback, retrying with stateless', ['message' => $ise->getMessage()]);
                $microsoftUser = Socialite::driver('microsoft')->stateless()->user();
            }

            Log::info('Utilisateur Microsoft authentifié', [
                'id' => $microsoftUser->getId(),
                'email' => $microsoftUser->getEmail(),
                'name' => $microsoftUser->getName()
            ]);

            // Cherche l'utilisateur par microsoft_id
            $user = User::where('microsoft_id', $microsoftUser->getId())->first();

            if (!$user) {
                // Cherche par email
                $user = User::where('email', $microsoftUser->getEmail())->first();

                if ($user) {
                    // L'utilisateur existe avec ce email, on lie son compte Microsoft
                    $user->microsoft_id = $microsoftUser->getId();
                    $user->save();
                    Log::info('Compte Microsoft lié à un utilisateur existant', ['user_id' => $user->id]);
                } else {
                        // Prépare email et username (username requis dans la table)
                        $email = $microsoftUser->getEmail();
                        $baseUsername = $email ? explode('@', $email)[0] : Str::slug($microsoftUser->getName());
                        $username = $baseUsername;
                        $i = 1;
                        while (User::where('username', $username)->exists()) {
                            $username = $baseUsername . $i;
                            $i++;
                        }

                        // Crée un nouvel utilisateur
                        $user = User::create([
                            'name' => $microsoftUser->getName(),
                            'email' => $email,
                            'username' => $username,
                            'microsoft_id' => $microsoftUser->getId(),
                            'password' => Hash::make(Str::random(40)),
                            'email_verified_at' => now(),
                        ]);
                    Log::info('Nouvel utilisateur créé via Microsoft SSO', ['user_id' => $user->id]);
                }
            }

            // Connecte l'utilisateur
            Auth::login($user, remember: true);
            Log::info('Utilisateur connecté avec succès', ['user_id' => $user->id]);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            Log::error('Erreur lors du callback Microsoft SSO', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Cas fréquent: application restreinte au tenant (locataire unique)
            $msg = 'Impossible de se connecter avec Microsoft. Veuillez réessayer.';

            $lower = strtolower($e->getMessage());
            if (str_contains($lower, 'unauthorized_client') || str_contains($lower, 'not enabled for consumers') || str_contains($lower, 'client does not exist')) {
                $msg = 'Connexion Microsoft non autorisée : utilisez un compte @clubdsibenin.org (compte organisationnel). Si le problème persiste, contactez l\'administrateur.';
            }

            return redirect()->route('login')
                ->withErrors(['email' => $msg]);
        }
    }
}
