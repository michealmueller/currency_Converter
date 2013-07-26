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
    <link rel="stylesheet" href="CSS/global.css" type="text/css">
</head>
<body>
    <form action="conversion.php" method="post">
        <table border="0" id="convertTable">
            <tr>
                <td><label for="amount">Amount:</label></td>
                <td><input type="text" name="amount" value="5" /></td>
                <td> <label for="from">From:</label></td>
                <td>
                    <select name="from" id="from">
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
                <td><label for="to">To:</label></td>
                <td>
                    <select name="to" id="to">
                        <?php
                            for($o=0; $o <= $currAbbCount; $o++)
                            {
                                echo '<option value="' . $currencyAbb[$o] .'">' . $currencyLong[$o] . '</option>\n';
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="6"><input type="submit" value="Convert" /></td>
            </tr>
            <tr>
                <td id="disclaimer" colspan="6"><?php echo $rates['rates']['EUR']; ?></td>
            </tr>
        </table>
    </form>
</body>
</html>