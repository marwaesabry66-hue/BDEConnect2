<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Inscription;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvenements   = Evenement::count();
        $totalInscriptions = Inscription::count();
        $confirmes         = Inscription::where('statut', 'confirmée')->count();
        $listeAttente      = Inscription::where('statut', 'liste_attente')->count();
        $annules           = Inscription::where('statut', 'annulée')->count();
        $topEvenements     = Evenement::withCount([
            'inscriptions as nb_confirmes' => fn($q) => $q->where('statut', 'confirmée')
        ])->orderBy('nb_confirmes', 'desc')->take(3)->get();

        return view('dashboard', compact(
            'totalEvenements','totalInscriptions',
            'confirmes','listeAttente','annules','topEvenements'
        ));
    }
}