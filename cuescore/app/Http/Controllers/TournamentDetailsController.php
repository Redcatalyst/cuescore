<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuescore\TournamentDetails;

class TournamentDetailsController extends Controller
{
    
    public function init(string $id)
    {
        return $this->render($id);
    }

    private function render(int $id)
    {
        $tournament = new TournamentDetails($id);
        return view(
            'tournament-details', 
            [
                "tournament" => $tournament->getTournamentData()
            ]
        );
    }

}
