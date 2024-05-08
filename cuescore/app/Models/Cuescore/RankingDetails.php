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
        $this->getRankingDataFromCuescore();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function getRankingUrl()
    {
        return $this->cuescore_api_url . "/ranking/?id=" . $this->ranking_id;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function getRankingDataFromCuescore()
    {
        $this->setRankingData($this->getCuescoreAPIData($this->getRankingUrl()));
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    private function setRankingData(array $data)
    {
        if(!empty($data['participants']))
        {
            $this->ranking_data = $data['participants'];
        }

        if(!empty($data['tournaments']))
        {
            $this->tournaments_data = $data['tournaments'];
            $this->mapTournamentsData();
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function mapTournamentsData()
    {
        foreach($this->tournaments_data as $tournament_key => $tournament_value){
            // Format time into site timezone
            if(!empty($tournament_value['starttime'])){
                $tournament_value['starttime'] = $this->convertDateTimeToLocal($tournament_value['starttime']);
            }
            if(!empty($tournament_value['stoptime'])){
                $tournament_value['stoptime'] = $this->convertDateTimeToLocal($tournament_value['stoptime']);
            }
            $this->tournaments_data[$tournament_key] = $tournament_value;
        }
        
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getRankingData()
    {
        return $this->ranking_data;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getTournamentData()
    {
        return $this->tournaments_data;
    }

}