<?php

use App\Http\Controllers\CapitalQuizController;
use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/countries', [CountryController::class, "index"]);


// Mostra la domanda del quiz
Route::get('/quiz', [CapitalQuizController::class, "showQuestion"])->name("quiz.show");

// Controlla la risposta selezionata
Route::post('/quiz', [CapitalQuizController::class, 'checkAnswer'])->name('quiz.check');
