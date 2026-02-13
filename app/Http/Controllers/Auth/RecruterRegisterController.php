<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Recruter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RecruterRegisterController extends Controller
{
    public function create() 
    {
        return view('auth.register-recruter');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'secteur' => ['required', 'string'],
            'localisation' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:recruters,email'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Gérer l'upload du logo (optionnel)
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoName = time() . '_' . Str::random(10) . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->move(public_path('storage/recruter_logos'), $logoName);
            $logoPath = 'storage/recruter_logos/' . $logoName;
        }

        $recruter = Recruter::create([
            'company_name' => $validatedData['nom'],
            'sector' => $validatedData['secteur'],
            'location' => $validatedData['localisation'],
            'logo_path' => $logoPath,
            'manager_name' => $validatedData['username'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect('/')->with('success', 'Votre compte recruteur a été créé avec succès ! Vous pouvez maintenant vous connecter et explorer notre place de marché des talents.');
    }
}
