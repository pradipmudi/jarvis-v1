<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
function getBot($id)
{
	//db globals
	global $dbn;
	$dbconn = openDB();
	$inputs="";
	
	//get undefined defaults from the db
	$sql = "SELECT * FROM `$dbn`.`botpersonality` where bot = $id";
	$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));

	while($row = mysqli_fetch_array($result))
	{
		$rid = $row['id'];
		$label = $row['name'];
		$value = $row['value'];
		
		$inputs .= "     
    	<div class=\"fm-opt\">
			<label for=\"$rid\">$label:</label>
			<input type=\"text\" id=\"$rid\" name=\"$rid\" value=\"$value\">
		</div><br/>";
	}

	$form = "<div id=\"container\"><fieldset> 
    <legend>Update the bot personality</legend><br/><form name=\"botpersonality\" action=\"bots.php\" method=\"post\">
				$inputs
				 <input type=\"hidden\" id=\"botid\" name=\"botid\" value=\"$id\">
				 <div id=\"fm-submit\" class=\"fm-req\"> <input type=\"submit\" name=\"action\" id=\"action\" value=\"update\"></div>
			</form></fieldset></div>";
	
	mysqli_close($dbconn);
	
	return $form;
	
}

function updateBot()
{
	//db globals
	global $dbn;
	$dbconn = openDB();
	
	$sql = "";
	$msg = "";
	
	foreach($_POST as $key => $value)
	{
		if(($key!="botid")||($key!="action"))
		{
			$value = mysqli_escape_string($dbconn,trim($value));
			if(($key != "botid")&&($key != "action")&&($value!=""))
			{
				$value = mysqli_escape_string($dbconn,trim($value));
				$sql = "UPDATE `$dbn`.`botpersonality` SET `value` ='$value' where `id` = $key limit 1; ";
				$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
				if(!$result)
				{
					$msg = "<div id=\"errMsg\">Error updating bot personality.</div>"; 
					break;
				}
			}
		}
	}

	if($msg == "")
	{
		$msg = "<div id=\"successMsg\">Bot personality updated.</div>"; 
	}
	
	mysqli_close($dbconn);
	return $msg;
	
}
?>