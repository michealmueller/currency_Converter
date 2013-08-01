<?php

require_once 'exchanges.php';

$exchange = new getExchange();
$currencies = $exchange -> getCurrencies();
$rates = $exchange -> getExchangeRates();

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/global.css" type="text/css">
</head>
<body>
    <form action="" method="post" class="form-inline">
        <label for="amount">Amount:</label>
        <input class="form-control" placeholder="Amount" id="focusedInput" type="number" name="amount" value="5" width="50px"/>
        <label for="from">From:</label>
        <select name="from" id="from">
            <option value="USD" selected>USD - United States Dollar</option>
                        <?php
                            $currencyLong = $currencies[0];
                            $currencyAbb = $currencies[1][0];

                        $currAbbCount = count($currencyAbb);
                        $currencyLongCount = count($currencyLong);

                        for($i=0; $i <= $currAbbCount; $i++)
                        {
                            echo '<option value="' . $currencyAbb[$i] .'">' . $currencyLong[$i] . '</option><br>';
                        }
                        ?>
        </select>
        <label for="to">To:</label>

                    <select name="to" id="to">
                        <?php
                            for($o=0; $o <= $currAbbCount; $o++)
                            {
                                echo '<option value="' . $currencyAbb[$o] .'">' . $currencyLong[$o] . '</option>';
                            }
                        ?>
                    </select>
        <label>&nbsp;</label>
        <input class="btn btn-primary" type="submit" value="Convert" />

<?php

if($_POST['submit'] == 'Convert')
{
    $exchange->getCurrencies();
    $exchange->getExchangeRates();

    $amount = $exchange->calcRates($_POST['amount'], $_POST['to'], $_POST['from']);

    echo '<lable>'.$amount.'</lable>';
}


?>
</form>
</body>
</html>