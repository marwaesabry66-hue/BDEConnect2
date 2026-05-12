<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Inscription; // Darouri bach tjib les inscrits dial l'export
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse; // Pour l'export CSV

class EvenementController extends Controller
{
    /**
     * RG5: Affichage de la liste (Admin)
     */
    public function index()
    {
        $evenements = Evenement::orderBy('date_debut', 'asc')->get();
        return view('evenements.index', compact('evenements'));
    }

    public function create()
    {
        return view('evenements.create');
    }

    /**
     * Enregistrement d'un nouvel événement
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'lieu' => 'required|string',
            'capacite_max' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
        ]);

        Evenement::create($request->all());

        return redirect()->route('evenements.index')
            ->with('success', 'Événement créé avec succès !');
    }

    public function show(Evenement $evenement)
    {
        return view('evenements.show', compact('evenement'));
    }

    public function edit(Evenement $evenement)
    {
        // RG4: Verrouillage si l'événement est passé
        if ($evenement->date_fin < now()) {
            abort(403, 'Action impossible : cet événement est déjà terminé.');
        }
        return view('evenements.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        // RG4: Verrouillage si l'événement est passé
        if ($evenement->date_fin < now()) {
            abort(403, 'Modification impossible : l\'événement est passé.');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'lieu' => 'required|string',
            'capacite_max' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0',
        ]);

        $evenement->update($request->all());

        return redirect()->route('evenements.index')
            ->with('success', 'Événement modifié !');
    }

    public function destroy(Evenement $evenement)
    {
        // RG4: Protection contre suppression d'archives
        if ($evenement->date_fin < now()) {
            abort(403, 'Suppression impossible : l\'événement est passé.');
        }

        $evenement->delete();
        return redirect()->route('evenements.index')
            ->with('success', 'Événement supprimé !');
    }

    /**
     * RG5: Calendrier public (Seulement les événements à venir)
     */
    public function calendrier()
    {
        $evenements = Evenement::where('date_debut', '>', now())
            ->orderBy('date_debut', 'asc')
            ->get();
        return view('evenements.calendrier', compact('evenements'));
    }

    /**
     * BONUS: Export CSV des participants (Point 1.2 du cahier des charges)
     */
    public function exportCSV(Evenement $evenement)
    {
        // Récupérer toutes les inscriptions de cet événement avec les infos user
        $inscriptions = Inscription::where('evenement_id', $evenement->id)
            ->with('user')
            ->get();

        $response = new StreamedResponse(function () use ($inscriptions, $evenement) {
            $handle = fopen('php://output', 'w');
            
            // Entêtes CSV
            fputcsv($handle, ['Nom Complet', 'Email', 'Statut Inscription', 'Date']);

            foreach ($inscriptions as $insc) {
                fputcsv($handle, [
                    $insc->user->name,
                    $insc->user->email,
                    $insc->statut, // confirmée ou liste_attente
                    $insc->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="participants_'.$evenement->id.'.csv"');

        return $response;
    }
}