<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\FlagScore;

class FlagQuizController extends Controller
{
    public function showQuestion(Request $request)
    {
        $questionNumber = session('flag_questionNumber', 1);
        $score = session('flag_score', 0);

        // if ($questionNumber > 10) {
        //     // Salva il punteggio nel DB prima di reindirizzare
        //     FlagScore::create([
        //         'player_name' => session('flag_player_name', 'Anonymous'),
        //         'score' => $score,
        //     ]);

        //     return redirect()->route('flagquiz.result')->with([
        //         'score' => $score,
        //         'history' => session('flag_history', []),
        //     ]);
        // }

        if ($questionNumber > 10) {
            return redirect()->route('flagquiz.result');
        }



        $country = Country::inRandomOrder()->first();
        $correctCode = $country->alpha2Code;

        // Trova 2 bandiere sbagliate
        $otherOptions = Country::where('alpha2Code', '!=', $correctCode)
                                ->inRandomOrder()
                                ->limit(2)
                                ->pluck('alpha2Code')
                                ->toArray();

        $options = $otherOptions;
        $options[] = $correctCode;
        shuffle($options);

        // DA TESTARE
        // Mapping opzioni → alpha2Code
        $optionFlags = Country::whereIn('alpha2Code', $options)
            ->pluck('alpha2Code', 'alpha2Code')
            ->map(fn($alpha2) => strtolower($alpha2))
            ->toArray();

        $optionNames = Country::whereIn('alpha2Code', $options)
            ->pluck('name', 'alpha2Code')
            ->toArray();

        return view('flag_quiz', [
            'country' => $country,
            'options' => $options,
            'optionFlags' => $optionFlags,
            'optionNames' => $optionNames,
            'questionNumber' => $questionNumber,
            'correctCode' => $correctCode,
        ]);
    }

    public function checkAnswer(Request $request)
    {
        $selected = $request->input('answer');
        $correctCode = Country::where('alpha2Code', $request->input('country_code'))->value('alpha2Code');
        $options = $request->input('options', []);
        $questionNumber = session('flag_questionNumber', 1);
        $score = session('flag_score', 0);

        $timeout = false;
        $isCorrect = false;

        if ($selected === '') {
            // Tempo scaduto
            $timeout = true;
            $selected = null;
        } elseif ($selected === $correctCode) {
            $isCorrect = true;
            $score += 1;
        }

        $country = Country::where('alpha2Code', $request->input('country_code'))->first();

        // Recupera la history attuale dalla sessione
        $history = session('flag_history', []);

        
        // Aggiungi la risposta corrente
        $history[] = [
            'country' => $country->name,
            'userAnswer' => $selected, // alpha2Code della risposta data (o null)
            'correctCode' => $correctCode, // alpha2Code della risposta corretta
            'isCorrect' => $isCorrect,
        ];

        // Salva la nuova history in sessione
        session([
            'flag_history' => $history,
            'flag_questionNumber' => $questionNumber + 1,
            'flag_score' => $score
        ]);

        
        // DOPO aver aggiornato la sessione, controlla se era l'ultima domanda
        if ($questionNumber >= 10) {
            FlagScore::create([
                'player_name' => session('flag_player_name', 'Anonymous'),
                'score' => $score,
            ]);
            return redirect()->route('flagquiz.result');
        }

        // Ricostruzione mapping bandiere
        $optionFlags = Country::whereIn('alpha2Code', $options)
            ->pluck('alpha2Code', 'alpha2Code')
            ->map(fn($alpha2) => strtolower($alpha2))
            ->toArray();

        $optionNames = Country::whereIn('alpha2Code', $options)
            ->pluck('name', 'alpha2Code')
            ->toArray();


        return view('flag_quiz', [
            'country' => $country,
            'options' => $options,
            'selected' => $selected,
            'correctCode' => $correctCode,
            'isCorrect' => $isCorrect,
            'timeout' => $timeout,
            'questionNumber' => $questionNumber,
            'answerChecked' => true,
            'optionFlags' => $optionFlags,
            'optionNames' => $optionNames,
        ]);
    }

    public function result(Request $request)
    {
        // // Recupera i dati dalla sessione
        // $score = session('flag_score', 0);
        // $playerName = session('flag_player_name', 'Anonymous');
        // $history = session('flag_history', []);

        // // Salva il punteggio nel database
        // FlagScore::create([
        //     'player_name' => $playerName,
        //     'score' => $score,
        // ]);

        // Passa i dati alla view del risultato
        return view('flag_quiz_results', [
            'score' => session('flag_score', 0),
            'playerName' => session('flag_player_name', 'Anonymous'),
            'history' => session('flag_history', []),
        ]);
    }


    public function start(Request $request)
    {
        $request->validate([
            'player_name' => 'required|string|max:255'
        ]);

        session([
            'flag_player_name' => $request->input('player_name'),
            'flag_score' => 0,
            'flag_questionNumber' => 1
        ]);

        return redirect()->route('flagquiz.show');
    }

    public function reset(Request $request)
    {
        // Pulisci tutti i dati di sessione relativi al quiz
        session()->forget([
            'flag_score',
            'flag_questionNumber',
            'flag_questions',
            'flag_player_name',
            'flag_history',
        ]);


        // Se c'è un redirect personalizzato, vai lì
        if ($request->filled('redirect_to')) {
            return redirect($request->input('redirect_to'));
        }

        // Altrimenti torna alla pagina di start quiz
        return redirect()->route('flagquiz.startForm');
        }



    public function leaderboard()
    {
        // Prendi i migliori 10 punteggi, ordinati dal più alto
        $topScores = FlagScore::orderBy('score', 'desc')->take(10)->get();

        return view('flag_leaderboard', ['topScores' => $topScores]);
    }
}