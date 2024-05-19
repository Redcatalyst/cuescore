<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuescore\TournamentDetails;
use App\Models\TournamentMessenger;

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

    /**
     * Send a message for sign up
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signUp(Request $request)
    {
        $validated = $request->validate([
            'cuescoreName' => 'required|max:255',
            'cuescoreLink' => 'nullable',
            'phonenumber' => 'required',
            'checkbox' => 'required',
            'tournament' => 'required'
        ]);

        $messenger = new TournamentMessenger();
        $message = $messenger->generateSignUpMessage($request->all());
        $messenger->sendMessage($message, 'WA');
        
        return $this->render($request->tournament);
    }

}
