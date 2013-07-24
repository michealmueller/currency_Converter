<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Micheal
 * Date: 7/21/13
 * Time: 9:04 PM
 * To change this template use File | Settings | File Templates.
 */

require_once 'exchanges.php';
//$exchange = new getExchange();
//$rates = $exchange -> getExchangeRates();

class rateConversion extends getExchange
{
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

        print_r($fromRate);
        echo '<br><br>';
        print_r($toRate);

        //equation for exchange is from * to = amount
        $amount = $amount * $toRate;
        $amount = round($amount, 2, PHP_ROUND_HALF_UP);

        return $amount;
    }
}
?>