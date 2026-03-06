<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class RoleManagementController extends Controller
{
    /**
     * Affiche la liste des utilisateurs avec la gestion des rôles
     */
    public function index(): View

    //   ON AFFICHE CEUX DONT status=approved ET is_paid=1    
    {
        $users = User::where('status', 'approved')->where('is_paid', 1)->orderBy('created_at', 'desc')->get();
        
        return view('admin.roles.index', compact('users'));
    }

    /**
     * Met à jour le rôle d'un utilisateur
     */
    public function updateRole(Request $request, $userId): JsonResponse
    {
        $request->validate([
            'role' => ['required', 'in:membre,admin,tresor']
        ]);

        $user = User::findOrFail($userId);
        $newRole = $request->role;

        DB::beginTransaction();
        try {

            if ($newRole === 'admin') {
                $user->is_admin = 1;
            }

            if ($newRole === 'tresor') {
                $user->is_tresor = 1;
            }

            if ($newRole === 'membre') {
                $user->is_admin = 0;
                $user->is_tresor = 0;
            }

            $user->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Rôle supplémentaire mis à jour avec succès."
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Erreur : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Récupère le rôle actuel d'un utilisateur
     */
    public function getRole($userId): JsonResponse
    {
        $user = User::findOrFail($userId);
        
        return response()->json([
            'success' => true,
            'role' => $user->role,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status,
                'is_paid' => $user->is_paid
            ]
        ]);
    }

    /**
     * Recherche d'utilisateurs
     */
    public function search(Request $request): View
    {
        $query = $request->get('q', '');
        $roleFilter = $request->get('role', '');

        $users = User::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->when($roleFilter, function ($q) use ($roleFilter) {
                $q->where('role', $roleFilter);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.roles.index', compact('users'));
    }
}