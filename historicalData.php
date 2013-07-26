<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Micheal
 * Date: 7/25/13
 * Time: 2:32 PM
 * To change this template use File | Settings | File Templates.
 */

require_once 'historical.php';

$history = new getHistory();

$rates = $history ->getHistorical('2013-06-01');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
    <link rel="stylesheet" href="CSS/global.css" type="text/css">
</head>
<body>
<div>
    <?php
        //print_r($rates['rates']['EUR']);
    ?>
    <br>
    <?php echo $history -> cacheHistoricalData(); ?>
</div>

</body>
</html>