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


        \App\Models\Region::create(
            [
                'id' => '1',
                'nom' => 'Bobo Dioulasso',
            ]
        );

        \App\Models\Pool::create(
            [
                'designation' => 'Direction du transport et de la Logistique',
                'abbreviation' => 'DTL',
                'regionId' => '1',
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

        \App\Models\Role::create(
            [
                'id' => '1',
                'role' => 'Demandeur',
            ]
        );

        \App\Models\Role::create(
            [
                'id' => '2',
                'role' => 'Garagiste',
            ]
        );

        \App\Models\Role::create(
            [
                'id' => '3',
                'role' => 'Chargé des imputations',
            ]
        );

        \App\Models\Role::create(
            [
                'id' => '4',
                'role' => 'Responsable de pool',
            ]
        );

        \App\Models\Role::create(
            [
                'id' => '5',
                'role' => 'gestionnaire du parc',
            ]
        );

        \App\Models\Role::create(
            [
                'id' => '5',
                'role' => 'Administrateur',
            ]
        );


        \App\Models\User::create(
            [
                'matricule' => '1',
                'login' => 'missLogin',
                'password' => bcrypt('missLogin'),
                'role' => '1',
                'statut' => '1',
                'idPool' => '1',
            ]
        );

        \App\Models\User::create(
            [
                'matricule' => '2',
                'login' => 'rpLogin',
                'password' => bcrypt('rpLogin'),
                'role' => '4',
                'statut' => '1',
                'idPool' => '1',
            ]
        );

        \App\Models\User::create(
            [
                'matricule' => '3',
                'login' => 'cgLogin',
                'password' => bcrypt('cgLogin'),
                'role' => '2',
                'statut' => '1',
                'idPool' => '1',
            ]
        );

        \App\Models\User::create(
            [
                'matricule' => '4',
                'login' => 'ciLogin',
                'password' => bcrypt('ciLogin'),
                'role' => '3',
                'statut' => '1',
                'idPool' => '1',
            ]
        );

        \App\Models\User::create(
            [
                'matricule' => '5',
                'login' => 'gpLogin',
                'password' => bcrypt('gpLogin'),
                'role' => '5',
                'statut' => '1',
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
