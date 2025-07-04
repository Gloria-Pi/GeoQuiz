<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CapitalQuizController;
use App\Http\Controllers\FlagQuizController;
use App\Http\Controllers\FlhardController;
use App\Http\Controllers\MemoryGameController;
use App\Models\HighScore;
use App\Models\HardScore;
use App\Models\FlagHardScore;
use Illuminate\Support\Facades\Route;



// La Home
Route::get('/', function () {
    return view('home');
})->name('home');



// Mostra la vista con tutte le countries
Route::get('/countries', [CountryController::class, "index"])->name('countries.index');



// QUIZ CAPITALI -----------------------------------------

// Resetta la sessione di gioco quando si clicca sul pulsante "Capitals Quiz" sulla Home
Route::get('/capitals-quiz-start', function () {
    // Rimuove punteggio e progressi precedenti
    session()->forget(['score', 'question_count', 'score_saved', 'player_name', 'answers', 'history']);
    return view('pick_difficulty'); // fa scegliere la difficoltà
})->name('quiz.pick');

Route::get('/capitals-quiz-start-normalmode', function () {
    return view('enter_name'); // form del nome
})->name('quiz.start');

// Mostra la domanda del quiz
Route::get('/quiz', [CapitalQuizController::class, 'showQuestion'])->name('quiz.show');

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


// QUIZ CAPITALI HARD MODE -----------------------------------------

// form del nome
Route::get('/capitals-quiz-start-hardmode', function () {
    return view('hard_enter_name');
})->name('hard-quiz.start');

// Mostra la domanda del quiz
Route::get('/hard-quiz', [CapitalQuizController::class, 'showHardQuestion'])->name('hard-quiz.show');

// Controlla la risposta selezionata
Route::post('/hard-quiz', [CapitalQuizController::class, 'checkHardAnswer'])->name('hard-quiz.check');

// Per resettare il gioco
Route::post('/hard-quiz/reset', function () {
    session()->forget(['score', 'question_count']);
    return redirect()->route('hard-quiz.show');
})->name('hard-quiz.reset');

// Mostra gli high scores
Route::get('/hard-scores', function () {
    $hardScores = HardScore::orderByDesc('score')->take(10)->get();
    return view('hard_scores', ['hardScores' => $hardScores]);
})->name('hardscores');


// QUIZ FLAGS -----------------------------------------

// Mostra il form per inserire il nome del giocatore
Route::get('/flagquiz', function () {
    return view('flag_pick_difficulty'); // fa scegliere la difficoltà
})->name('flag-quiz.pick');

Route::get('/flag-quiz-start-normalmode', function () {
    return view('flag_quiz_start');
})->name('flagquiz.startForm');

// Invia il nome del giocatore e inizia il quiz
Route::post('/flag_quiz_start', [FlagQuizController::class, 'start'])->name('flagquiz.start');

// Mostra una domanda
Route::get('/flagquiz/question', [FlagQuizController::class, 'showQuestion'])->name('flagquiz.show');

// Invia la risposta a una domanda
Route::post('/flagquiz/answer', [FlagQuizController::class, 'checkAnswer'])->name('flagquiz.check');

// Mostra il risultato finale
Route::get('/flagquiz/result', [FlagQuizController::class, 'result'])->name('flagquiz.result');

// Per resettare il gioco
Route::post('/flagquiz/reset', [FlagQuizController::class, 'reset'])->name('flagquiz.reset');

// Mostra gli high scores
Route::get('/flagquiz/leaderboard', [FlagQuizController::class, 'leaderboard'])->name('flagquiz.leaderboard');


// QUIZ FLAGS HARD MODE -----------------------------------------

// Mostra il form per inserire il nome del giocatore
Route::get('/flhard', function () {
    return view('flhard_start');
})->name('flhard.startForm');

// Invia il nome del giocatore e inizia il quiz
Route::post('/flhard_start', [FlhardController::class, 'start'])->name('flhard.start');

// Mostra una domanda
Route::get('/flhard/question', [FlhardController::class, 'showQuestion'])->name('flhard.show');

// Invia la risposta a una domanda
Route::post('/flhard/answer', [FlhardController::class, 'checkAnswer'])->name('flhard.check');

// Mostra il risultato finale
Route::get('/flhard/result', [FlhardController::class, 'result'])->name('flhard.result');

// Per resettare il gioco
Route::post('/flhard/reset', [FlhardController::class, 'reset'])->name('flhard.reset');

// Mostra gli high scores
Route::get('/flhard/leaderboard', [FlhardController::class, 'leaderboard'])->name('flhard.leaderboard');


// TRAINING SECTION -----------------------------------------

// Mostra il training per il quiz sulle capitali
Route::get('/capitals-training', [CapitalQuizController::class, 'training'])->name('quiz.training');

// Mostra il training per il quiz sulle bandiere
Route::get('/flagquiz/training', [FlagQuizController::class, 'training'])->name('flagquiz.training');

// MEMORY SECTION -----------------------------------------
Route::get('/memory', [MemoryGameController::class, 'show'])->name('memory.show');
