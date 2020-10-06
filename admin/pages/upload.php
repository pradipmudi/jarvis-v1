<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
include("../funcs/secure.php");
include("../funcs/config.php");
include("../funcs/upload.php");


if((isset($_POST['action']))&&($_POST['action']=="upload"))
{
	$content = parseAIML();
	
}
else
{
	$content = uploadAIMLForm();
}

$showhelp = showhelp();

include("inc/header.php");
include("inc/header_nav_bar.php");
echo "</div> 
	<div id=\"content\">
		<div id=\"nocol\">
			<div id=\"pTitle\">Upload AIML</div>
  			<p>$content</p>
			
			
		
			<a href=\"#\" onclick=\"showhide('help'); return(false);\"><img src=\"Img/help_icon.jpg\" alt=\"toggle help\" border=0 /></a>
			<div id=\"help\" style=\"visibility:hidden;\">$showhelp</div>
		</div>
	</div>
	<div id=\"nav\">";




include("inc/side_nav_bar.php");
include("inc/footer.php");
?>