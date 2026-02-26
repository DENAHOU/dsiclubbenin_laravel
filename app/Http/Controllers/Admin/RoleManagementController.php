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
    {
        $users = User::orderBy('created_at', 'desc')->get();
        
        return view('admin.roles.index', compact('users'));
    }

    /**
     * Met à jour le rôle d'un utilisateur
     */
    public function updateRole(Request $request, $userId): JsonResponse
    {
        $request->validate([
            'role' => ['required', 'in:membre,admin,tresor,company,college,administration,candidat,recruter,partner,esn']
        ]);

        $user = User::findOrFail($userId);
        $oldRole = $user->role;
        $newRole = $request->role;

        DB::beginTransaction();
        try {
            // Mettre à jour le rôle
            $user->update(['role' => $newRole]);

            // Si le rôle passe à admin, s'assurer que l'utilisateur est approuvé et payé
            if ($newRole === 'admin') {
                $user->update([
                    'status' => 'approved',
                    'is_paid' => 1
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Le rôle de {$user->name} a été changé de '{$oldRole}' à '{$newRole}'",
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'status' => $user->status,
                    'is_paid' => $user->is_paid
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du rôle: ' . $e->getMessage()
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
