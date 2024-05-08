<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\RankingController@init')->name('welcome');
Route::get('/details/{id}', 'App\Http\Controllers\TournamentDetailsController@init')->name('details');