<?php

namespace App\Http\Controllers\Microsoft;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MicrosoftCalendarController extends Controller
{
    /**
     * Affiche le calendrier et les événements
     */
    public function index(): View
    {
        $user = Auth::user();

        // Récupère les 10 prochains événements
        $upcomingEvent = $user->microsoftCalendars()
            ->where('start_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->limit(10)
            ->get();

        // Récupère les événements passés (optionnel)
        $pastEvents = $user->microsoftCalendars()
            ->where('end_time', '<', now())
            ->orderBy('end_time', 'desc')
            ->limit(5)
            ->get();

        return view('microsoft.calendar', [
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents,
        ]);
    }
}
