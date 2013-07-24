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
    <link rel="stylesheet" href="global.css" type="text/css">
</head>
<body>
    <form action="convert.php" method="post">
        <table border="0">
            <tr>
                <td><label for="amount">Amount:</label></td>
                <td><input class="amount" type="text" name="amount" id="amount" value="1" /></td>
                <td> <label for="from">From:</label></td>
                <td>
                    <select name="from" id="from">
                        <?php
                            $currencyLong = $currencies[0];
                            $currencyAbb = $currencies[1][0];

                            foreach($currencyAbb as $value)
                            {
                                echo '<option value="' . $value .'">';

                                foreach($currencyLong as $value2)
                                {
                                    echo $value2 . '</option><br>';
                                }

                            }
                        ?>
                    </select>
                </td>
                <td><label for="to">To:</label></td>
                <td>
                    <select name="to" id="to">
                        <?php
                            foreach($currencyAbb as $value)
                            {
                                echo '<option value="' . $value .'">';

                                foreach($currencyLong as $value2)
                                {
                                    echo $value2 . '</option><br>';
                                }

                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="6"><input type="submit" value="Convert" /></td>
            </tr>
            <tr>
                <td colspan="6">
                    <div id="results">
                        <?php
                            print_r($rates['rates']['EUR']);
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td id="disclaimer" colspan="6"><?php echo $rates['disclaimer']; ?></td>
            </tr>
        </table>
    </form>
</body>
</html>