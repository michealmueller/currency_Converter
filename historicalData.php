<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Micheal
 * Date: 7/25/13
 * Time: 2:32 PM
 * To change this template use File | Settings | File Templates.
 */

require_once 'historical.php';
require_once 'exchanges.php';

$history = new getHistory();

$exchange = new getExchange();
$currencies = $exchange -> getCurrencies();
//$rates = $history ->getHistorical('2013-06-01');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>title</title>
    <link rel="stylesheet" href="CSS/global.css" type="text/css">
<!--JQPlot includes-->
    <script type="text/javascript" src="JQPlot/jquery.min.js"></script>
    <script type="text/javascript" src="JQPlot/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="JQPlot/plugins/jqplot.dateAxisRenderer.min.js"></script>
    <script type="text/javascript" src="JQPlot/plugins/jqplot.logAxisRenderer.min.js"></script>
    <script type="text/javascript" src="JQPlot/plugins/jqplot.canvasTextRenderer.min.js"></script>
    <script type="text/javascript" src="JQPlot/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
    <script type="text/javascript" src="JQPlot/plugins/jqplot.highlighter.min.js"></script>
    <link rel="stylesheet" type="text/css" href="JQPlot/jquery.jqplot.min.css" />

<!--END-->
</head>
<body>
<div id="container">
    <div id="symbolSelect">
        <table align="center">
            <form action="historicalData.php" method="POST">
                <tr>
                    <td>
                        <label>1. Select a month and year:</label>
                    </td>
                    <td>
                        <select name="month">
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select name="year">
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option selected value="2013">2013</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>2. Choose a currency to view Data:</label>
                    </td>
                    <td>
                        <select name="symbol">
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
                <tr>
                    <td>
                        <label>3. Click</label>
                    </td>
                    <td>
                        <input type="submit" value="Show History" name="Show">
                    </td>
                </tr>
            </form>
        </table>
        <?php
           if($_POST['Show'] === "Show History")
            {
                $data = $history -> cacheSpecificHistoricalData($_POST['symbol'], $_POST['month'], $_POST['year']);
            }


        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $.jqplot._noToImageButton = true;
                var currYear =
                            <?php
                            $months = array('01'=>'31', '02'=>'28', '03'=>'31', '04'=>'30', '05'=>'31', '06'=>'30', '07'=>'31', '08'=>'31', '09'=>'30', '10'=>'31', '11'=>'30', '12'=>'31');
                                echo '[';
                                for($i=1; $i<=$months[$_POST['month']]; $i++)
                                 {
                                    echo $data[$i];
                                 }
                                echo '];';
                            ?>

                var plot1 = $.jqplot("chart1", [currYear], {
                    seriesColors: ["rgba(78, 135, 194, 0.7)", "rgb(211, 235, 59)"],
                    title: '<?php echo $_POST['symbol'].'-'.$_POST['month'].'-'.$_POST['year']; ?>',
                    highlighter: {
                        show: true,
                        sizeAdjust: 3,
                        tooltipOffset: 9
                    },
                    grid: {
                        background: 'rgba(50,50,50,0.0)',
                        drawBorder: true,
                        shadow: false,
                        gridLineColor: '#666666',
                        gridLineWidth: 2
                    },
                    legend: {
                        show: true,
                        placement: 'inside'
                    },
                    seriesDefaults: {
                        rendererOptions: {
                            smooth: true,
                            animation: {
                                show: true
                            }
                        },
                        showMarker: false
                    },
                    series: [
                        {
                            fill: false,
                            label: '<?php echo $_POST['year']; ?>'
                        }
                    ],
                    axesDefaults: {
                        rendererOptions: {
                            baselineWidth:.5,
                            baselineColor: '#444444',
                            drawBaseline: true
                        }
                    },
                    axes: {
                        xaxis: {
                            renderer: $.jqplot.DateAxisRenderer,
                            tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                            tickOptions: {
                                formatString: "%b %e",
                                angle: -45,
                                textColor: '#000'
                            },
                            min: <?php echo '"'.$_POST['year'].'-'.$_POST['month'].'-1"' ?>,
                            max: <?php echo '"'.$_POST['year'].'-'.$_POST['month'].'-30"' ?>,
                            tickInterval: "5 days",
                            drawMajorGridlines: false
                        },
                        y2axis: {
                            renderer: $.jqplot.LogAxisRenderer,
                            pad: 0,
                            rendererOptions: {
                                //minorTicks:12
                            },
                            tickOptions: {
                                formatString: "%6f",
                                showMark: false,
                                textColor: '#000'
                            }
                        }
                    }
                });

                $('.jqplot-highlighter-tooltip').addClass('ui-corner-all')
            });
        </script>
    </div>
    <div id="chart1"></div>
</div>
</body>
<!--
$%'d
[["2011-08-01",796.01], ["2011-08-02",510.5], ["2011-08-03",527.8], ["2011-08-04",308.48],
                    ["2011-08-05",420.36], ["2011-08-06",219.47], ["2011-08-07",333.82], ["2011-08-08",660.55], ["2011-08-09",1093.19],
                    ["2011-08-10",521], ["2011-08-11",660.68], ["2011-08-12",928.65], ["2011-08-13",864.26], ["2011-08-14",395.55],
                    ["2011-08-15",623.86], ["2011-08-16",1300.05], ["2011-08-17",972.25], ["2011-08-18",661.98], ["2011-08-19",1008.67],
                    ["2011-08-20",1546.23], ["2011-08-21",593], ["2011-08-22",560.25], ["2011-08-23",857.8], ["2011-08-24",939.5],
                    ["2011-08-25",1256.14], ["2011-08-26",1033.01], ["2011-08-27",811.63], ["2011-08-28",735.01], ["2011-08-29",985.35],
                    ["2011-08-30",1401.58], ["2011-08-31",1177], ["2011-09-01",1023.66], ["2011-09-02",1442.31], ["2011-09-03",1299.24],
                    ["2011-09-04",1306.29], ["2011-09-06",1800.62], ["2011-09-07",1607.18], ["2011-09-08",1702.38],
                    ["2011-09-09",4118.48], ["2011-09-10",1988.11], ["2011-09-11",1485.89], ["2011-09-12",2681.97],
                    ["2011-09-13",1679.56], ["2011-09-14",3538.43], ["2011-09-15",3118.01], ["2011-09-16",4198.97],
                    ["2011-09-17",3020.44], ["2011-09-18",3383.45], ["2011-09-19",2148.91], ["2011-09-20",3058.82],
                    ["2011-09-21",3752.88], ["2011-09-22",3972.03], ["2011-09-23",2923.82], ["2011-09-24",2920.59],
                    ["2011-09-25",2785.93], ["2011-09-26",4329.7], ["2011-09-27",3493.72], ["2011-09-28",4440.55],
                    ["2011-09-29",5235.81], ["2011-09-30",6473.25]];
                    -->
</html>

