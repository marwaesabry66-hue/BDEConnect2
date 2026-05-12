<?php

namespace App\Http\Controllers;

use App\Services\InscriptionService;
use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    protected $inscriptionService;

    public function __construct(InscriptionService $inscriptionService)
    {
        $this->inscriptionService = $inscriptionService;
    }

    public function store(Request $request)
    {
        try {
            $this->inscriptionService->inscrire(auth()->id(), $request->evenement_id);
            return back()->with('success', 'Inscription réussie!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function cancel(int $id)
    {
        try {
            $this->inscriptionService->annuler($id);
            return back()->with('success', 'Inscription annulée!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function historique()
    {
        $inscriptions = Inscription::with('evenement')
                        ->where('user_id', auth()->id())
                        ->orderBy('date_inscription', 'desc')->get();
        return view('inscriptions.historique', compact('inscriptions'));
    }
}