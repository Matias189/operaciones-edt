<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('user/prueba', 'UserController@prueba')->name('user.prueba');

// Ruta perfil OPERACIONES
Route::get('user/admin', 'UserController@adminAccount')->middleware('can:user.panel1')->name('user.admin');

// Ruta cambiar contraseña OPERACIONES
Route::get('user/admin-password', 'UserController@passwordAdmin')->name('user.passwordAdmin');

// Ruta cambiar contraseña departamentos
Route::post('user/cambiar-contraseña-admin', 'UserController@changePasswordAdmin')->name('user.changePasswordAdmin');



// Ruta peril departamentos
Route::get('user/perfil', 'UserController@account')->name('user.account');

// Ruta formulario cambiar contraseña departamentos
Route::get('user/contraseña', 'UserController@password')->name('user.password');

// Ruta cambiar contraseña departamentos
Route::post('user/cambiar-contraseña', 'UserController@changePassword')->name('user.changePassword');



// Ruta enviar solicitud
Route::put('departamento/sendForm/{id}', 'FormController@sendForm')->middleware('can:departamento.sendForm')->name('departamento.sendForm');

// Ruta completar requerimiento
Route::put('operaciones/resolution/{id}', 'PetitionController@resolution')->middleware('can:operaciones.resolution')->name('operaciones.resolution');

// Ruta aprobar requerimiento
Route::put('operaciones/approve/{id}', 'PetitionController@approve')->middleware('can:operaciones.approve')->name('operaciones.approve');

// Controladores
Route::resource('operaciones', 'PetitionController')->middleware('can:operaciones'); 
Route::resource('departamento', 'FormController')->middleware('can:departamento');

