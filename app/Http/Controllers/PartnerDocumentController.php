<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Document; // Assurez-vous d'avoir ce modèle
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PartnerDocumentController extends Controller
{
    /**
     * Affiche la liste des documents du partenaire.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $partner = Auth::guard('partner')->user();
        $documents = $partner->documents()->latest()->get(); // Récupère les documents du partenaire

        return view('partner.documents.index', compact('documents'));
    }

    /**
     * Traite le téléchargement d'un nouveau document.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'document_file' => ['required', 'file', 'max:10240'], // Max 10MB
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $partner = Auth::guard('partner')->user();
        $filePath = $request->file('document_file')->store('partner_documents/' . $partner->id, 'public');

        Document::create([
            'partner_id' => $partner->id,
            'name' => $request->name,
            'file_path' => $filePath,
            'file_type' => $request->file('document_file')->getClientMimeType(),
            'file_size' => $request->file('document_file')->getSize(),
            'description' => $request->description,
        ]);

        return redirect()->route('partner.documents.index')->with('success', 'Document téléchargé avec succès !');
    }

    /**
     * Permet de télécharger un document.
     *
     * @param  \App\Models\Document  $document
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\RedirectResponse
     */
    public function download(Document $document)
    {
        // S'assurer que le partenaire connecté est bien le propriétaire du document
        if (Auth::guard('partner')->id() !== $document->partner_id) {
            return redirect()->back()->with('error', 'Accès non autorisé au document.');
        }

        if (Storage::disk('public')->exists($document->file_path)) {
            return Storage::disk('public')->download($document->file_path, $document->name . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION));
        }

        return redirect()->back()->with('error', 'Le document n\'existe pas.');
    }

    /**
     * Supprime un document.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Document $document)
    {
        // S'assurer que le partenaire connecté est bien le propriétaire du document
        if (Auth::guard('partner')->id() !== $document->partner_id) {
            return redirect()->back()->with('error', 'Accès non autorisé pour supprimer ce document.');
        }

        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('partner.documents.index')->with('success', 'Document supprimé avec succès !');
    }
}
