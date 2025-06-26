<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class MemoryGameController extends Controller
{
    public function show()
    {
        $countries = Country::inRandomOrder()->limit(15)->get();
        return view('memory_game', compact('countries'));
    }

}
