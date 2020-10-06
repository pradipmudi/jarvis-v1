<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
$filename =  basename($_SERVER['PHP_SELF']);
$lgclass = "";
$btclass = "";
$tcclass = "";
$upclass = "";
$spclass = "";
$seclass = "";
$declass = "";

if($filename == "logs.php")
{
	$lgclass = "selected";
}
elseif($filename == "bots.php")
{
	$btclass = "selected";
}
elseif($filename == "teach.php")
{
	$tcclass = "selected";
}
if($filename == "upload.php")
{
	$upclass = "selected";
}
elseif($filename == "spellcheck.php")
{
	$spclass = "selected";
}
elseif($filename == "search.php")
{
	$seclass = "selected";
}
elseif($filename == "demochat.php")
{
	$declass = "selected";
}
echo "<ul>
<li><a href=\"logs.php\" class=\"$lgclass\">Logs </a> </li>
<li><a href=\"bots.php\" class=\"$btclass\">Bot Personality  </a></li>
<li><a href=\"teach.php\" class=\"$tcclass\">Teach </a></li>
<li><a href=\"upload.php\" class=\"$upclass\">Upload AIML </a></li>
<li><a href=\"spellcheck.php\" class=\"$spclass\">Spell check </a></li>
<li><a href=\"search.php\" class=\"$seclass\">Search Edit AIML  </a></li>
<li><a href=\"demochat.php\" class=\"$declass\">Demo Chat  </a></li>
</ul>";
?>