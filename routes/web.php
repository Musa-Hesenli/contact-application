<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group( [
    'prefix'     => 'auth',
    'middleware' => 'guest'
], function () {
    Route::get( 'login', function () {
        return view( 'auth.login' );
    } )->name( 'login' );
    Route::get( 'register', function () {
        return view( 'auth.register' );
    } )->name( 'register' );

    Route::post( 'login', [ \App\Http\Controllers\Auth\AuthController::class, 'login' ] );
    Route::post( 'register', [ \App\Http\Controllers\Auth\AuthController::class, 'register' ] );
} );

Route::group( [
    'middleware' => 'auth'
], function () {
    Route::get( '', [ \App\Http\Controllers\Pages\ContactsController::class, 'index' ] )->name( 'home-page' );
    Route::get( 'create', [ \App\Http\Controllers\Pages\ContactsController::class, 'create' ] )->name( 'create-contact' );
    Route::post( 'create', [ \App\Http\Controllers\Pages\ContactsController::class, 'store' ] );

    Route::get( 'edit/{id}', [ \App\Http\Controllers\Pages\ContactsController::class, 'edit' ] )->name( 'edit-contact' );
    Route::post( 'update/{id}', [ \App\Http\Controllers\Pages\ContactsController::class, 'update' ] )->name( 'update-contact' );
    Route::delete( 'delete/{id}', [ \App\Http\Controllers\Pages\ContactsController::class, 'destroy' ] );

    Route::get( 'view-on-map/{id}', [ \App\Http\Controllers\Pages\ContactsController::class, 'showOnMap' ] )->name( 'show-on-map' );
    Route::get(  'logout', [ \App\Http\Controllers\Auth\AuthController::class, 'logout' ])->name( 'logout' );

    Route::get( 'export', [ \App\Http\Controllers\Pages\ContactsController::class, 'export' ] )->name( 'export' );
} );
