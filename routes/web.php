<?php

use Illuminate\Support\Facades\Route;


/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //=========================route responsable de pool

Route::get('/respPool', 'RespPoolController@index')->name('respPool.index');
Route::get('/respPool/vehicules', 'RespPoolController@vehicules')->name('respPool.vehicules');
Route::get('/respPool/chauffeurs', 'RespPoolController@chauffeurs')->name('respPool.chauffeurs');

Route::get('/respPool/requetes', 'RespPoolController@requetes')->name('respPool.requetes');
Route::get('/respPool/detailsRequete', 'RespPoolController@index')->name('respPool.detailsRequete');
Route::get('/respPool/attribution', 'AttributionController@store')->name('attribution.store');
Route::get('/respPool/historique', 'RespPoolController@historique')->name('respPool.historique');




    //=========================route gestionnaire de parc

Route::get('/gestParc', 'GestParcController@index')->name('gestParc.index');

    //==========================route chef de garage

Route::get('/chefGarage', 'ChefGarageController@index')->name('chefGarage.index');
Route::get('/chefGarage/historique', 'InterventionController@index')->name('intervention.index');
Route::post('/chefGarage', 'InterventionController@store')->name('intervention.store');
Route::get('/chefGarage/liste_vehicules', 'ChefGarageController@listeVehicules')->name('chefGarage.liste_vehicules');
Route::get('interventions/{intervention}/edit', 'InterventionController@edit' );
Route::patch('interventions/{intervention}', 'InterventionController@update' );
Route::get('interventions/{intervention}', 'InterventionController@terminerInt' );
Route::get('interventions/{intervention}/delete', 'InterventionController@destroy' );



    //===========================route imputation

Route::get('/chargeImp', 'ChargeImpController@index')->name('chargeImp.index');


    //===========================route missionnaire

Route::get('/agentMiss', 'AgentMissController@index')->name('agentMiss.index');
Route::get('/agentMiss/demandeVehicule', 'AgentMissController@createMission')->name('mission.create');
Route::post('/mission/participant', 'AgentMissController@initDemanderVehicule')->name('mission.initStore');
Route::post('/mission/store', 'AgentMissController@demanderVehicule')->name('mission.store');


