<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'contratos',
    'namespace' => 'contratos'
], function ($router) {
    //rutas para el Area 
    Route::post('crear', 'Contratocontroller@create');
    Route::get('tipos-contrato', 'Contratocontroller@listarTipo');
     
});