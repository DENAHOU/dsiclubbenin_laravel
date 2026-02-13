<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\TypeEvent;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('typeEvent')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $eventTypes = TypeEvent::orderBy('nom')->get();
        return view('admin.events.create', compact('eventTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'type_event_id' => 'required|exists:types_events,id',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'status' => 'required|string|in:actif,inactif',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|string|url',
        ]);

        $data = $request->all();
        
        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/events'), $imageName);
            $data['image'] = 'images/events/' . $imageName;
        }

        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Évènement créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $eventTypes = TypeEvent::orderBy('nom')->get();
        return view('admin.events.edit', compact('event', 'eventTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'type_event_id' => 'required|exists:types_events,id',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'status' => 'required|string|in:actif,inactif',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|string|url',
        ]);

        $data = $request->all();
        
        $event = Event::findOrFail($id);
        
        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($event->image && file_exists(public_path($event->image))) {
                unlink(public_path($event->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/events'), $imageName);
            $data['image'] = 'images/events/' . $imageName;
        }

        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Évènement mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Évènement supprimé avec succès');
    }

    /**
     * Display event types management page.
     */
    public function type()
    {
        $eventTypes = TypeEvent::orderBy('nom')->paginate(10);
        return view('admin.events.type', compact('eventTypes'));
    }

    /**
     * Store a new event type.
     */
    public function typeStore(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'couleur' => 'required|string',
        ]);

        TypeEvent::create($request->all());
        return redirect()->route('admin.events.type')->with('success', 'Type d\'évènement créé avec succès');
    }

    /**
     * Show the form for editing an event type.
     */
    public function typeEdit(string $id)
    {
        $eventType = TypeEvent::findOrFail($id);
        return response()->json($eventType);
    }

    /**
     * Update an event type.
     */
    public function typeUpdate(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'couleur' => 'required|string',
        ]);

        $eventType = TypeEvent::findOrFail($id);
        $eventType->update($request->all());
        return redirect()->route('admin.events.type')->with('success', 'Type d\'évènement mis à jour avec succès');
    }

    /**
     * Delete an event type.
     */
    public function typeDelete(string $id)
    {
        $eventType = TypeEvent::findOrFail($id);
        $eventType->delete();
        return redirect()->route('admin.events.type')->with('success', 'Type d\'évènement supprimé avec succès');
    }
}
