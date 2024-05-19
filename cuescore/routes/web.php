<?php

use Illuminate\Support\Facades\Route;

// Home page / welcome 
Route::get('/', 'App\Http\Controllers\RankingController@init')->name('welcome');

// Tournament details page
Route::post('/details', 'App\Http\Controllers\TournamentDetailsController@signUp');
Route::get('/details/{id}', 'App\Http\Controllers\TournamentDetailsController@init')->name('details');
