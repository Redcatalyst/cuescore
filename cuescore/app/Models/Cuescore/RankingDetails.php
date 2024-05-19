<?php

namespace App\Models\Cuescore;

class RankingDetails extends Cuescore
{
    // Ranking data
    public array $ranking_data = []; 

    // Tournaments data
    public array $tournaments_data = []; 

    /**
     * Base constructor that sets the ranking data so it can be used
     *
     * @param integer $id
     */
    public function __construct() 
    {
        $this->initTournamentAndRankingData();
    }

    /**
     * Get the ranking api url
     *
     * @return void
     */
    private function getRankingUrl()
    {
        return $this->cuescore_api_url . "/ranking/?id=" . env('CUESCORE_RANKING_ID');
    }

    /**
     * Retrieve the ranking data from Cuescore.
     * This contains both the ranking and upcomming tournament data
     *
     * @return void
     */
    private function initTournamentAndRankingData()
    {
        $this->setAndMapTournamentAndRankingData($this->getCuescoreAPIData($this->getRankingUrl()));
    }

    /**
     * Set and map tournament and rankingdata 
     *
     * @param array $data
     * @return void
     */
    private function setAndMapTournamentAndRankingData(array $data)
    {
        if(!empty($data['participants']))
        {
            $this->setRankingData($data['participants']);
            $this->mapRankingData();
        }

        if(!empty($data['tournaments']))
        {
            $this->setTournamentData($data['tournaments']);
            $this->mapTournamentsData();
        }
    }

    /**
     * Map and extend the ranking data
     *
     * @return void
     */
    public function mapRankingData()
    {
        $new_array_with_ranking_ids = [];
        if(!empty($this->ranking_data)){
            foreach($this->ranking_data as $ranking_key => $ranking_value){
                $new_array_with_ranking_ids[$ranking_value['participantId']] = $ranking_value;
            }
        }
        $this->setRankingData($new_array_with_ranking_ids);
    }

    /**
     * Map and extend the tournament data with custom data
     *
     * @return void
     */
    public function mapTournamentsData()
    {
        if(!empty($this->tournaments_data)){
            foreach($this->tournaments_data as $tournament_key => $tournament_value){
                // Format time into site timezone
                if(!empty($tournament_value['starttime'])){
                    $tournament_value['starttime'] = $this->convertDateTimeToLocal($tournament_value['starttime']);
                }
                if(!empty($tournament_value['stoptime'])){
                    $tournament_value['stoptime'] = $this->convertDateTimeToLocal($tournament_value['stoptime']);
                }
                $check_value = strtolower($tournament_value['name']);
                if(str_contains($check_value, '9-ball')){
                    $tournament_value['type'] = '9-ball';
                    $tournament_value['image'] = '/images/9-ball.jpg';
                } else if(str_contains($check_value, '10-ball')){
                    $tournament_value['type'] = '10-ball';
                    $tournament_value['image'] = '/images/10-ball.jpg';
                } else if(str_contains($check_value, '8-ball')){
                    $tournament_value['type'] = '8-ball';
                    $tournament_value['image'] = '/images/8-ball.jpg';
                } else {
                    $tournament_value['type'] = 'undefined';
                    $tournament_value['image'] = '/images/renes.jpg';
                }
    
                $this->tournaments_data[$tournament_key] = $tournament_value;
            }
        } else {
            throw error('Noting to map. Check the data!');
        }
    }

    /**
     * Ranking data getter
     *
     * @return void
     */
    public function getRankingData()
    {
        return $this->ranking_data;
    }

    /**
     * Ranking data setter
     *
     * @param arrau $data
     * @return void
     */
    public function setRankingData(array $data)
    {
        $this->ranking_data = $data;
    }

    /**
     * Tournament data getter
     *
     * @return void
     */
    public function getTournamentData()
    {
        return $this->tournaments_data;
    }

    /**
     * Tournament data setter
     *
     * @param array $data
     * @return void
     */
    public function setTournamentData(array $data)
    {
        $this->tournaments_data = $data;
    }

}