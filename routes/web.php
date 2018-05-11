<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['ajax'])->group( function(){
    
});

Route::get('/Tarea','TareaController@index')->name('Tarea');
Route::post('/Tarea','TareaController@store')->name('CrearTarea');
Route::put('/Tarea/{id}', 'TareaController@update')->name('ActualizarTarea');
Route::delete('/Tarea/{id}', 'TareaController@delete')->name('EliminarTarea');

Route::get('/Tarea-Paginado', 'TareaController@paginado')->name('Tarea-paginado');