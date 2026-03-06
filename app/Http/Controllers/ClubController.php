<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\PressPartner;
use App\Models\Program;
use App\Models\Event;
use App\Models\PartnerType;

class ClubController extends Controller
{
    public function about()
    {
        return view('club.about');
    }

    public function programme()
    {
        $programs = Program::where('status', 'actif')->orderBy('created_at', 'desc')->get();
        return view('club.programme', compact('programs'));
    }

    public function events()
    {
        $events = Event::where('status', 'actif')->orderBy('date', 'desc')->get();
        return view('club.events', compact('events'));
    }

    public function partners()
    {
        $partners = Partner::where('status', 'approved')->get();

        $pressPartners = PressPartner::all();

        $types = PartnerType::with(['partners' => function ($query) {
            $query->where('status', 'approved');
        }])->get();

        return view('club.partners', compact('partners', 'pressPartners', 'types'));
    }

 }
