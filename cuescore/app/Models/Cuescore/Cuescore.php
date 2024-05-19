<?php

namespace App\Models\Cuescore;

use DateTime;
use DateTimeZone;

abstract class Cuescore
{
    // Base API endpoint URL 
    protected string $cuescore_api_url = 'https://api.cuescore.com/';

    /**
     * Execute an API call with the given url
     * Todo: create proper errorhandling for exceptions
     *
     * @param string $url
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
     * Convert the data from Cuescore into something more readable for the users
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
