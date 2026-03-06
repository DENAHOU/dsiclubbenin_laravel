<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Event;
use App\Models\Formation;
use App\Models\CategoryFormation;
use App\Models\FormationRegistration; // Assurez-vous d'avoir créé le modèle

class ActiviteController extends Controller
{
    /**
     * Affiche la page principale des Événements & Actualités.
     */
    public function evenements(): View
    {
        // On définit la liste des slides. Les chemins pointent bien vers 'public/img/'.
        $slides = [
            ['image' => 'img/semi 1.jpg', 'title' => 'Nos Séminaires', 'alt' => 'Séminaire 1'],
            ['image' => 'img/after4.jpg', 'title' => 'Nos Afterworks', 'alt' => 'Afterwork 4'],
            ['image' => 'img/even4.jpg', 'title' => 'Nos Actualités', 'alt' => 'Actualité 4'],
            
        ];

        // Charger les événements ajoutés par l'admin et les grouper par type
        $events = Event::where('status', 'actif')
            ->with('typeEvent')
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(function($event) {
                return $event->typeEvent ? strtolower($event->typeEvent->nom) : 'autre';
            });

        return view('activites.evenements', [
            'slides' => $slides,
            'events' => $events
        ]);
    }

    /**
     * Affiche la page dédiée aux Formations.
     */
    public function formations(): View
    {
        $categories = CategoryFormation::all();
        $formations = Formation::where('status', 'published')->paginate(12);
        
        // On récupère toutes les dernières formations publiées
        $newFormations = Formation::where('status', 'published')->orderBy('created_at', 'desc')->get();

        return view('activites.formations', [
            'categories' => $categories,
            'formations' => $formations,
            'newFormations' => $newFormations
        ]);
    }

    public function show($id) {
        $formation = Formation::findOrFail($id);
        return view('activites.formations_show', compact('formation'));
    }

    public function registerForm($id) {
        $formation = Formation::findOrFail($id);
        return view('activites.formation_register', compact('formation'));
    }

    public function storeRegistration(Request $request, $id) {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email',
            'phone'     => 'required|string',
            'company'   => 'nullable|string',
        ]);

        FormationRegistration::create([
            'formation_id' => $id,
            'full_name'    => $request->full_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'company'       => $request->company,
            'payment_status' => 'pending'
        ]);

        return redirect()->route('activites.formations')->with('success', 'Votre inscription a été enregistrée !');
    }

    
    /**
     * Affiche la page dédiée aux DSI Awards.
     */
    public function awards(): View
    {
        return view('activites.awards');
    }
}

