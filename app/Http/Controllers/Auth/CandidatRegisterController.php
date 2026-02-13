<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
// Pour l'instant, on ne connecte pas le candidat, donc pas besoin de Auth

class CandidatRegisterController extends Controller
{
    /**
     * Affiche la vue du formulaire d'inscription.
     */
    public function create()
    {
        return view('auth.register-candidat');
    }

    /**
     * SIMULATION : Analyse le CV et renvoie les données extraites.
     * Dans un vrai projet, cette méthode appellerait une API de parsing.
     */
    public function parseCv(Request $request)
    {
        $request->validate(['cv_file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120']]);

        // Simulation de l'appel à une IA de parsing de CV
        // Dans un vrai projet, vous enverriez $request->file('cv_file') à une API
        // et elle vous retournerait un JSON comme celui-ci.
        $extractedData = [
            'name' => 'John Doe (depuis CV)',
            'email' => 'john.doe.cv@example.com',
            'current_position' => 'Développeur Full-Stack Senior',
            'skills' => ['Laravel', 'PHP', 'Vue.js', 'MySQL', 'API REST', 'Docker'],
            'experiences' => [
                ['poste' => 'Développeur Senior', 'entreprise' => 'Tech Corp', 'duree' => '2020-2024'],
                ['poste' => 'Développeur Junior', 'entreprise' => 'Web Startup', 'duree' => '2018-2020'],
            ],
            'education' => [
                ['diplome' => 'Master en Informatique', 'ecole' => 'Université de Cotonou'],
            ]
        ];

        // On stocke aussi le CV pour l'utiliser à la fin
        $cvPath = $request->file('cv_file')->store('candidat_cvs', 'public');
        session(['cv_path_temp' => $cvPath]);

        return response()->json($extractedData);
    }


    /**
     * Traite l'inscription finale du candidat.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:candidats,email'],
            'phone' => ['required', 'string', 'max:20'],
            'current_position' => ['required', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'string', 'url'],
            'cv_file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Gérer l'upload du CV
        $cvPath = null;
        if ($request->hasFile('cv_file')) {
            $cvFile = $request->file('cv_file');
            $cvName = time() . '_' . Str::random(10) . '.' . $cvFile->getClientOriginalExtension();
            $cvFile->move(public_path('storage/cvs'), $cvName);
            $cvPath = 'storage/cvs/' . $cvName;
        }

        $candidat = Candidat::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'current_position' => $request->current_position,
            'linkedin_url' => $request->linkedin_url,
            'cv_path' => $cvPath,
            'password' => $request->password, // Le cast dans le modèle s'occupe du hash
        ]);

        event(new Registered($candidat));

        return redirect()->route('home')->with('success', 'Votre profil a été créé avec succès ! Vous pouvez maintenant vous connecter à votre espace candidat.');
    }
}
