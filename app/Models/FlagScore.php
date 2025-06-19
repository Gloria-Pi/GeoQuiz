<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlagScore extends Model
{
    // Indica i campi che possono essere riempiti
    protected $fillable = ['player_name', 'score'];
}