<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Micheal
 * Date: 7/21/13
 * Time: 10:16 PM
 * To change this template use File | Settings | File Templates.
 */

class getExchange
{
    public $currencies;
    private $jsonUrl;
    protected $rates;
    protected $amount;

    function getCurrencies()
    {
        $this->jsonUrl = 'http://openexchangerates.org/api/currencies.json?app_id=3ffa5215b2c249739bbde180069873c5';

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

        // Will dump a beauty json :3
        json_decode($result,true);

        //split, and replace json string and dump into array
        $patterns[0] = '|"|';
        $patterns[1] = '|{|';
        $patterns[2] = '|}|';
        $pattern = '|: |';

        $result = preg_replace($patterns,"", $result);
        $result = preg_replace($pattern, ' - ', $result);

        //get currencies abreviation
        preg_match_all('|[[:upper:]]{3}|',$result, $currAbreviation,PREG_PATTERN_ORDER);

        $result = preg_split('|,|', $result);

        $this -> currencies[0] = $result;
        $this -> currencies[1] = $currAbreviation;

        return $this->currencies;
    }

    function getExchangeRates()
    {
        $this->jsonUrl = 'http://openexchangerates.org/api/latest.json?app_id=3ffa5215b2c249739bbde180069873c5';

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


        $this -> rates = json_decode($result,true);

        return $this -> rates;
    }

    function calcRates($amount, $to, $from)
    {
        if (empty($amount))
        {
            //redirect
            echo 'STUPID!';
            exit;
        }

        $fromCurrency = $from;
        $toCurrency = $to;
        $fromRate = $this -> rates['rates'][$fromCurrency];
        $toRate = $this -> rates['rates'][$toCurrency];

        /*print_r($fromRate);
        echo '<br><br>';
        print_r($toRate);*/

        //equation for exchange is from * to = amount
        $this -> amount = $amount * $toRate;
        setlocale(LC_MONETARY, 'en_US');
        $this -> amount = number_format($this -> amount,2);

        return $this -> amount;
    }
}

?>