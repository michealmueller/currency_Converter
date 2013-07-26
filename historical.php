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

    function cacheHistoricalData()
    {
        $months = array('01'=>'31', '02'=>'28', '03'=>'31', '04'=>'30', '05'=>'31', '06' =>'30', '07'=>'31', '08'=>'31', '09'=>'30', '10'=>'31', '11'=>'30', '12'=>'31');
        $year = '2013';
        foreach($months as $key => $value)
        {
            //$daysInMonth = $value;
            for ($i=1; $i <= $value; $i++)
            {
                $length = strlen($i);
                if ($length < 2)
                {
                    $i = '0' . $i;
                }
                $date = $year . '-' . $key . '-' . $i;

                $data = self::getHistorical($date);
                print_r($data['rates']);
            }
        }
    }
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
