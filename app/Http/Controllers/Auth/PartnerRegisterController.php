<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Pour le hachage manuel si vous ne voulez pas utiliser $casts
use App\Models\PartnerType;
use App\Models\PartnerFormule;
use App\Mail\PartnerPendingMail;
use Illuminate\Support\Facades\Mail;


class PartnerRegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-partner', [
            'types' => PartnerType::all(),
            'formules' => PartnerFormule::all(),
        ]);
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'partner_type_id' => ['required', 'exists:partners_types,id'],
        'partner_formule_id' => ['required', 'exists:partner_formules,id'],

        'company_name' => ['required', 'string', 'max:255'],
        'domain' => ['required', 'string', 'max:255'],
        'specialty' => ['required', 'string', 'max:255'],
        'country' => ['required', 'string'],
        'address' => ['required', 'string'],
        'url' => ['required', 'url'],

        'name_responsability' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:partners,email'],
        'phone' => ['required', 'string', 'max:20'],
        'medias' => ['required', 'image', 'max:2048'],

        'password' => ['required', 'confirmed', 'min:8'],
        'reason_motivation' => ['required', 'string'],
        'cgv' => ['accepted'],
    ]);

    $logoPath = $request->file('medias')->store('partner_logos', 'public');

    Partner::create([
        'partner_type_id' => $validated['partner_type_id'],
        'partner_formule_id' => $validated['partner_formule_id'],

        'company_name' => $validated['company_name'],
        'domain' => $validated['domain'],
        'specialty' => $validated['specialty'],
        'country' => $validated['country'],
        'address' => $validated['address'],
        'website_url' => $validated['url'],

        'manager_name' => $validated['name_responsability'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'logo_path' => $logoPath,

        'password' => bcrypt($validated['password']),
        'motivation' => $validated['reason_motivation'],

        'status' => 'pending',
    ]);

    return redirect()->route('home')
        ->with('success', 'Votre inscription a bien été enregistrée. Nous vous contacterons par mail.');
}

}

