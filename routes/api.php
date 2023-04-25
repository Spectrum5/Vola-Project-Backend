<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers

// Models
use App\Http\Controllers\Api\MovieController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Questa rotta restituisce l'oggetto User associato all'utente autenticato
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Questa rotta gestisce le richieste relative alle risorse di tipo Movie attraverso i metodi definiti nel MovieController
// Il middleware auth:sanctum assicura che solo gli utenti autenticati possano accedere a questa rotta
Route::resource('movies', MovieController::class)->middleware(['auth:sanctum']);