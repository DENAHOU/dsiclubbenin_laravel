<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('member.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('member.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'nullable',
            'birthday' => 'nullable|date',
            'current_position' => 'nullable',
            'current_employer' => 'nullable',
            'sector' => 'nullable',
            'area_of_expertise' => 'nullable',
            'description' => 'nullable',
        ]);

        $user->update($request->only([
            'firstname',
            'lastname',
            'phone',
            'birthday',
            'sexe',
            'current_position',
            'current_employer',
            'sector',
            'area_of_expertise',
            'initial_training',
            'category_of_service',
            'description'
        ]));

        return redirect()
            ->route('member.profile.show')
            ->with('success', 'Profil mis à jour avec succès');
    }
}
