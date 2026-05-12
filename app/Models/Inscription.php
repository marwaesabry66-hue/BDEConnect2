<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = [
        'user_id','evenement_id','date_inscription','statut'
    ];

    protected $casts = [
        'date_inscription' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }
}