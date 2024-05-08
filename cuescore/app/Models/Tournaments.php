<?php

namespace App\Models;
 
use Illuminate\Support\Facades\DB;

class Tournaments
{
    public function getTournaments()
    {
        return DB::select('SELECT * FROM tournaments');
    }
}