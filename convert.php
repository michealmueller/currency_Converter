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
<div id="customContainer" class="container">
    <table class="table table-hover">
        <form action="convert.php" method="post" class="form-inline">
            <tr>
                <td><label for="amount">Amount:</label></td>
                <td><input class="form-control" placeholder="Amount" id="focusedInput" type="number" name="amount" value="5" width="50px"/></td>
            </tr>
            <tr>
                <td><label for="from">From:</label></td>
                <td>
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
                </td>
            </tr>
                <td><label for="to">To:</label></td>
                <td>
                    <select name="to" id="to">
                            <?php
                                for($o=0; $o <= $currAbbCount; $o++)
                                {
                                    echo '<option value="' . $currencyAbb[$o] .'">' . $currencyLong[$o] . '</option>';
                                }
                            ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" >
                    <input class="form-control btn btn-primary" type="submit" value="Convert" />
                </td>
            </tr>
        </form>
            <tr>
                <td>
                    <?php

                    if($_POST['submit'] == 'Convert')
                    {
                        $exchange->getCurrencies();
                        $exchange->getExchangeRates();

                        $amount = $exchange->calcRates($_POST['amount'], $_POST['to'], $_POST['from']);

                        echo '<lable>'.$amount.'</lable>';
                    }


                    ?>
                </td>
            </tr>
    </table>
</div>
</body>
</html>