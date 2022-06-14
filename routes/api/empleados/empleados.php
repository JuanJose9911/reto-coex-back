<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'empleados',
    'namespace' => 'empleados'
], function ($router) {
    //rutas para el Area 
    Route::post('crear', 'EmpleadoController@create');
    Route::put('editar/{id}', 'EmpleadoController@edit');
    Route::get('listar', 'EmpleadoController@list');
    Route::get('listar/{id}', 'EmpleadoController@listDetail');
    Route::delete('eliminar/{id}', 'EmpleadoController@delete');


    //Generar PDF's
    Route::get('pdf-empleados', 'EmpleadoController@generarPDF');
    Route::get('pdf-empleado/{id}', 'EmpleadoController@detallePDF');
     
});