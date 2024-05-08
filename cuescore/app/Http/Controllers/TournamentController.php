<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournaments;

class TournamentController extends Controller
{
    
    public function home()
    {
        return $this->render();
    }

    private function render($items = null)
    {
        $t = new Tournaments();
        $items = $t->getTournaments();
        return view('welcome', ["items" => $items]);
    }

}
