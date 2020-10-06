<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
//db config file
//you might want to make thise different to the program-o chatbot user as you need privs to insert, delete, create tables.

$dbh = "localhost"; //server location (localhost should be ok for this)
$dbn = "jarvis1"; //database name/prefix
$dbu = "root"; //database username
$dbp = ""; //database password


function openDB()
{
	global $dbh,$dbp,$dbu,$dbn;
	$conn = mysqli_connect($dbh,$dbu,$dbp,$dbn)or die(mysqli_connect_error());
	return $conn;
}

?>