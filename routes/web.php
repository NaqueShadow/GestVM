<?php

use Illuminate\Support\Facades\Route;


/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {


    //=========================route responsable de pool

    Route::get('/respPool', 'RespPoolController@index')->name('respPool.index');
    Route::get('/respPool/vehicules', 'RespPoolController@vehicules')->name('respPool.vehicules');
    Route::get('/respPool/chauffeurs', 'RespPoolController@chauffeurs')->name('respPool.chauffeurs');

    Route::get('/respPool/attribution', 'RespPoolController@attrEnCours' )->name('respPool.attrEnCours');
    Route::get('/respPool/requetes', 'RespPoolController@requetes')->name('respPool.requetes');
    Route::get('/attribution/{mission}', 'RespPoolController@detailsRequete')->name('respPool.detailsRequete');
    Route::get('/attribution/{attribution}/terminer', 'AttributionController@terminer');
    Route::get('/attribution/{attribution}/destroy', 'AttributionController@destroy');
    Route::post('/attribution', 'AttributionController@store')->name('attribution.store');
        Route::post('/attribution2', 'AttributionController@store2')->name('attribution.store2');
        Route::post('/attribution3', 'AttributionController@store3')->name('attribution.store3');
    Route::get('/respPool/historique', 'RespPoolController@historique')->name('respPool.historique');

    Route::post('/respPool/filtreDemande', 'RespPoolController@filtreDemande')->name('respPool.filtreDemande');
    Route::post('/respPool/filtreAttribution', 'RespPoolController@filtreAttribution')->name('respPool.filtreAttribution');
    Route::post('/respPool/filtreVehicule', 'RespPoolController@filtreVehicule')->name('respPool.filtreVehicule');
    Route::post('/respPool/rechercheVehicule', 'RespPoolController@rechercheVehicule')->name('respPool.rechercheVehicule');
    Route::post('/respPool/filtreChauffeur', 'RespPoolController@filtreChauffeur')->name('respPool.filtreChauffeur');
    Route::post('/respPool/rechercheChauffeur', 'RespPoolController@rechercheChauffeur')->name('respPool.rechercheChauffeur');

    Route::get('/respPool/filtreDemande', 'RespPoolController@requetes');
    Route::get('/respPool/filtreAttribution', 'RespPoolController@attrEnCours');
    Route::get('/respPool/filtreVehicule', 'RespPoolController@vehicules');
    Route::get('/respPool/rechercheVehicule', 'RespPoolController@vehicules');
    Route::get('/respPool/filtreChauffeur', 'RespPoolController@chauffeurs');
    Route::get('/respPool/rechercheChauffeur', 'RespPoolController@chauffeurs');


    Route::get('/respPool/vehicule/{vehicule}', 'VehiculeController@show')->name('vehicule.show');
    Route::get('/respPool/chauffeur/{chauffeur}', 'ChauffeurController@show')->name('chauffeur.show');




    //=========================route gestionnaire de parc

    Route::get('/gestParc/vehicules', 'GestParcController@index')->name('gestParc.index');
    Route::post('/gestParc/vehicules', 'GestParcController@rechercheVehicule')->name('gestParc.rechercheVehicule');
    Route::get('/gestParc/vehiculesS', 'GestParcController@index')->name('gestParc.index');
    Route::post('/gestParc/vehiculesS', 'VehiculeController@store')->name('vehicule.store');
    Route::get('/gestParc/vehicule/{vehicule}', 'VehiculeController@fullShow')->name('vehicule.fullShow');
    Route::post('/gestParc/vehicule/{vehicule}', 'VehiculeController@updateChauffeur')->name('vehicule.updateChauffeur');
    Route::get('/gestParc/vehicule/{vehicule}/edit', 'VehiculeController@edit')->name('vehicule.edit');
    Route::patch('/gestParc/vehicule/{vehicule}', 'VehiculeController@update')->name('vehicule.update');
    Route::delete('/gestParc/vehicule/{vehicule}', 'VehiculeController@destroy')->name('vehicule.destroy');


    Route::get('/gestParc/chauffeurs', 'GestParcController@indexChauffeurs')->name('gestParc.indexChauffeurs');
    Route::post('/gestParc/chauffeurs', 'GestParcController@rechercheChauffeur')->name('gestParc.rechercheChauffeur');
    Route::get('/gestParc/chauffeursS', 'GestParcController@indexChauffeurs')->name('gestParc.indexChauffeurs');
    Route::post('/gestParc/chauffeursS', 'ChauffeurController@store')->name('chauffeur.store');
    Route::get('/gestParc/chauffeur/{chauffeur}', 'GestParcController@indexChauffeurs')->name('chauffeur.fullShow');
    Route::get('/gestParc/chauffeur/{chauffeur}/edit', 'ChauffeurController@edit')->name('chauffeur.edit');
    Route::patch('/gestParc/chauffeur/{chauffeur}', 'ChauffeurController@update')->name('chauffeur.update');
    Route::delete('/gestParc/chauffeur/{chauffeur}', 'ChauffeurController@destroy')->name('chauffeur.destroy');


    Route::get('/gestParc/pools', 'GestParcController@indexPools')->name('gestParc.indexPools');
    Route::post('/gestParc/pools', 'GestParcController@recherchePool')->name('gestParc.recherchePool');
    Route::get('/gestParc/poolsS', 'GestParcController@indexPools')->name('gestParc.indexPools');
    Route::post('/gestParc/poolsS', 'PoolController@store')->name('pool.store');
    Route::get('/gestParc/pool/{pool}', 'PoolController@show')->name('pool.show');
    Route::get('/gestParc/pool/vehicule/{vehicule}', 'PoolController@retraitVehicule')->name('pool.retraitVehicule');
    Route::post('/gestParc/pool/{pool}', 'PoolController@ajoutVehicule')->name('pool.ajoutVehicule');
    Route::get('/gestParc/pool/{pool}/chauffeur', 'PoolController@showChauf')->name('pool.showChauf');
    Route::get('/gestParc/pool/chauffeur/{chauffeur}', 'PoolController@retraitChauffeur')->name('pool.retraitChauffeur');
    Route::post('/gestParc/pool/{pool}/chauffeur', 'PoolController@ajoutChauffeur')->name('pool.ajoutChauffeur');

    Route::get('/gestParc/entites', 'GestParcController@indexEntites')->name('gestParc.indexEntites');
    Route::get('/gestParc/entites', 'EntiteController@indexEntites')->name('gestParc.create');



    //==========================route chef de garage

    Route::get('/chefGarage', 'ChefGarageController@index')->name('chefGarage.index');
    Route::get('/chefGarage/historique', 'InterventionController@index')->name('intervention.index');
    Route::post('/chefGarage', 'InterventionController@store')->name('intervention.store');
    Route::get('/chefGarage/liste_vehicules', 'ChefGarageController@listeVehicules')->name('chefGarage.liste_vehicules');
    Route::get('interventions/{intervention}/edit', 'InterventionController@edit' );
    Route::patch('interventions/{intervention}', 'InterventionController@update' );
    Route::get('interventions/{intervention}', 'InterventionController@terminerInt' );
    Route::get('interventions/{intervention}/delete', 'InterventionController@destroy' );
    Route::get('/chefGarage/vehicule/{vehicule}', 'ChefGarageController@voirVehicule' )->name('chefGarage.voirVehicule');

    Route::post('/chefGarage/filtreIntervention', 'ChefGarageController@filtreIntervention')->name('chefGarage.filtreIntervention');
    Route::post('/chefGarage/rechercheVehicule', 'ChefGarageController@rechercheVehicule')->name('chefGarage.rechercheVehicule');

    Route::get('/chefGarage/filtreIntervention', 'ChefGarageController@index');
    Route::get('/chefGarage/rechercheVehicule', 'ChefGarageController@listeVehicules');




    //===========================route imputation

    Route::get('/chargeImp', 'ChargeImpController@index')->name('chargeImp.index');
    Route::post('/chargeImp', 'ChargeImpController@filtreMois')->name('chargeImp.filtreMois');
    Route::get('/chargeImp/vehicules', 'ChargeImpController@indexVehicules')->name('chargeImp.indexVehicules');
    Route::post('/chargeImp/vehicules', 'ChargeImpController@rechercheVehicule')->name('chargeImp.rechercheVehicule');
    Route::get('/chargeImp/consommation/{vehicule}', 'ChargeImpController@indexEnregistrement')->name('chargeImp.indexEnregistrement');
    Route::post('/chargeImp/consommation/{vehicule}', 'ChargeImpController@storeRessource')->name('chargeImp.storeRessource');
    Route::get('/chargeImp/consomm/{vehicule}', 'ChargeImpController@indexConsommation');
    Route::post('/chargeImp/consomm/{vehicule}', 'ChargeImpController@filtreMoisVehicule')->name('chargeImp.filtreMoisVehicule');
    //Route::patch('/chargeImp/consomm/{vehicule}', 'ChargeImpController@storeRessource')->name('chargeImp.storeRessource');

    Route::get('/chargeImp/imputation', 'ChargeImpController@index')->name('chargeImp.index');
    Route::get('/chargeImp/imputation', 'ChargeImpController@rapport')->name('chargeImp.rapport');



    //===========================route missionnaire

    Route::get('/agentMiss', 'AgentMissController@index')->name('agentMiss.index');
    Route::get('/agentMiss/reponse', 'AgentMissController@reponse')->name('agentMiss.reponse');
    Route::get('/agentMiss/reponse/{attribution}', 'AgentMissController@showReponse')->name('reponse.show');

    Route::get('/agentMiss/reponse/{mission}', 'AgentMissController@reponse')->name('agentMiss.detailsReponse');
    Route::get('/agentMiss/demandeVehicule', 'AgentMissController@newDemande')->name('mission.create');
    Route::post('/mission/store', 'AgentMissController@storeDemande')->name('mission.storeDemande');
    //Route::post('/mission/store', 'AgentMissController@demanderVehicule')->name('mission.store');

    Route::get('/mission/{mission}', 'MissionController@show')->name('mission.show');
    Route::get('/mission/{mission}/destroy', 'MissionController@destroy');
    Route::get('/mission/{mission}/edit', 'MissionController@edit');
    Route::post('/mission/{mission}/update', 'MissionController@update');

    Route::post('/agentMiss/filtreDemande', 'AgentMissController@filtreDemande')->name('agentMiss.filtreDemande');
    Route::post('/agentMiss/filtreReponse', 'AgentMissController@filtreReponse')->name('agentMiss.filtreReponse');

    Route::get('/agentMiss/filtreDemande', 'AgentMissController@index');
    Route::get('/agentMiss/filtreReponse', 'AgentMissController@reponse');



    //===========================route admin

    Route::get('/admin/utilisateurs', 'AdminController@index')->name('admin.index');
    Route::post('/admin/utilisateurs', 'AdminController@store')->name('admin.store');
    Route::delete('/admin/utilisateurs/{user}', 'AdminController@destroy')->name('admin.destroy');
    Route::get('/admin/utilisateurs/{user}', 'AdminController@show')->name('admin.show');
    Route::patch('/admin/utilisateurs/{user}', 'AdminController@update')->name('admin.update');
    Route::Post('/admin/utilisateurs/{user}', 'AdminController@storeRole')->name('admin.storeRole');
    Route::get('/admin/users/{user}', 'AdminController@index');
    Route::delete('/admin/users/{user}', 'AdminController@destroyRole')->name('admin.destroyRole');

    Route::get('/admin/compte/{user}', 'AdminController@index');
    Route::post('/admin/compte/{user}', 'AdminController@activer')->name('admin.activer');
    Route::patch('/admin/compte/{user}', 'AdminController@desactiver')->name('admin.desactiver');

    Route::get('/admin/agents', 'AdminController@indexAgent')->name('admin.indexAgent');
    Route::post('/admin/agents', 'AdminController@storeAgent')->name('admin.storeAgent');
    Route::get('/admin/agents/{agent}', 'AdminController@editAgent')->name('admin.editAgent');
    Route::patch('/admin/agents/{agent}', 'AdminController@updateAgent')->name('admin.updateAgent');
    Route::delete('/admin/agents/{agent}', 'AdminController@destroyAgent')->name('admin.destroyAgent');

    Route::get('/admin/agent', 'AdminController@indexAgent')->name('admin.indexAgent');
    Route::post('/admin/agent', 'AdminController@rechercheAgent')->name('admin.rechercheAgent');
});
