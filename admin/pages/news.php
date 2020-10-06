<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
include("../funcs/secure.php");
include("../funcs/config.php");
include("../funcs/news.php");


$content = getNews();



include("inc/header.php");
include("inc/header_nav_bar.php");
echo "</div> 
	<div id=\"content\">
		<div id=\"nocol\">
			<div id=\"pTitle\">News</div>
  				<p>$content</p></div>
			</div>
<div id=\"nav\">";
include("inc/side_nav_bar.php");
include("inc/footer.php");
?>