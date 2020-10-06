<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
include("../funcs/secure.php");
include("../funcs/config.php");
include("../funcs/logs.php");


if(isset($_GET['showing']))
{
	$show = $_GET['showing'];
}
else
{
	$show = "last 20";
}



if(isset($_GET['id']))
{
	$convo = getuserConvo($_GET['id'],$show);
}
else
{
	$convo = "Please select a conversation from the side bar.";
}



include("inc/header.php");
include("inc/header_nav_bar.php");

echo "</div> 
	<div id=\"content\">
		<div id=\"col1\">
			<div id=\"pTitle\">Conversation Logs</div>
  				<p>$convo</p>
		</div>
	<div id=\"col2\">
		".showThis($show)."<br/>".getuserList($show)."</div>
	</div>
<div id=\"nav\">";

include("inc/side_nav_bar.php");
include("inc/footer.php");
?>