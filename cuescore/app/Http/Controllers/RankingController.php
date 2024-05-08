<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuescore\RankingDetails;

class RankingController extends Controller
{
    
    public function init()
    {
        return $this->render();
    }

    private function render()
    {
        $data = new RankingDetails();
        return view(
            'welcome', 
            [
                "ranking" => $data->getRankingData(), 
                "tournaments" => $data->getTournamentData()
            ]
        );
    }

}
