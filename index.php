<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//PHP MYSQLI AIML interpreter
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
include_once("bot/chat.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <title>J.A.R.V.I.S</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        @import url(css/Oswald.css?family=Oswald:400,300);
		@import url(css/open_sans.css?family=Open+Sans);
    </style>
    <link href="css/body.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body OnLoad="document.chat.chat.focus();">
<link rel="stylesheet" href="css/font-awessome.min.css">
<aside id="sidebar_secondaryi" class="tabbed_sidebar chat_sidebar">

<div class="popup-head">
    			<div class="popup-head-left pull-left"><a Design and Developmenta title="J.A.R.V.I.S.">

<h1>J.A.R.V.I.S.</h1><small><br> <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> At your service!! :)</small></a></div>
					  
			  </div>
			 <!-- <div id="chat" class="chat_box_wrapper chat_box_small chat_box_active" style="opacity: 1; display: block; transform: translateX(0px);">
                        <div class="chat_box chat_box_colors_a"> -->
									
									  <?php 
									  echo $res; 
									  echo "<br/>";
									  echo $formchat;
									  ?>									
			<!--			</div>
              </div> -->
									<p>&nbsp;</p>
									<script type="text/javascript">
									$(function(){
									$("#addClass").click(function () {
									  $('#sidebar_secondaryi').addClass('popup-box-on');
									    });
									  
									    $("#removeClass").click(function () {
									  $('#sidebar_secondaryi').removeClass('popup-box-on');
									    });
									})
									</script>

</body>
</html>
