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

        \App\Models\Agent::create(
            [
                'matricule' => '1',
                'nom' => 'Diallo',
                'prenom' => 'Ali',
                'telephone' => '76767676',
                'poste' => 'chef de service',
                'codePool' => '1',
            ]
        );

        \App\Models\Agent::create(
            [
                'matricule' => '2',
                'nom' => 'Nikiema',
                'prenom' => 'Jerome',
                'telephone' => '57575757',
                'poste' => 'Charge de mission',
                'codePool' => '1',
            ]
        );

        \App\Models\Agent::create(
            [
                'matricule' => '3',
                'nom' => 'OUEDRAOGO',
                'prenom' => 'Ouibila',
                'telephone' => '55555555',
                'poste' => 'Chef de garage VL',
                'codePool' => '1',
            ]
        );



        \App\Models\User::create(
            [
                'matricule' => '1',
                'email' => 'miss@gmail.com',
                'password' => bcrypt('miss@gmail.com'),
                'role' => '1',
            ]
        );

        \App\Models\User::create(
            [
                'matricule' => '2',
                'email' => 'rp@gmail.com',
                'password' => bcrypt('rp@gmail.com'),
                'role' => '4',
            ]
        );

        \App\Models\User::create(
            [
                'matricule' => '3',
                'email' => 'cg@gmail.com',
                'password' => bcrypt('cg@gmail.com'),
                'role' => '2',
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
