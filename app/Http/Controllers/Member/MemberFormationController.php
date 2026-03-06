<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberFormationController extends Controller
{
    /**
     * Affiche la liste de toutes les formations disponibles
     */
    public function index(): View
    {
        $formations = Formation::with('categoryFormation')
            ->orderBy('start_date', 'desc')
            ->get();

        return view('member.formations.index', compact('formations'));
    }

    /**
     * Affiche les détails d'une formation spécifique
     */
    public function show(Request $request, $id): View
    {
        $formation = Formation::with('categoryFormation')
            ->findOrFail($id);

        return view('member.formations.show', compact('formation'));
    }
}
