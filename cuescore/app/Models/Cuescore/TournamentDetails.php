<?php

namespace App\Models\Cuescore;

class TournamentDetails extends Cuescore
{
    // Tournament identifier
    public int $tournament_id = 0;

    // Tournament data
    public array $tournament_data = []; 

    /**
     * Base constructor that sets the tournament data so it can be used
     *
     * @param integer $id
     */
    public function __construct(int $id) 
    {
        $this->setTournamentId($id);
        // Load data from Cuescure based on given ID
        $this->initTournamentDataFromCuescore();
    }

    /**
     * Set and map the tournamentdata retrieved from Cuescore
     *
     * @param array $data
     * @return void
     */
    private function setAndMapTournamentData(array $data)
    {
        $this->setTournamentData($data);
        $this->mapTournamentData();
    }

    /**
     * Map the tournament data retrieved from Cuescore
     *
     * @param array $data
     * @return void
     */
    private function mapTournamentData()
    {
        // Format time into site timezone
        if(!empty($this->tournament_data['starttime'])){
            $this->tournament_data['starttime'] = $this->convertDateTimeToLocal($this->tournament_data['starttime']);
        }

        if(!empty($this->tournament_data['stoptime'])){
            $this->tournament_data['stoptime'] = $this->convertDateTimeToLocal($this->tournament_data['stoptime']);
        }

        if(!empty($this->tournament_data['deadline'])){
            $this->tournament_data['deadline'] = $this->convertDateTimeToLocal($this->tournament_data['deadline']);
        }

        // Fill in image urls for the different disciplines
        switch($this->tournament_data['discipline'])
        {

            case "9-Ball":
                $this->tournament_data['image_path'] = '/images/9-ball.jpg';
                break;

            case "10-Ball":
                $this->tournament_data['image_path'] = '/images/10-ball.jpg';
                break; 

            case "8-Ball":
                $this->tournament_data['image_path'] = '/images/8-ball.jpg';
                break;

            default:
                $this->tournament_data['image_path'] = '/images/renes.jpg';
                break;
        }
    }

    /**
     * Tournament data getter
     *
     * @return array
     */
    public function getTournamentData()
    {
        return $this->tournament_data;
    }

    /**
     * Tournament data setter
     *
     * @param array $data
     * @return void
     */
    public function setTournamentData(array $data)
    {
        $this->tournament_data = $data;
    }

    /**
     * Initialize the tournament data from Cuescure, uses the setted tournament id from the class
     *
     * @param integer $id
     * @return void
     */
    private function initTournamentDataFromCuescore()
    {
        $this->setAndMapTournamentData($this->getCuescoreAPIData($this->getTournamentUrl()));
    }

    /**
     * Get the URL builded with the set tournamentd id from the class
     *
     * @return void
     */
    public function getTournamentUrl()
    {
        return $this->cuescore_api_url . "/tournament/?id=" . $this->getTournamentId();
    }

    /**
     * Get the tournament id
     *
     * @return void
     */
    public function getTournamentId()
    {
        return $this->tournament_id;
    }

    /**
     * Set the tournament id
     *
     * @param integer $id
     * @return void
     */
    private function setTournamentId(int $id){
        $this->tournament_id = $id; 
    }
}