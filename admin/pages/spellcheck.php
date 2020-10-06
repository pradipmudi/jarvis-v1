<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
include("../funcs/secure.php");
include("../funcs/config.php");
include("../funcs/spellcheck.php");
echo "<script type=\"text/javascript\" src=\"js/tablesorter.js\"></script>";

if((isset($_POST['action']))&&($_POST['action']=="search"))
{
	$content = searchSpellForm();
	$content .= runSpellSearch();
	
}
elseif((isset($_POST['action']))&&($_POST['action']=="update"))
{
	$content = searchSpellForm();
	$content .= updateSpell();
	
}
elseif((isset($_GET['action']))&&($_GET['action']=="del")&&(isset($_GET['id']))&&($_GET['id']!=""))
{
	$content = searchSpellForm();
	$content .= delSpell($_GET['id']);
	
}
elseif((isset($_GET['action']))&&($_GET['action']=="edit")&&(isset($_GET['id']))&&($_GET['id']!=""))
{
	$content = editSpellForm($_GET['id']);
	
}
elseif((isset($_POST['action']))&&($_POST['action']=="add"))
{
	$content = searchSpellForm();
	$content .= insertSpell();
}
else
{
	$content = searchSpellForm();
	$content .= spellCheckForm();

}

include("inc/header.php");
include("inc/header_nav_bar.php");
echo "</div> 
	<div id=\"content\"><div id=\"nocol\">
	<div id=\"pTitle\">Spell checker</div>
		<p>$content</p>
	</div></div>
<div id=\"nav\">";
include("inc/side_nav_bar.php");
include("inc/footer.php");
?>