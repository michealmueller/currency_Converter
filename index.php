<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Micheal
 * Date: 7/24/13
 * Time: 9:45 PM
 * To change this template use File | Settings | File Templates.
 */


?>
<script language="JavaScript">
    <!--
    function autoResize(id){
        var newheight;
        var newwidth;

        if(document.getElementById){
            newheight=document.getElementById(id).contentWindow.document .body.scrollHeight;
            newwidth=document.getElementById(id).contentWindow.document .body.scrollWidth;
        }

        document.getElementById(id).height= (newheight) + "px";
        document.getElementById(id).width= (newwidth) + "px";
    }
    //-->
</script>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <title>title</title>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
     <link rel="stylesheet" href="css/global.css" type="text/css">
 </head>
 <body>
 <div class="container">
    <div class="page-header"><h3>Currency Converter and Currency Plots By: Micheal Mueller</h3></div>
    <iframe id="iframe2" class="pull-left" src="nav.html" seamless onLoad="autoResize('iframe2');"></iframe>
    <iframe id="iframe1" class="pull-left" name="content" seamless src="convert.php" onLoad="autoResize('iframe1');"></iframe>
 </div>
 </body>
</html>