<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Micheal
 * Date: 7/24/13
 * Time: 8:36 PM
 * To change this template use File | Settings | File Templates.
 */

class getHistory
{
    protected $history;
    private $jsonUrl;

    function getHistorical($historicalDate)
    {
        //specify date as YYYY-MM-DD when calling this function
        $date = $historicalDate;

        $this->jsonUrl = 'http://openexchangerates.org/api/historical/' . $date . '.json?app_id=3ffa5215b2c249739bbde180069873c5';

        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$this->jsonUrl);
        // Execute
        $result=curl_exec($ch);


        $this -> history = json_decode($result, true);

        return $this -> history;
    }
}
