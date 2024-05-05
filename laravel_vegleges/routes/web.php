<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Character;
use App\Models\Contest;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\PlaceController;


Route::get('/', function () {
    return view('welcome');
});





Route::middleware('auth')->group(function () {

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index');

    Route::middleware(['auth', 'can:view,character'])->group(function () {
        Route::get('/characters/{character}', [CharacterController::class, 'show'])->name('characters.show');
    });

    Route::get('/create', [CharacterController::class, 'create'])->name('characters.create');
    Route::post('/characters', [CharacterController::class, 'store'])->name('characters.store');

    Route::middleware(['auth', 'can:update,character'])->group(function () {
        Route::get('/characters/{character}/edit', [CharacterController::class, 'edit'])->name('characters.edit');
    });

    Route::patch('/characters/{character}', [CharacterController::class, 'update'])->name('characters.update');
    Route::delete('/characters/{character}', [CharacterController::class, 'destroy'])->name('characters.destroy');


    Route::post('/characters/{character}/contest', [CharacterController::class, 'createContest'])->name('characters.contest');

    Route::get('/contests/{contest}', [ContestController::class, 'show'])->name('contest.show');

    Route::post('/contest/{contest}/{attackType}', [ContestController::class, 'attack'])->name('contest.attack');

    Route::get('/places', 'App\Http\Controllers\PlaceController@index')->name('places.index');
    Route::get('/places/{place}/edit', 'App\Http\Controllers\PlaceController@edit')->name('places.edit');
    Route::put('/places/{place}', 'App\Http\Controllers\PlaceController@update')->name('places.update');
    Route::delete('/places/{place}', 'App\Http\Controllers\PlaceController@destroy')->name('places.destroy');

    Route::get('/places/create', 'App\Http\Controllers\PlaceController@create')->name('places.create');
    Route::post('/places', 'App\Http\Controllers\PlaceController@store')->name('places.store');
});





Route::get('/', function () {
    $totalCharacters = Character::count();
    $totalContests = Contest::count();

    return view('welcome', compact('totalCharacters', 'totalContests'));
});

require __DIR__ . '/auth.php';
