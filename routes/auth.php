<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// --- Imports de tous les contrôleurs (organisés par type) ---

// Contrôleurs de Breeze (pour le garde 'web' / 'users')
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\PasswordController;

// Nos contrôleurs d'INSCRIPTION
use App\Http\Controllers\Auth\MembreRegisterController;
use App\Http\Controllers\Auth\CompanyRegisterController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Auth\CollegeRegisterController;
use App\Http\Controllers\Auth\EsnRegisterController;
use App\Http\Controllers\Auth\PartnerRegisterController;
use App\Http\Controllers\Auth\RecruterRegisterController;
use App\Http\Controllers\Auth\CandidatRegisterController;

// Nos contrôleurs de CONNEXION
// use App\Http\Controllers\Auth\CompanyLoginController;
// use App\Http\Controllers\Auth\AdministrationLoginController;
// use App\Http\Controllers\Auth\CollegeLoginController;
// use App\Http\Controllers\Auth\CandidatLoginController;
// use App\Http\Controllers\Auth\RecruterLoginController;
// use App\Http\Controllers\Auth\PartnerLoginController;
// use App\Http\Controllers\Auth\EsnLoginController;
use App\Http\Controllers\Auth\UnifiedLoginController;


// =====================================================================
// ROUTES POUR LES VISITEURS (protégées par le middleware 'guest')
// =====================================================================
Route::middleware('guest')->group(function () {

    // --- 1. HUBS DE SÉLECTION ---
    Route::get('register', function () { return view('auth.register-choice'); })->name('register');
    Route::get('login', [UnifiedLoginController::class, 'create'])->name('login');
    Route::post('login', [UnifiedLoginController::class, 'store'])->name('login.unified');

    // --- 2. PARCOURS DE CONNEXION DÉDIÉS ---
    // Connexion pour Membres DSI / Admins (utilise le contrôleur de Breeze)
    Route::get('login/member', [AuthenticatedSessionController::class, 'create'])->name('login.member');
    Route::post('login/member', [AuthenticatedSessionController::class, 'store']);

    // Connexion pour les autres acteurs
    // Route::get('login/company', [CompanyLoginController::class, 'create'])->middleware('guest')->name('login.company');
    // Route::post('login/company', [CompanyLoginController::class, 'store'])->middleware('guest');
    // Route::get('login/administration', [AdministrationLoginController::class, 'create'])->middleware('guest')->name('login.administration');
    // Route::post('login/administration', [AdministrationLoginController::class, 'store'])->middleware('guest');
    // Route::get('login/college', [CollegeLoginController::class, 'create'])->middleware('guest')->name('login.college');
    // Route::post('login/college', [CollegeLoginController::class, 'store'])->middleware('guest');
    // Route::get('login/candidat', [CandidatLoginController::class, 'create'])->middleware('guest')->name('login.candidat');
    // Route::post('login/candidat', [CandidatLoginController::class, 'store'])->middleware('guest');
    // Route::get('login/recruter', [RecruterLoginController::class, 'create'])->middleware('guest')->name('login.recruter');
    // Route::post('login/recruter', [RecruterLoginController::class, 'store'])->middleware('guest');
    // Route::get('login/partner', [PartnerLoginController::class, 'create'])->middleware('guest')->name('login.partner');
    // Route::post('login/partner', [PartnerLoginController::class, 'store'])->middleware('guest');
    // Route::get('login/esn', [EsnLoginController::class, 'create'])->middleware('guest')->name('login.esn');
    // Route::post('login/esn', [EsnLoginController::class, 'store'])->middleware('guest');

    // --- 3. PARCOURS D'INSCRIPTION DÉDIÉS ---

    // a) Inscription
    Route::get('register/standard', [RegisteredUserController::class, 'create'])->name('register.standard');
    Route::post('register/standard', [RegisteredUserController::class, 'store']);

    Route::get('register/choisir-statut', function () { return view('auth.register-choice-type'); })->name('register.choice_type');
    Route::get('register/membre-conditions', function () { return view('auth.membre-conditions'); })->name('register.membre.conditions');

    Route::get('register/membre', [MembreRegisterController::class, 'create'])->name('register.membre');
    Route::post('register/membre', [MembreRegisterController::class, 'store'])->name('register.membre.store');

    Route::get('register/entreprise', [CompanyRegisterController::class, 'create'])->name('register.company');
    Route::post('register/entreprise', [CompanyRegisterController::class, 'store'])->name('register.company.store');

    Route::get('register/administration', [AdminRegisterController::class, 'create'])->name('register.admin');
    Route::post('register/administration', [AdminRegisterController::class, 'store'])->name('register.admin.store');

    Route::get('register/college-it', [CollegeRegisterController::class, 'create'])->name('register.college_it');
    Route::post('register/college-it', [CollegeRegisterController::class, 'store'])->name('register.college.store');

    Route::get('register/candidat', [CandidatRegisterController::class, 'create'])->name('register.candidat');
    Route::post('register/candidat', [CandidatRegisterController::class, 'store'])->name('register.candidat.store');
    Route::post('register/candidat/parse-cv', [CandidatRegisterController::class, 'parseCv'])->name('register.candidat.parse');

    Route::get('register/recruteur', [RecruterRegisterController::class, 'create'])->name('register.recruter');
    Route::post('register/recruteur', [RecruterRegisterController::class, 'store'])->name('register.recruter.store');

    Route::get('register/partenaire', [PartnerRegisterController::class, 'create'])->name('register.partner');
    Route::post('register/partenaire', [PartnerRegisterController::class, 'store'])->name('register.partner.store');

    Route::get('register/esn', [EsnRegisterController::class, 'create'])->name('register.esn');
    Route::post('register/esn', [EsnRegisterController::class, 'store'])->name('register.esn.store');

    // --- 4. MOT DE PASSE OUBLIÉ (routes de Breeze) ---
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// =====================================================================
// ROUTES POUR LES UTILISATEURS CONNECTÉS
// =====================================================================

// --- Routes protégées pour le garde "web" (Membres DSI, Admins) ---
Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});

// --- Routes de déconnexion unifiées ---
// La déconnexion est gérée par UnifiedLoginController pour tous les types d'utilisateurs
Route::post('logout', [UnifiedLoginController::class, 'destroy'])->name('logout')->middleware('auth:web,admin,company,college,administration,candidat,recruter,partner,esn');
