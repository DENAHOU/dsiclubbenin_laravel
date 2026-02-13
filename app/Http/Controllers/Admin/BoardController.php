<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardMember;
use App\Models\BoardRole;
use App\Models\User;
use App\Models\Company;
use App\Models\Administration;
use App\Models\College;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /* ======================
       LISTE DU BUREAU
    =======================*/
    public function index()
    {
        $members = BoardMember::with('role')->get();
        return view('board.index', compact('members'));
    }

    /* ======================
       FORMULAIRE GLOBAL
    =======================*/
    public function create()
    {
        return view('board.create', [
            'roles' => BoardRole::all(),
            'users' => User::all(),
            'companies' => Company::all(),
            'administrations' => Administration::all(),
            'colleges' => College::all(),
        ]);
    }

    /* ======================
       FORMULAIRE DEPUIS UN MEMBRE
    =======================*/
    public function addFromMember($type, $id)
    {
        $roles = BoardRole::orderBy('priority')->get();
        return view('board.add', compact('type', 'id', 'roles'));
    }

    /* ======================
       ENREGISTRER AU BUREAU
    =======================*/
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'member_type' => 'required',
            'member_id' => 'required',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $data = [
            'role_id' => $request->role_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        if ($request->member_type == 'user') $data['user_id'] = $request->member_id;
        if ($request->member_type == 'company') $data['company_id'] = $request->member_id;
        if ($request->member_type == 'administration') $data['administration_id'] = $request->member_id;
        if ($request->member_type == 'college') $data['college_id'] = $request->member_id;

        BoardMember::create($data);

        return redirect()->route('admin.board.index')->with('success', 'Membre ajouté au bureau');
    }


    // Voir le membre du bureau
    public function show($id)
    {
        $boardMember = BoardMember::with('role')->findOrFail($id);
        return view('board.show', compact('boardMember'));
    }

    /* ======================
       MODIFIER LE MEMBRE DU BUREAU
    =======================*/
    public function edit($id)
    {
        $board = BoardMember::findOrFail($id);
        $roles = BoardRole::all();

        return view('board.edit', compact('board', 'roles'));
    }

    /* ======================
       METTRE À JOUR LE MEMBRE DU BUREAU
    =======================*/
    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $board = BoardMember::findOrFail($id);
        $board->update($request->only('role_id','start_date','end_date'));

        return redirect()->route('admin.board.index')
            ->with('success','Mandat mis à jour');
    }

     /* ======================
        DISCOURS
    =======================*/
    public function speech($id)
    {
        $boardMember = BoardMember::findOrFail($id);
        return view('board.speech', compact('boardMember'));
    }

    public function storeSpeech(Request $request, $id)
    {
        $request->validate([
            'speech' => 'nullable|string'
        ]);

        $boardMember = BoardMember::findOrFail($id);
        $boardMember->speech = $request->speech;
        $boardMember->save();

        return redirect()
            ->route('admin.board.index')
            ->with('success', 'Discours enregistré avec succès');
    }


    /* ======================
       SUPPRIMER DU BUREAU
    =======================*/
    public function destroy($id)
    {
        BoardMember::findOrFail($id)->delete();
        return back()->with('success', 'Membre retiré du bureau');
    }
}
