<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BoardMember;
use App\Models\Company;
use App\Models\College;
use App\Models\Administration;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class MembreController extends Controller
{
    public function espace(Request $request)
    {


      $boardMembers = BoardMember::with(['user', 'role', 'company', 'college', 'administration'])
        ->where('status', 'active')
        ->orderBy('role_id', 'asc')
        ->get();


        // Membres individuels : seulement ceux approuvés et role = membre
        $individualMembers = User::where('role', 'member')
            ->where('status', 'approved')
            ->where('is_paid', 1)
            ->orderBy('firstname', 'asc')
            ->simplePaginate(12);

        // Membres entreprises
        $companyMembers = Company::all();

        // Membres collège IT
        $collegeMembers = College::all();

        // Membres administration publique
        $adminMembers = Administration::all();

        // Optionnel : membres fondateurs si tu veux
        // $founders = User::where('type', 'fondateur')->get();

        // Retourner la vue en passant toutes les variables
        return view('membre.espace', compact(
            'boardMembers',
            'individualMembers',
            'companyMembers',
            'collegeMembers',
            'adminMembers',
        ));
    }
}

