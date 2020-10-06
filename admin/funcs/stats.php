<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
function getStats($interval)
{
	global $dbn;
	
	$dbconn = openDB();
	
	if($interval!="all")
	{
		$intervaldate =  date("Y-m-d", strtotime($interval));
		$sqladd = " WHERE date(timestamp) >= '$intervaldate'";
	}
	else
	{
		$sqladd ="";
	}
		
	//get undefined defaults from the db
	$sql = "SELECT count(distinct(`userid`)) AS TOT FROM `$dbn`.`conversation_log` $sqladd";
	//echo $sql;
	$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
	$row = mysqli_fetch_array($result);
	$res = $row['TOT'];
	return $res;
}

function getChatLines($i,$j)
{
	global $dbn;

	$dbconn = openDB();
	
	if($i=="average")
	{
		$sql = "SELECT AVG(`chatlines`) AS TOT FROM `$dbn`.`users` WHERE `chatlines` != 0";	
	}
	else
	{
		$sql = "SELECT count(distinct(`id`)) AS TOT FROM `$dbn`.`users` WHERE `chatlines` >= $i AND `chatlines` <= $j";
	}
		
	//get undefined defaults from the db
	//echo $sql;
	$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
	$row = mysqli_fetch_array($result);
	$res = $row['TOT'];
	return $res;
}

?>