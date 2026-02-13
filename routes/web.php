<?php

// --- 1. Imports nettoyés et organisés ---
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController; // Assurez-vous d'avoir créé ce contrôleur
use App\Http\Controllers\PageController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\DSIStoriesController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\Auth\MicrosoftLoginController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; // Assurez-vous d'importer votre modèle User
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Pour le débogage
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\CollegeDashboardController;
use App\Http\Controllers\AdministrationDashboardController;
use App\Http\Controllers\EsnDashboardController;
use App\Http\Controllers\EsnProfileController;
use App\Http\Controllers\PartnerDashboardController; // Créez ce contrôleur
use App\Http\Controllers\PartnerProfileController;   // Créez ce contrôleur
use App\Http\Controllers\PartnerDocumentController;  // Créez ce contrôleur
use App\Http\Controllers\NexusDSIController;
use App\Http\Controllers\ComingSoonController;
use app\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Member\FormationController;
// === Admin Dashboard & actions ===
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMemberController;
use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Member\CotisationController;
use App\Http\Controllers\Member\NotificationController;
use App\Http\Controllers\Member\AnnuaireController;
use App\Http\Controllers\MembershipPaymentController;
use App\Http\Controllers\Admin\AdminPartnerController;
use App\Http\Controllers\Admin\AdminPartnerTypeController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FormationController as AdminFormationController;
use App\Http\Controllers\Shared\SharedResourceController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| C'est ici que vous enregistrez les routes pour votre application.
| Ces routes sont chargées par le RouteServiceProvider et toutes
| seront assignées au groupe de middleware "web".
|
*/

// --- Route d'accueil unique, propre et nommée ---
    Route::get('/', function () {
        return view('welcome'); // Affiche bien votre fichier welcome.blade.php
})->name('home'); // On lui donne le nom 'home'
// --- Routes pour les pages publiques ---
Route::prefix('club')->name('club.')->group(function () {
    Route::get('/qui-sommes-nous', [ClubController::class, 'about'])->name('about');
    Route::get('/programme-thematique', [ClubController::class, 'programme'])->name('programme');
    Route::get('/evenements', [ClubController::class, 'events'])->name('events');
    Route::get('/partenaires', [ClubController::class, 'partners'])->name('partners');
});

Route::prefix('activites')->name('activites.')->group(function () {
    Route::get('/evenements-actualites', [ActiviteController::class, 'evenements'])->name('evenements');
    Route::get('/formations', [ActiviteController::class, 'formations'])->name('formations');
});

Route::prefix('dsi-stories')->name('dsistories.')->group(function () {
    Route::get('/temoignages', [DSIStoriesController::class, 'temoignages'])->name('temoignages');
    Route::get('/interviews', [DSIStoriesController::class, 'interviews'])->name('interviews');
});

Route::get('/recrutement', [PageController::class, 'recrutement'])->name('recrutement');
Route::get('/esn', [PageController::class, 'esn'])->name('esn');
Route::get('/membres', [MembreController::class, 'espace'])->name('membre.espace'); // C'est la page publique "Trombinoscope"


// La route du dashboard fournie par Breeze est modifiée ici
Route::middleware(['check.payment'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Profil membre (users)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/profile', [UserProfileController::class, 'show'])->name('member.profile.show');
    Route::get('/dashboard/profile/edit', [UserProfileController::class, 'edit'])->name('member.profile.edit');
    Route::post('/dashboard/profile/update', [UserProfileController::class, 'update'])->name('member.profile.update');
});

Route::middleware(['auth'])->prefix('member')->name('member.')->group(function () {

    Route::prefix('cotisations')->name('cotisations.')->group(function () {
        Route::get('/payer', [CotisationController::class, 'pay'])->name('pay');
        Route::post('/confirmer', [CotisationController::class, 'confirm'])->name('confirm');
        Route::post('/process', [CotisationController::class, 'process'])->name('process');
        Route::get('/historique', [CotisationController::class, 'history'])->name('history');

        // ✅ CORRECTION ICI
        Route::get('/invoice', [CotisationController::class, 'invoice'])->name('invoice');

        // ✅ NOUVELLE ROUTE POUR TÉLÉCHARGER LA FACTURE PAR MAIL
        Route::get('/invoice/{invoice}/download', [CotisationController::class, 'downloadInvoice'])->name('invoice.download');

        // ✅ ROUTE DE SUCCESS APRÈS PAIEMENT
        Route::post('/success',[CotisationController::class, 'paymentSuccess'])->name('success');
    });

    // ✅ CALLBACK KKIA PAY
    Route::get('/kkiapay/notify', [CotisationController::class, 'notify'])
        ->name('cotisations.notify');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications');

    // Routes pour les formations
    Route::prefix('formations')->name('formations.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Member\MemberFormationController::class, 'index'])->name('index');
        Route::get('/{formation}', [\App\Http\Controllers\Member\MemberFormationController::class, 'show'])->name('show');
    });

    // Routes pour les annuaires
    Route::prefix('annuaire')->name('annuaire.')->group(function () {
        Route::get('/membres', [AnnuaireController::class, 'membres'])->name('membres');
        Route::get('/partenaires', [AnnuaireController::class, 'partenaires'])->name('partenaires');
    });
});


// Routes pour l'authentification Microsoft
Route::middleware('web')->group(function () {
    Route::get('/auth/microsoft/redirect', [App\Http\Controllers\Auth\MicrosoftLoginController::class, 'redirect'])->name('login.microsoft.redirect');
    Route::get('/auth/microsoft/callback', [App\Http\Controllers\Auth\MicrosoftLoginController::class, 'callback']);
});


// GROUPE DE ROUTES POUR LES ENTREPRISES (COMPANY)
Route::middleware(['auth:company', 'check.payment'])->prefix('company')->name('company.')->group(function () {
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');
        Route::get('/{company}/profil', [CompanyDashboardController::class, 'show'])->name('profil');
        Route::get('/{company}/edit', [CompanyDashboardController::class, 'edit'])->name('edit');
        Route::put('/{company}', [CompanyDashboardController::class, 'update'])->name('update');
        Route::get('/{company}/settings', [CompanyDashboardController::class, 'settings'])->name('settings');
        Route::put('/{company}/update-password', [CompanyDashboardController::class, 'updatePassword'])->name('update-password');
        Route::delete('/{company}/delete-account', [CompanyDashboardController::class, 'deleteAccount'])->name('delete-account');

        // Routes partagées - Dashboard unifié
        Route::get('/unified-dashboard', [SharedResourceController::class, 'dashboard'])->name('unified.dashboard');
        Route::get('/formations', [SharedResourceController::class, 'formations'])->name('formations');
        Route::get('/formations/{id}', [SharedResourceController::class, 'showFormation'])->name('formations.show');
        Route::get('/annuaire/membres', [SharedResourceController::class, 'annuaireMembres'])->name('annuaire.membres');
        Route::get('/annuaire/partenaires', [SharedResourceController::class, 'annuairePartenaires'])->name('annuaire.partenaires');
});


// GROUPE DE ROUTES POUR LES COLLÈGES (COLLEGE)
Route::middleware(['auth:college', 'check.payment'])->prefix('college')->name('college.')->group(function () {
    Route::get('/dashboard', [CollegeDashboardController::class, 'index'])->name('dashboard');
    Route::get('/{college}/profil', [CollegeDashboardController::class, 'show'])->name('profil');
    Route::get('/{college}/edit', [CollegeDashboardController::class, 'edit'])->name('edit');
    Route::put('/{college}', [CollegeDashboardController::class, 'update'])->name('update');
    Route::get('/{college}/settings', [CollegeDashboardController::class, 'settings'])->name('settings');
    Route::put('/{college}/update-password', [CollegeDashboardController::class, 'updatePassword'])->name('update-password');
    Route::delete('/{college}/delete-account', [CollegeDashboardController::class, 'deleteAccount'])->name('delete-account');

    // Routes partagées - Dashboard unifié
    Route::get('/unified-dashboard', [SharedResourceController::class, 'dashboard'])->name('unified.dashboard');
    Route::get('/formations', [SharedResourceController::class, 'formations'])->name('formations');
    Route::get('/formations/{id}', [SharedResourceController::class, 'showFormation'])->name('formations.show');
    Route::get('/annuaire/membres', [SharedResourceController::class, 'annuaireMembres'])->name('annuaire.membres');
    Route::get('/annuaire/partenaires', [SharedResourceController::class, 'annuairePartenaires'])->name('annuaire.partenaires');
});

// GROUPE DE ROUTES POUR LES ADMINISTRATION PUBLIQUES (ADMINISTRATION)
Route::middleware(['auth:administration'])
    ->prefix('administration')
    ->name('administration.')
    ->group(function () {
        Route::get('/dahbord', [AdministrationDashboardController::class, 'index'])
            ->name('dahbord');
        Route::get('/{administration}/profil', [AdministrationDashboardController::class, 'show'])
            ->name('profil');
        Route::get('/{administration}/edit', [AdministrationDashboardController::class, 'edit'])
            ->name('edit');
        Route::put('/{administration}', [AdministrationDashboardController::class, 'update'])
            ->name('update');
        Route::get('/{administration}/settings', [AdministrationDashboardController::class, 'settings'])
            ->name('settings');
        Route::put('/{administration}/update-password', [AdministrationDashboardController::class, 'updatePassword'])
            ->name('update-password');
        Route::delete('/{administration}/delete-account', [AdministrationDashboardController::class, 'deleteAccount'])
            ->name('delete-account');

        // Routes partagées - Dashboard unifié
        Route::get('/unified-dashboard', [SharedResourceController::class, 'dashboard'])->name('unified.dashboard');
        Route::get('/formations', [SharedResourceController::class, 'formations'])->name('formations');
        Route::get('/formations/{id}', [SharedResourceController::class, 'showFormation'])->name('formations.show');
        Route::get('/annuaire/membres', [SharedResourceController::class, 'annuaireMembres'])->name('annuaire.membres');
        Route::get('/annuaire/partenaires', [SharedResourceController::class, 'annuairePartenaires'])->name('annuaire.partenaires');
    });

// Route pour la page de paiement de cotisation DES ENTREPRISES, COLLÈGES ET ADMINISTRATIONS
Route::get('/cotisation', [MembershipPaymentController::class, 'pay'])->name('membership.pay');

Route::middleware(['auth:company,administration,college'])->post('/cotisation/process', [MembershipPaymentController::class, 'process'])->name('membership.process');

// ✅ CALLBACK PUBLIC KKIAPAY (OBLIGATOIRE)
Route::get('/cotisation/notify', [MembershipPaymentController::class, 'notify'])
    ->name('membership.notify');

// ✅ ROUTES PROTÉGÉES POUR LES PAIEMENTS
Route::middleware(['auth:company,administration,college'])->group(function () {
    Route::get('/cotisation/historique', [MembershipPaymentController::class, 'history'])
        ->name('membership.history');

    Route::get('/cotisation/{payment}/facture', [MembershipPaymentController::class, 'downloadInvoice'])
        ->name('membership.invoice.download');
});

// Routes spécifiques aux ESN (nécessite d'être authentifié en tant qu'ESN)
Route::middleware(['auth:esn'])
    ->prefix('esn')
    ->name('esn.')
    ->group(function () {

        // Tableau de bord
        Route::get('/dashboard', [EsnDashboardController::class, 'index'])
            ->name('dashboard');

        // Routes de profil
        Route::get('/profile', [EsnProfileController::class, 'show'])
            ->name('profile.show');
        Route::get('/profile/edit', [EsnProfileController::class, 'edit'])
            ->name('profile.edit');
        Route::put('/profile', [EsnProfileController::class, 'update'])
            ->name('profile.update');
    });


// Routes protégées pour l'espace Partenaire (nécessite d'être connecté)
    // =====================================================================
    // GROUPE DE ROUTES POUR LES PARTENAIRES (PARTNER)
    Route::middleware(['auth:partner'])
        ->prefix('partner')
        ->name('partner.')
        ->group(function () {
            Route::get('/dashboard', [App\Http\Controllers\PartnerDashboardController::class, 'index'])
                ->name('dashboard');



        // Gestion du profil
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [PartnerProfileController::class, 'edit'])->name('edit');
            Route::put('/', [PartnerProfileController::class, 'update'])->name('update');
            // Route pour changer le mot de passe, si ce n'est pas inclus dans 'update'
            Route::put('password', [PartnerProfileController::class, 'updatePassword'])->name('update-password');
        });

        // Gestion des documents
        Route::prefix('documents')->name('documents.')->group(function () {
            Route::get('/', [PartnerDocumentController::class, 'index'])->name('index');
            Route::post('/', [PartnerDocumentController::class, 'store'])->name('store');
            Route::get('{document}/download', [PartnerDocumentController::class, 'download'])->name('download');
            Route::delete('{document}', [PartnerDocumentController::class, 'destroy'])->name('destroy');
        });
    });

    // === ROUTES DU NEXUSDSI HUB ===
    Route::prefix('nexusdsi')->name('nexusdsi.')->group(function () {
        // Page "Bientôt disponible"
        Route::get('/hub', [NexusDSIController::class, 'comingSoon'])->name('coming-soon');

    });

// --- Route pour la page "Coming Soon" de la plateforme de gestion des compétences ---
Route::get('/competences/coming-soon', [ComingSoonController::class, 'competences'])
    ->name('competences.comingsoon');

// --- 2. Routes pour la page de contact ---*
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');


// Login admin
Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);

// Groupe de routes protégées pour l'administration
Route::prefix('admin')->name('admin.')->group(function () {

        // Profil admin
    Route::get('/profile', [AdminProfileController::class, 'show'])
        ->name('profile')
        ->middleware('auth:web,role:admin');

    // Dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // 🔹 Voir un membre validé
    Route::get('/members/{type}/{id}/view', [AdminMemberController::class, 'show'])
        ->name('members.view');

    // 🔹 Voir une adhésion en attente ou tout membre (déjà existant)
    Route::get('/members/{type}/{id}', [AdminMemberController::class, 'show'])
        ->name('members.show');

    // 🔹 Liste (dashboard membres)
    Route::get('/members', [AdminMemberController::class, 'index'])
        ->name('members');

    // 🔹 Ajouter membre
    Route::get('/members/create', [AdminMemberController::class, 'create'])
        ->name('members.create');

    Route::post('/members/store', [AdminMemberController::class, 'store'])
        ->name('members.store');

    // 🔹 Liste globale
    Route::get('/members/list', [AdminMemberController::class, 'list'])
        ->name('members.list');

    // 🔹 Rejetés
    Route::get('/members/rejected', [AdminMemberController::class, 'rejected'])
        ->name('members.rejected');

    // 🔹 Actions
    Route::post('/members/{type}/{id}/approve', [AdminMemberController::class, 'approve'])
        ->name('members.approve');

    Route::post('/members/{type}/{id}/reject', [AdminMemberController::class, 'reject'])
        ->name('members.reject');


    Route::post('/members/{type}/{id}/block', [AdminMemberController::class, 'block'])
        ->name('members.block');

    Route::delete('/members/{type}/{id}/delete', [AdminMemberController::class, 'delete'])
        ->name('members.delete');

    // ADMIN - Adhésions en attente
    Route::get('/members/pending', [AdminMemberController::class, 'pending'])
        ->name('members.pending')
        ->middleware('auth:web,role:admin');
});


// Routes pour la gestion des membres du bureau
Route::prefix('admin/board')->name('admin.board.')->middleware('auth:web,role:admin')->group(function () {

    Route::get('/', [BoardController::class, 'index'])->name('index');

    Route::get('/create', [BoardController::class, 'create'])->name('create');
    Route::post('/store', [BoardController::class, 'store'])->name('store');

    Route::get('/{id}/show', [BoardController::class, 'show'])->name('show');

    Route::get('/{id}/edit', [BoardController::class, 'edit'])->name('edit');
    Route::put('/{id}', [BoardController::class, 'update'])->name('update');

    Route::get('/{id}/speech', [BoardController::class, 'speech'])->name('speech');
    Route::post('/{id}/speech', [BoardController::class, 'saveSpeech'])->name('speech.save');
    Route::post('/{id}/speech', [BoardController::class, 'storeSpeech'])->name('speech.store');


    Route::delete('/{id}', [BoardController::class, 'destroy'])->name('delete');

    Route::get('/add/{type}/{id}', [BoardController::class, 'create'])->name('addForm');
});

// Routes admin pour la gestion des partenaires
Route::prefix('admin/partners')->name('admin.partners.')->middleware('auth:web,role:admin')->group(function () {

    Route::post('/{partner}/approve', [AdminPartnerController::class, 'approve'])
        ->name('approve');

    Route::post('/{partner}/reject', [AdminPartnerController::class, 'reject'])
        ->name('reject');

    Route::get('/rejected', [AdminPartnerController::class, 'rejected'])->name('rejected');
    Route::post('/approve', [AdminPartnerController::class, 'approve'])->name('approve');
    Route::post('/reject', [AdminPartnerController::class, 'reject'])->name('reject');

    // Routes pour les partenaires
    Route::get('/', [AdminPartnerController::class, 'index'])->name('index');
    Route::get('/create', [AdminPartnerController::class, 'create'])->name('create');
    Route::post('/store', [AdminPartnerController::class, 'store'])->name('store');
    Route::get('/{id}/show', [AdminPartnerController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AdminPartnerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdminPartnerController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminPartnerController::class, 'destroy'])->name('delete');

    // Routes pour les types de partenaires
    Route::get('/types', [AdminPartnerTypeController::class, 'index'])->name('types');
    Route::get('/types/create', [AdminPartnerTypeController::class, 'create'])->name('types.create');
    Route::post('/types/store', [AdminPartnerTypeController::class, 'store'])->name('types.store');
    Route::get('/types/{id}/edit', [AdminPartnerTypeController::class, 'edit'])->name('types.edit');
    Route::put('/types/{id}', [AdminPartnerTypeController::class, 'update'])->name('types.update');
    Route::delete('/types/{id}', [AdminPartnerTypeController::class, 'destroy'])->name('types.delete');


    // Routes pour les formules de partenariat
    Route::get('/formules', [AdminPartnerController::class, 'formules'])->name('formules');
    Route::get('/formules/create', [AdminPartnerController::class, 'createFormule'])->name('formules.create');
    Route::post('/formules/store', [AdminPartnerController::class, 'storeFormule'])->name('formules.store');
    Route::get('/formules/{id}/edit', [AdminPartnerController::class, 'editFormule'])->name('formules.edit');
    Route::put('/formules/{id}', [AdminPartnerController::class, 'updateFormule'])->name('formules.update');
    Route::delete('/formules/{id}', [AdminPartnerController::class, 'destroyFormule'])->name('formules.delete');


    //PARTENAIRES PRESSE
    Route::get('/press', [AdminPartnerController::class, 'press'])->name('press');
    Route::get('/press/create', [AdminPartnerController::class, 'createPress'])->name('press.create');
    Route::post('/press/store', [AdminPartnerController::class, 'storePress'])->name('press.store');
    Route::get('/press/{id}/edit', [AdminPartnerController::class, 'editPress'])->name('press.edit');
    Route::put('/press/{id}', [AdminPartnerController::class, 'updatePress'])->name('press.update');
    Route::delete('/press/{id}', [AdminPartnerController::class, 'destroyPress'])->name('press.delete');

});

// PROGRAMMES THEMATIQUES
Route::prefix('admin/programs')->name('admin.programs.')->middleware('auth:web,role:admin')->group(function () {

    Route::get('/', [App\Http\Controllers\Admin\ProgramController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\Admin\ProgramController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\Admin\ProgramController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [App\Http\Controllers\Admin\ProgramController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\Admin\ProgramController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\Admin\ProgramController::class, 'destroy'])->name('delete');

});

// GESTION DES EVENEMENTS
Route::prefix('admin/events')->name('admin.events.')->middleware('auth:web,role:admin')->group(function () {

    // TYPE D'EVENEMENTS
    Route::get('/type', [App\Http\Controllers\Admin\EventController::class, 'type'])->name('type');
    Route::post('/type/store', [App\Http\Controllers\Admin\EventController::class, 'typeStore'])->name('type.store');
    Route::get('/type/{id}/edit', [App\Http\Controllers\Admin\EventController::class, 'typeEdit'])->name('type.edit');
    Route::put('/type/{id}', [App\Http\Controllers\Admin\EventController::class, 'typeUpdate'])->name('type.update');
    Route::delete('/type/{id}', [App\Http\Controllers\Admin\EventController::class, 'typeDelete'])->name('type.delete');

    // EVENEMENTS
    Route::get('/', [App\Http\Controllers\Admin\EventController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\Admin\EventController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\Admin\EventController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [App\Http\Controllers\Admin\EventController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\Admin\EventController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\Admin\EventController::class, 'destroy'])->name('delete');

});

// FORMATIONS
Route::prefix('admin/formations')->name('admin.formations.')->middleware('auth:web,role:admin')->group(function () {

    Route::get('/', [AdminFormationController::class, 'index'])->name('index');
    Route::get('/create', [AdminFormationController::class, 'create'])->name('create');
    Route::post('/store', [AdminFormationController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AdminFormationController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdminFormationController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminFormationController::class, 'destroy'])->name('delete');

    // CATEGORIES DE FORMATIONS
    Route::get('/categories', [AdminFormationController::class, 'categories'])->name('categories');    
    Route::post('/categories/store', [AdminFormationController::class, 'categoriesStore'])->name('categories.store');
    Route::delete('/categories/{id}', [AdminFormationController::class, 'categoriesDelete'])->name('categories.delete');   

});


// Paiement
Route::middleware(['auth:web,company,college,administration'])
    ->group(function () {
        Route::get('/payments/checkout', [PaymentController::class, 'checkout'])
            ->name('payments.checkout');
    Route::get('/payments/notify', [PaymentController::class, 'notify'])->name('payments.notify'); // callback du widget (client => serveur)
    Route::get('/payments/success', [PaymentController::class, 'success'])->name('payments.success');
});



// Logout admin
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Webhook pour les paiements
Route::post('/https://clubdsibenin.bj/webhook', [PayementController::class, 'webhook'])->name('payment.webhook');


// --- 3. Les routes d'authentification de Breeze sont incluses ici ---
// (Ce fichier contient déjà les routes nommées 'login', 'register', 'logout', etc.)
require __DIR__.'/auth.php';







