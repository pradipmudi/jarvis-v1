<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
include("../funcs/secure.php");
include("../funcs/config.php");
include("../funcs/search.php");
echo "<script type=\"text/javascript\" src=\"js/tablesorter.js\"></script>";

if((isset($_POST['action']))&&($_POST['action']=="search"))
{
	$content = searchForm();
	$content .= runSearch();
	
}
elseif((isset($_POST['action']))&&($_POST['action']=="update"))
{
	$content = searchForm();
	$content .= updateAIML();
	
}
elseif((isset($_GET['action']))&&($_GET['action']=="del")&&(isset($_GET['id']))&&($_GET['id']!=""))
{
	$content = searchForm();
	$content .= delAIML($_GET['id']);
	
}
elseif((isset($_GET['action']))&&($_GET['action']=="edit")&&(isset($_GET['id']))&&($_GET['id']!=""))
{
	$content = searchForm();
	$content .= editAIMLForm($_GET['id']);
	
}
else
{
	$content = searchForm();
}



include("inc/header.php");
include("inc/header_nav_bar.php");
echo "</div> 
	<div id=\"content\"><div id=\"nocol\">
	<div id=\"pTitle\">Search and Edit AIML</div>
		<p>$content</p>
	</div></div>
	<div id=\"nav\">";
include("inc/side_nav_bar.php");
include("inc/footer.php");
?>