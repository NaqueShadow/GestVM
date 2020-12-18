<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        \App\Models\Pool::create(
            [
                'designation' => 'Direction du transport et de la Logistique',
                'abbreviation' => 'DTL',
            ]
        );

        \App\Models\Agent::create(
            [
                'matricule' => '1',
                'nom' => 'Diallo',
                'prenom' => 'Ali',
                'telephone' => '76767676',
                'poste' => 'chef de service',
            ]
        );

        \App\Models\Agent::create(
            [
                'matricule' => '2',
                'nom' => 'Nikiema',
                'prenom' => 'Jerome',
                'telephone' => '57575757',
                'poste' => 'Charge de mission',
            ]
        );

        \App\Models\Agent::create(
            [
                'matricule' => '3',
                'nom' => 'OUEDRAOGO',
                'prenom' => 'Ouibila',
                'telephone' => '55555555',
                'poste' => 'Chef de garage VL',
            ]
        );

        \App\Models\Agent::create(
            [
                'matricule' => '4',
                'nom' => 'OUEDRAOGO',
                'prenom' => 'Wilfried',
                'telephone' => '76768787',
                'poste' => 'Chargé des imputation',
            ]
        );

        \App\Models\Agent::create(
            [
                'matricule' => '5',
                'nom' => 'DABIRE',
                'prenom' => 'Quentin',
                'telephone' => '64527558',
                'poste' => 'Gestionnaire du parc',
            ]
        );

        \App\Models\Chauffeur::create(
            [
                'matricule' => '6',
                'nom' => 'DA',
                'prenom' => 'Crepin',
                'telephone' => '64876558',
            ]
        );

        \App\Models\Chauffeur::create(
            [
                'matricule' => '7',
                'nom' => 'KI',
                'prenom' => 'Kevin',
                'telephone' => '56776558',
            ]
        );


        \App\Models\Vehicule::create(
            [
                'code' => 'VU099',
                'modele' => 'Duster',
                'idChauf' => '6',
                'immatriculation' => 'B0268E',
            ]
        );

        \App\Models\Vehicule::create(
            [
                'code' => 'VU211',
                'modele' => 'Duster',
                'idChauf' => '7',
                'immatriculation' => 'B0248E',
            ]
        );

        \App\Models\Vehicule::create(
            [
                'code' => 'VU154',
                'modele' => 'Duster',
                'immatriculation' => 'B4368E',
            ]
        );

        \App\Models\Vehicule::create(
            [
                'code' => 'VU156',
                'modele' => 'Duster',
                'immatriculation' => 'B0988E',
            ]
        );


        \App\Models\User::create(
            [
                'matricule' => '1',
                'email' => 'miss@gmail.com',
                'password' => bcrypt('miss@gmail.com'),
                'role' => '1',
                'idPool' => '1',
            ]
        );

        \App\Models\User::create(
            [
                'matricule' => '2',
                'email' => 'rp@gmail.com',
                'password' => bcrypt('rp@gmail.com'),
                'role' => '4',
                'idPool' => '1',
            ]
        );

        \App\Models\User::create(
            [
                'matricule' => '3',
                'email' => 'cg@gmail.com',
                'password' => bcrypt('cg@gmail.com'),
                'role' => '2',
                'idPool' => '1',
            ]
        );

        \App\Models\User::create(
            [
                'matricule' => '4',
                'email' => 'ci@gmail.com',
                'password' => bcrypt('ci@gmail.com'),
                'role' => '3',
                'idPool' => '1',
            ]
        );

        \App\Models\User::create(
            [
                'matricule' => '5',
                'email' => 'gp@gmail.com',
                'password' => bcrypt('gp@gmail.com'),
                'role' => '5',
                'idPool' => '1',
            ]
        );

        \App\Models\Ville::create(
            [
                'nom' => 'Ouagadougou',
            ]
        );

        \App\Models\Ville::create(
            [
                'nom' => 'Bobo Dioulasso',
            ]
        );

        \App\Models\Ville::create(
            [
                'nom' => 'Banfora',
            ]
        );
    }
}
