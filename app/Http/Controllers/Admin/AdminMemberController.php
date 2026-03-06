<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Administration;
use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Admin;      // si présent
// use App\Models\Tresor;    // si présent
use Illuminate\Support\Facades\Hash;
use App\Mail\AdhesionRejected;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdhesionApproved;
use App\Mail\AdhesionPending;



class AdminMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,role:admin'); // PROTECT ADMIN
    }

    /**
     * Liste des membres (tous types)
     */
    public function index(Request $request)
    {
        $perPage = 15;
        $search = $request->query('search');
        $typeFilter = $request->query('type');

        // Users
        $users = User::select('id', 'name', 'email', 'created_at')
            ->where('status', 'approved')
            ->whereRaw('LOWER(TRIM(role)) = ?', ['member'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->get()
            ->map(fn($u) => [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'type' => 'Membre Individuel',
                'slug' => 'users',
                'created_at' => $u->created_at,
            ]);

        // Companies
        $companies = Company::select('id', 'name', 'email', 'created_at')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))
            ->get()
            ->map(fn($c) => [
                'id' => $c->id,
                'name' => $c->name,
                'email' => $c->email ?? '',
                'type' => 'Entité Utilisatrice',
                'slug' => 'companies',
                'created_at' => $c->created_at,
            ]);

        // Administrations
        $administrations = Administration::select('id', 'name', 'email', 'created_at')
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))
            ->get()
            ->map(fn($a) => [
                'id' => $a->id,
                'name' => $a->name,
                'email' => $a->email ?? '',
                'type' => 'Administration Publique',
                'slug' => 'administrations',
                'created_at' => $a->created_at,
            ]);

        // Colleges
        $colleges = College::select('id', 'company_name', 'email', 'created_at')
            ->when($search, fn($q) => $q->where('company_name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))
            ->get()
            ->map(fn($c) => [
                'id' => $c->id,
                'name' => $c->company_name,
                'email' => $c->email ?? '',
                'type' => 'Collège IT',
                'slug' => 'colleges',
                'created_at' => $c->created_at,
            ]);

        // Admins (optionnel)
        $admins = User::select('id', 'name', 'email', 'created_at')
            ->whereRaw('LOWER(TRIM(role)) = ?', ['admin'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->get()
            ->map(fn($a) => [
                'id' => $a->id,
                'name' => $a->name,
                'email' => $a->email ?? '',
                'type' => 'Administrateur',
                'slug' => 'admins',
                'created_at' => $a->created_at,
            ]);

        // Tresor
        $tresor = User::select('id', 'name', 'email', 'created_at')
            ->whereRaw('LOWER(TRIM(role)) = ?', ['tresor'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->get()
            ->map(fn($t) => [
                'id' => $t->id,
                'name' => $t->name,
                'email' => $t->email ?? '',
                'type' => 'Trésorerie',
                'slug' => 'tresor',
                'created_at' => $t->created_at,
            ]);


        // Concat tous
        $all = collect()
            ->concat($users)
            ->concat($companies)
            ->concat($administrations)
            ->concat($colleges)
            ->concat($admins)
            ->concat($tresor); // obligatoire

        // Filtrer par type
        if ($typeFilter) {
            $all = $all->filter(fn($item) => $item['slug'] === $typeFilter)->values();
        }

        // Tri DESC
        $all = $all->sortByDesc(fn($item) => $item['created_at'] ?? null)->values();

        // Pagination
        $page = max(1, (int) $request->query('page', 1));
        $sliced = $all->slice(($page - 1) * $perPage, $perPage)->values();
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $sliced,
            $all->count(),
            $perPage,
            $page,
            ['path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('admin.members.list', ['members' => $paginator]);
    }

    /**
     * Affiche le formulaire "Ajouter un membre"
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Enregistrer un nouveau membre (form admin)
     */
public function store(Request $request)
{
    $request->validate([
        'lastname' => 'required',
        'firstname' => 'required',
        'sexe' => 'required',
        'birthday' => 'required',
        'phone' => 'required',
        'medias_id' => 'required|image',
        'current_employer' => 'required',
        'employer_contact' => 'required',
        'current_position' => 'require_vb d',
        'sector' => 'required',
        'category_of_service' => 'required',
        'area_of_expertise' => 'required',
        'initial_training' => 'required',
        'username' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed',
        'type_members' => 'required'
    ]);

    $user = new User();
    $user->lastname = $request->lastname;
    $user->firstname = $request->firstname;
    $user->name = $request->lastname . ' ' . $request->firstname;
    $user->sexe = $request->sexe;
    $user->birthday = $request->birthday;
    $user->phone = $request->phone;

    // Photo
    if ($request->hasFile('medias_id')) {
        $path = $request->file('medias_id')->store('photos', 'public');
        $user->photo_path = $path;
    }

    // Pro
    $user->current_employer = $request->current_employer;
    $user->employer_contact = $request->employer_contact;
    $user->current_position = $request->current_position;
    $user->sector = $request->sector;
    $user->sector_other = $request->sector_other;
    $user->category_of_service = $request->category_of_service;
    $user->category_other = $request->category_other;
    $user->area_of_expertise = $request->area_of_expertise;
    $user->initial_training = $request->initial_training;
    $user->description = $request->description;

    // Compte
    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->type_members = $request->type_members;

    $user->status = 'approved'; // tu peux mettre pending
    $user->save();

    return redirect()->route('admin.members')->with('success', 'Membre créé avec succès.');
}


    /**
     * Afficher un membre
     */
    public function show($type, $id)
    {
        $model = $this->resolveModel($type);
        if (!$model) abort(404);

        $item = $model::findOrFail($id);

        // detecter si la route appelée est "view" (membre validé) ou "show" (adhésion pending)
        $mode = request()->routeIs('admin.members.view') ? 'view' : 'request';

        return view('admin.members.show', compact('item', 'type', 'mode'));
    }


    public function list(Request $request)
    {
        $search = $request->search;
        $type = $request->type;

        // BASE QUERY
        $users = User::select('id','firstname','lastname','email','created_at')
            ->when($search, fn($q)=>$q->where(function($x)use($search){
                $x->where('firstname','like',"%$search%")
                ->orWhere('lastname','like',"%$search%")
                ->orWhere('email','like',"%$search%");
            }))
            ->when($type=='user', fn($q)=>$q) // only filter users if type=user
            ->get()
 ->map(function($u){
    return [
        'id' => $u->id,
        'name' => $u->firstname.' '.$u->lastname,
        'email' => $u->email,
        'type' => 'Membre Individuel',
        'slug' => 'users',   // 🔥 AJOUT IMPORTANT
        'created_at' => $u->created_at
    ];
});


        // COMPANIES
        $companies = Company::select('id','name','email','created_at')
            ->when($search, fn($q)=>$q->where(function($x)use($search){
                $x->where('name','like',"%$search%")
                ->orWhere('email','like',"%$search%");
            }))
            ->when($type=='company', fn($q)=>$q)
            ->get()
->map(fn($c) => [
    'id' => $c->id,
    'name' => $c->name,
    'email' => $c->email,
    'type' => 'Entité Utilisatrice',
    'slug' => 'companies',  // 🔥 AJOUT
    'created_at' => $c->created_at
]);


        // ADMINISTRATION
        $administrations = Administration::select('id','name','email','created_at')
            ->when($search, fn($q)=>$q->where(function($x)use($search){
                $x->where('name','like',"%$search%")
                ->orWhere('email','like',"%$search%");
            }))
            ->when($type=='administration', fn($q)=>$q)
            ->get()
->map(fn($a) => [
    'id' => $a->id,
    'name' => $a->name,
    'email' => $a->email,
    'type' => 'Administration Publique',
    'slug' => 'administrations',  // 🔥 AJOUT
    'created_at' => $a->created_at
]);


            // COLLEGES
            $colleges = College::select('id','company_name','email','created_at')
            ->when($search, fn($q)=>$q->where(function($x)use($search){
                $x->where('company_name','like',"%$search%")
                ->orWhere('email','like',"%$search%");
            }))
            ->when($type=='college', fn($q)=>$q)
            ->get()
->map(fn($c) => [
    'id' => $c->id,
    'name' => $c->company_name,
    'email' => $c->email,
    'type' => 'College IT',
    'slug' => 'colleges',  // 🔥 AJOUT
    'created_at' => $c->created_at
]);


        // MERGE + SORT + PAGINATE
        $collection = $users->merge($companies)->merge($administrations)->merge($colleges)
            ->sortByDesc('created_at');

        // PAGINATION MANUELLE
        $page = request()->get('page', 1);
        $perPage = 15;
        $items = $collection->slice(($page - 1) * $perPage, $perPage);
        $members = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $page,
            ['path'=>route('admin.members.list')]
        );

        return view('admin.members.list', compact('members'));
    }




    public function rejected()
    {
        // On récupère les rejected pour chaque type
        $users = User::where('status', 'rejected')->get();
        $companies = Company::where('status', 'rejected')->get();
        $administrations = Administration::where('status', 'rejected')->get();
        $colleges = College::where('status', 'rejected')->get();

        // On normalise comme dans gatherPending()
        $items = collect();

        foreach ($users as $u) {
            $items->push([
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'type' => 'user',
                'created_at' => $u->created_at
            ]);
        }

        foreach ($companies as $c) {
            $items->push([
                'id' => $c->id,
                'name' => $c->name ?? $c->company_name,
                'email' => $c->email,
                'type' => 'company',
                'created_at' => $c->created_at
            ]);
        }

        foreach ($administrations as $a) {
            $items->push([
                'id' => $a->id,
                'name' => $a->name,
                'email' => $a->email,
                'type' => 'administration',
                'created_at' => $a->created_at
            ]);
        }

        foreach ($colleges as $c) {
            $items->push([
                'id' => $c->id,
                'name' => $c->company_name ?? $c->name,
                'email' => $c->email,
                'type' => 'college',
                'created_at' => $c->created_at
            ]);
        }

        // Trier les résultats par date
        $rejected = $items->sortByDesc('created_at');

        return view('admin.members.rejected', compact('rejected'));
    }

    /**
     * Approuver une adhésion
     */
    public function approve(Request $request, $type, $id)
    {
        $model = $this->resolveModel($type);
        if (!$model) {
            return response()->json(['error' => 'Type inconnu'], 400);
        }

        $item = $model::find($id);
        if (!$item) {
            return response()->json(['error' => 'Introuvable'], 404);
        }

        // Statut
        $item->status = 'approved';
        $item->save();

        // Envoi de mail
        try {
            Mail::to($item->email)->send(new AdhesionApproved($item));
            $mailSent = true;
        } catch (\Throwable $e) {
            \Log::error("Erreur mail Approved: " . $e->getMessage());
            $mailSent = false;
        }

        return response()->json([
            'success' => true,
            'message' => 'Adhésion approuvée.',
            'mail_sent' => $mailSent
        ]);
    }



    /**
     * Rejeter une adhésion
     */
    public function reject(Request $request, $type, $id)
    {
        $model = $this->resolveModel($type);
        if (!$model) return response()->json(['error' => 'Type inconnu'], 400);

        $item = $model::find($id);
        if (!$item) return response()->json(['error' => 'Introuvable'], 404);

        $item->status = 'rejected';
        $item->save();

        try {
            Mail::to($item->email)->send(new AdhesionRejected($item));
        } catch (\Throwable $e) {}

        return response()->json(['success' => true]);
    }


    /**
     * Bloquer un membre
     */
    public function block($type, $id)
    {
        $model = $this->resolveModel($type);
        $item = $model::findOrFail($id);

        $item->status = 'blocked';
        $item->save();

        return back()->with('success', 'Membre bloqué avec succès.');
    }


    /**
     * Supprimer un membre
     */
    public function delete($type, $id)
    {
        $model = $this->resolveModel($type);
        $item = $model::findOrFail($id);

        $item->delete();

        return back()->with('success', 'Membre supprimé.');
    }


    public function pending()
    {
        // USERS = Membre Individuel
        $users = User::where('status', 'pending')->get()->map(function($u){
            return [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'type' => 'membre individuel',
                'table' => 'users',
                'created_at' => $u->created_at
            ];
        });

        // COMPANIES = Entité Utilisatrice
        $companies = Company::where('status', 'pending')->get()->map(function($c){
            return [
                'id' => $c->id,
                'name' => $c->name,
                'email' => $c->email,
                'type' => 'entité utilisatrice',
                'table' => 'companies',
                'created_at' => $c->created_at
            ];
        });

        // ADMINISTRATIONS = Administration Publique
        $administrations = Administration::where('status', 'pending')->get()->map(function($a){
            return [
                'id' => $a->id,
                'name' => $a->name,
                'email' => $a->email,
                'type' => 'administration publique',
                'table' => 'administrations',
                'created_at' => $a->created_at
            ];
        });

        // COLLEGES = Collège IT
        $colleges = College::where('status', 'pending')->get()->map(function($c){
            return [
                'id' => $c->id,
                'name' => $c->company_name,
                'email' => $c->email,
                'type' => 'collège IT',
                'table' => 'colleges',
                'created_at' => $c->created_at
            ];
        });

        // MERGE ALL
        $pending = collect()
            ->merge($users)
            ->merge($companies)
            ->merge($administrations)
            ->merge($colleges)
            ->sortByDesc('created_at')
            ->values();

        return view('admin.members.pending', [
            'pendingTotal' => $pending->count(),
            'recentPending' => $pending
        ]);
    }


    /**
     * Convertit un type en modèle
     */
protected function resolveModel(string $type)
{
    return match ($type) {
        'user', 'users' => User::class,
        'company', 'companies' => Company::class,
        'administration', 'administrations' => Administration::class,
        'college', 'colleges' => College::class,
        'admin', 'admins' => \App\Models\Admin::class,
        default => null,
    };
}

}
