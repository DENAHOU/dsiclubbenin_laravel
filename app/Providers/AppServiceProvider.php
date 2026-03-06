<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // 1. AJOUTEZ CETTE LIGNE
use App\Models\Faq;                 // 2. AJOUTEZ CETTE LIGNE

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Ne touchez à rien ici
    }

    public function boot(): void
    {
        // 3. AJOUTEZ CE BLOC DE CODE COMPLET
        try {
            View::composer('*', function ($view) {
                $view->with('faqs', Faq::all());
            });
        } catch (\Exception $e) {
            // Si la table n'existe pas encore (ex: pendant une migration), ne rien faire.
        }
    }
}
