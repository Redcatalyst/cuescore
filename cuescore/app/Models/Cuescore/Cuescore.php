<?php

namespace App\Models\Cuescore;

use DateTime;
use DateTimeZone;

abstract class Cuescore
{
    // Cuescore raning ID
    protected int $ranking_id = 38820973;
    
    // Base API endpoint URL 
    protected string $cuescore_api_url = 'https://api.cuescore.com/';

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    protected function getCuescoreAPIData(string $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
        $response = curl_exec ($ch);
        $err = curl_error($ch);
        curl_close ($ch);
        if($err){
            throw "Error in retrieving data";
        }
        return json_decode($response, true); 
    }

    /**
     * Undocumented function
     *
     * @param string $cuescore_date
     * @return void
     */
    public function convertDateTimeToLocal(string $cuescore_date)
    {
        // create a $dt object with the UTC timezone
        $dt = new DateTime($cuescore_date, new DateTimeZone('Europe/Amsterdam'));
        return date_format($dt,'Y-m-d H:i:s');
    }

}
