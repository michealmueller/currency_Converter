<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Micheal
 * Date: 7/24/13
 * Time: 8:36 PM
 * To change this template use File | Settings | File Templates.
 */

require_once 'exchanges.php';

//todo: current month to current day above last month current day

class getHistory
{
    protected $history;
    private $jsonUrl;
    public $data;
    protected $formattedDate;
    protected $date;
    protected $graphData;

    function cacheSpecificHistoricalData($symbol='EUR', $month='06', $year='2013')
    {
        $months = array('01'=>'31', '02'=>'28', '03'=>'31', '04'=>'30', '05'=>'31', '06'=>'30', '07'=>'31', '08'=>'31', '09'=>'30', '10'=>'31', '11'=>'30', '12'=>'31');

            for ($i=1; $i <= $months[$month]; $i++)
            {
                $arrayNumber = $i;
                //append a 0 to date for API query
                $length = strlen($i);
                if ($length < 2)
                {
                    $i = '0' . $i;
                }

                $this -> formattedDate[$arrayNumber] = '["'.$year.'-'.$month.'-'.$i.'",';

                $rateDate = $year.'-'.$month.'-'.$i;
                $this->data[$arrayNumber] = self::getHistoricalData($rateDate);
            }

        for($o=1; $o<=$months[$month]; $o++)
        {
            $this->formattedDate[$o] = $this->formattedDate[$o] . ' ' . $this->data[$o]['rates'][$symbol] . '],';
        }
        return $this->formattedDate;
    }

    function getHistoricalData($historicalDate)
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
    function formatGraphData()
    {
        $splitDate = preg_split('|-|', $this -> formattedDate);

        $this -> graphData = '["'.$splitDate[0].'-'.$splitDate[1].'-'.$splitDate[2].'",'. $rate .']';
        //echo $this ->graphData;
    }

    function cacheAllHistoricalData($month)
    {
        $months = array('01'=>'31', '02'=>'28', '03'=>'31', '04'=>'30', '05'=>'31', '06'=>'30', '07'=>'31', '08'=>'31', '09'=>'30', '10'=>'31', '11'=>'30', '12'=>'31');
        $year = '2013';
        foreach($months as $key => $value)
        {
            for ($i=1; $i <= $value; $i++)
            {
                //append a 0 to date for API query
                $length = strlen($i);
                if ($length < 2)
                {
                    $i = '0' . $i;
                }

                //$date = $year . '-' . $key . '-' . $i;            //live setting
                $this -> date = $year.'-'.$month.'-'.$i;                        //dev setting

                //$this->data = self::getHistoricalData($date);
                //print_r($this->data);
            }
        }
        return $this -> formattedDate;
    }
}
