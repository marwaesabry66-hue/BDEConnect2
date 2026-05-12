<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
    {
        $evenements = Evenement::orderBy('date_debut', 'asc')->get();
        return view('evenements.index', compact('evenements'));
    }

    public function create()
    {
        return view('evenements.create');
    }

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
            ->with('success', 'Evenement cree!');
    }

    public function show(Evenement $evenement)
    {
        return view('evenements.show', compact('evenement'));
    }

    public function edit(Evenement $evenement)
    {
        if ($evenement->estPasse()) {
            abort(403, 'Evenement passe.');
        }
        return view('evenements.edit', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        if ($evenement->estPasse()) {
            abort(403, 'Evenement passe.');
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
            ->with('success', 'Evenement modifie!');
    }

    public function destroy(Evenement $evenement)
    {
        if ($evenement->estPasse()) {
            abort(403, 'Evenement passe.');
        }
        $evenement->delete();
        return redirect()->route('evenements.index')
            ->with('success', 'Evenement supprime!');
    }

    public function calendrier()
    {
        $evenements = Evenement::where('date_debut', '>', now())
            ->where('statut', 'actif')
            ->orderBy('date_debut', 'asc')
            ->get();
        return view('evenements.calendrier', compact('evenements'));
    }
}