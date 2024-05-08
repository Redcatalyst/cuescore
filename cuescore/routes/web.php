<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/new', function () {
    return view('new-tournament');
})->name('new');

Route::get('/details/{id}', function ($id) {
    return view('tournament-details', ['id' => $id]);
})->name('details');

Route::get('/', 'App\Http\Controllers\TournamentController@home');