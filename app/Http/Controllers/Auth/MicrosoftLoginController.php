<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MicrosoftLoginController extends Controller
{
    public function redirect(Request $request)
    {
            $request->session()->put('my_custom_state_check', 'redirect_ok');
        return Socialite::driver('microsoft')->redirect();

    }

    public function callback(Request $request)
    {
        Log::info('Session ID in callback:', ['session_id' => $request->session()->getId()]);
    if ($request->session()->has('my_custom_state_check')) {
        Log::info('Custom state check: OK', ['value' => $request->session()->get('my_custom_state_check')]);
    } else {
        Log::warning('Custom state check: FAILED - Session issue suspected.');
    }

        try {
            // Tente de récupérer les informations de l'utilisateur
            $microsoftUser = Socialite::driver('microsoft')->user();

            Log::info('Microsoft User data received:', (array) $microsoftUser);
            dd($microsoftUser); // <-- DÉCOMMENTEZ CETTE LIGNE POUR VOIR LES DONNÉES !

            // Le reste de votre logique...
            $user = User::where('microsoft_id', $microsoftUser->getId())->first();

            if (!$user) {
                $user = User::where('email', $microsoftUser->getEmail())->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $microsoftUser->getName(),
                        'email' => $microsoftUser->getEmail(),
                        'microsoft_id' => $microsoftUser->getId(),
                        'password' => encrypt($microsoftUser->getId()),
                        'email_verified_at' => now(),
                    ]);
                } else {
                    $user->microsoft_id = $microsoftUser->getId();
                    $user->save();
                }
            }

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            // ICI NOUS AVONS BESOIN DU MESSAGE D'ERREUR !
        Log::error('Microsoft SSO Callback Error: ' . $e->getMessage(), ['exception' => $e, 'session_has_state' => $request->session()->has('state')]);


        dd($e); // <-- CHANGEZ ICI 
            return redirect()->route('login.member')->withErrors(['email' => 'Impossible de se connecter avec Microsoft. Veuillez réessayer.']);
        }
    }
}