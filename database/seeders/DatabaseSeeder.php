<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Evenement;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin BDE',
            'email'    => 'admin@bde.ma',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Etudiant 1',
            'email'    => 'etudiant1@test.ma',
            'password' => bcrypt('password'),
            'role'     => 'etudiant',
        ]);

        User::create([
            'name'     => 'Etudiant 2',
            'email'    => 'etudiant2@test.ma',
            'password' => bcrypt('password'),
            'role'     => 'etudiant',
        ]);

        User::create([
            'name'     => 'Etudiant 3',
            'email'    => 'etudiant3@test.ma',
            'password' => bcrypt('password'),
            'role'     => 'etudiant',
        ]);

        Evenement::create([
            'titre'        => 'Soiree BDE 2026',
            'description'  => 'Grande soiree annuelle du BDE',
            'date_debut'   => now()->addDays(7),
            'date_fin'     => now()->addDays(7)->addHours(4),
            'lieu'         => 'Salle des fetes EST Nador',
            'capacite_max' => 2,
            'prix'         => 50,
            'statut'       => 'actif',
        ]);

        Evenement::create([
            'titre'        => 'Tournoi Football',
            'description'  => 'Tournoi inter-filieres',
            'date_debut'   => now()->addDays(14),
            'date_fin'     => now()->addDays(14)->addHours(6),
            'lieu'         => 'Terrain de sport EST',
            'capacite_max' => 20,
            'prix'         => 0,
            'statut'       => 'actif',
        ]);
    }
}