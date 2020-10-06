<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
session_start();
if((!isset($_SESSION['poadmin']['uid'])) || ($_SESSION['poadmin']['uid']==""))
{
	header("location: ../index.php?msg=Session timed out");
}
else
{
	$name = $_SESSION['poadmin']['name'];
	$ip = $_SESSION['poadmin']['ip'];
	$last = $_SESSION['poadmin']['lastlogin'];
	$lip = $_SESSION['poadmin']['lip'];
	$llast = $_SESSION['poadmin']['llastlogin'];
}
?>