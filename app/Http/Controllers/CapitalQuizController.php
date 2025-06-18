<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CapitalQuizController extends Controller
{
    public function showQuestion(Request $request)
    {
        // Genera una nuova domanda SOLO se non c'è risposta
        if (!$request->has('selected')) {
            $country = Country::inRandomOrder()->first();
            $correctCapital = $country->capital;

            // Prendi altre 2 capitali sbagliate
            $otherCapitals = Country::where('alpha3Code', '!=', $country->alpha3Code)
                ->inRandomOrder()
                ->limit(2)
                ->pluck('capital')
                ->toArray();

            $options = $otherCapitals;
            $options[] = $correctCapital;
            shuffle($options);

            return view('quiz', [
                'country' => $country,
                'options' => $options,
                'answerChecked' => false
            ]);
        }

        // Se invece stai postando una risposta (dopo il click su un bottone)
        return $this->checkAnswer($request);
    }

    public function checkAnswer(Request $request)
    {
        $alpha3Code = $request->input('country_code');
        $selected = $request->input('answer');
        
        $country = Country::where('alpha3Code', $alpha3Code)->firstOrFail();
        $correctCapital = $country->capital;
        $isCorrect = $selected === $correctCapital;
    
        // Se answer è empty (caso in cui il tempo è scaduto)
        $timeout = false;
        if (empty($selected)) {
            $isCorrect = false;
            $timeout = true;
        } else {
            $isCorrect = $selected === $correctCapital;
        }

        // Usa le stesse opzioni inviate nel form
        $options = $request->input('options', []);
    
        return view('quiz', [
            'country' => $country,
            'options' => $options,
            'answerChecked' => true,
            'selected' => $selected,
            'correctCapital' => $correctCapital,
            'isCorrect' => $isCorrect,
            'timeout' => $timeout
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}