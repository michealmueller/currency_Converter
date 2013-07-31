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
  <link rel="stylesheet" href="CSS/global.css" type="text/css">
 </head>
 <body>
 <div id="container">
    <div id="nav">
        <iframe id="iframe2" seamless src="nav.html" onLoad="autoResize('iframe2');"></iframe>
    </div>
    <div id="content">
         <!--Content-->
         <iframe id="iframe1" name="content"seamless  src="convert.php" onLoad="autoResize('iframe1');"></iframe>
    </div>
 </div>
 </body>
</html>