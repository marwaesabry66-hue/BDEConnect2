<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    protected $fillable = [
        'titre','description','date_debut',
        'date_fin','lieu','capacite_max','prix','statut'
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin'   => 'datetime',
    ];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function inscriptionsConfirmees()
    {
        return $this->inscriptions()->where('statut', 'confirmée');
    }

    public function estPasse()
    {
        return $this->date_fin < now();
    }
}