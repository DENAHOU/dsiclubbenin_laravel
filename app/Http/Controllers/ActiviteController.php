<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Event;
use App\Models\Formation;
use App\Models\CategoryFormation;

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
        // Charger les formations actives ajoutées par l'admin avec leurs catégories
        $formations = Formation::with('categoryFormation')
            ->where('status', 'actif')
            ->orderBy('date_debut', 'asc')
            ->get();

        return view('activites.formations', [
            'formations' => $formations
        ]);
    }

    /**
     * Affiche la page dédiée aux DSI Awards.
     */
    public function awards(): View
    {
        return view('activites.awards');
    }
}
