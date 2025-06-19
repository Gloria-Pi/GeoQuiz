<?php

use App\Http\Controllers\CapitalQuizController;
use App\Http\Controllers\CountryController;
use App\Models\HighScore;
use Illuminate\Support\Facades\Route;



// La Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Mostra la vista con tutte le countries
Route::get('/countries', [CountryController::class, "index"])->name('countries.index');

// Resetta la sessione di gioco quando si clicca sul pulsante "Capitals Quiz" sulla Home
Route::get('/capitals-quiz-start', function () {
    session()->forget(['score', 'question_count']);
    return redirect()->route('quiz.show');
})->name('quiz.start');

// Mostra la domanda del quiz
Route::get('/quiz', [CapitalQuizController::class, "showQuestion"])->name("quiz.show");

// Controlla la risposta selezionata
Route::post('/quiz', [CapitalQuizController::class, 'checkAnswer'])->name('quiz.check');

// Per resettare il gioco
Route::post('/quiz/reset', function () {
    session()->forget(['score', 'question_count']);
    return redirect()->route('quiz.show');
})->name('quiz.reset');

// Mostra gli high scores
Route::get('/high-scores', function () {
    $highScores = HighScore::orderByDesc('score')->take(10)->get();
    return view('high_scores', ['highScores' => $highScores]);
})->name('highscores');