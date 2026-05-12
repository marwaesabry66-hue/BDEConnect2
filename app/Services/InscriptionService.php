<?php

namespace App\Services;

use App\Models\Inscription;
use App\Models\Evenement;
use Illuminate\Support\Facades\DB;

class InscriptionService
{
    public function inscrire(int $userId, int $evenementId): Inscription
    {
        $evenement = Evenement::findOrFail($evenementId);

        $existe = Inscription::where('user_id', $userId)
                    ->where('evenement_id', $evenementId)
                    ->whereIn('statut', ['confirmée', 'liste_attente'])
                    ->exists();

        if ($existe) {
            throw new \Exception('Deja inscrit a cet evenement.');
        }

        $statut = $evenement->inscriptionsConfirmees()->count() < $evenement->capacite_max
                  ? 'confirmée' : 'liste_attente';

        return Inscription::create([
            'user_id'          => $userId,
            'evenement_id'     => $evenementId,
            'date_inscription' => now(),
            'statut'           => $statut,
        ]);
    }

    public function annuler(int $inscriptionId): void
    {
        DB::transaction(function () use ($inscriptionId) {
            $inscription = Inscription::findOrFail($inscriptionId);
            $evenementId = $inscription->evenement_id;
            $inscription->update(['statut' => 'annulée']);

            $suivant = Inscription::where('evenement_id', $evenementId)
                        ->where('statut', 'liste_attente')
                        ->orderBy('date_inscription', 'asc')
                        ->first();

            if ($suivant) {
                $suivant->update(['statut' => 'confirmée']);
            }
        });
    }
}