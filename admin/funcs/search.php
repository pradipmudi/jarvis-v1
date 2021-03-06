<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
function searchForm()
{
	$form = "
	<div id=\"container\">
		<fieldset> 
    		<legend>Search</legend><br/>
				<form name=\"search\" action=\"search.php\" method=\"post\">
					<div class=\"fm-req\">
						<input type=\"text\" id=\"search\" name=\"search\" />
					
						<input type=\"submit\" name=\"action\" id=\"action\" value=\"search\">
					</div>
				</form>
			</fieldset>
		</div>
		<hr>";
	

	return $form;
	
}

function delAIML($id)
{
	global $dbn;
	$dbconn = openDB();
	
	if($id!="")
	{
		$sql = "DELETE FROM `$dbn`.`aiml` WHERE `id` = $id LIMIT 1";
		//echo $sql;
		$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
	
		if(!$result)
		{
			$msg = "<div id=\"errMsg\">Error AIML couldn't be deleted - no changes made.</div>"; 
		}
		else
		{
			$msg = "<div id=\"successMsg\">AIML has been deleted.</div>"; 
		}
	}
	else
	{
		$msg = "<div id=\"errMsg\">Error AIML couldn't be deleted - no changes made.</div>"; 
	}
	mysqli_close($dbconn);
	return $msg;
}


function runSearch()
{
	//db globals
	global $dbn;
	$dbconn = openDB();
	$i=0;
	
	$search = mysqli_escape_string($dbconn,trim($_POST['search']));
	
	if($search != "")
	{
		$sql = "SELECT * FROM `$dbn`.`aiml` WHERE `topic` LIKE '%$search%' OR `filename` LIKE '%$search%' OR 
		`pattern` LIKE '%$search%' OR `template` LIKE '%$search%' OR `thatpattern` LIKE '%$search%' LIMIT 50";
	
		$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
	
		$htmltbl = "<table>
						<thead>
							<tr>
								<th class=\"sortable\">Topic</th>
								<th class=\"sortable\">Previous Bot Response</th>
								<th class=\"sortable\">User Input</th>
								<th class=\"sortable\">Bot Response</th>
								<th class=\"sortable\">Filename</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>";
		
		while($row=mysqli_fetch_array($result))
		{
			$i++;
			
			$topic = $row['topic'];
			$pattern = $row['pattern'];
			$thatpattern = $row['thatpattern'];
			$template = htmlentities($row['template']);
			$filename = $row['filename'];
			$id = $row['id'];
			
			$action = "<a href=\"search.php?action=edit&id=$id\"><img src=\"Img/edit.png\" border=0 width=\"15\" height=\"15\" /></a>
						<a href=\"search.php?action=del&id=$id\" onclick=\"return confirm('Do you really want to delete this AIML record?You will not be able to undo this!')\";><img src=\"Img/del.png\" border=0 width=\"15\" height=\"15\"/></a>";
			
			$htmltbl .= "<tr valign=top>
								<td>$topic</td>
								<td>$thatpattern</td>
								<td>$pattern</td>
								<td>$template</td>
								<td>$filename</td>
								<td align=center>$action</td>
							</tr>";
		}
	
		$htmltbl .= "</tbody></table>";
		
		if($i == 50)
		{
			$msg = "Found more than 50 results for '<b>$search</b>', please refine your search further";
			
		}
		elseif($i == 0)
		{
			$msg = "Found 0 results for '<b>$search</b>', please try again";
			$htmltbl="";
			
		}
		else
		{
			$msg = "Found $i results for '<b>$search</b>'";
			
		}
	
		$htmlresults = "<div id=\"pTitle\">".$msg."</div>".$htmltbl;
	}
	else
	{
		$htmlresults = "<div id=\"errMsg\">Please enter a search term.</div>"; 
	}
	mysqli_close($dbconn);
	
	return $htmlresults;
	
}


function editAIMLForm($id)
{
	
		//db globals
	global $dbn;
	$dbconn = openDB();
		
	$sql = "SELECT * FROM `$dbn`.`aiml` WHERE `id` = '$id' LIMIT 1";
	$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
	
	$row=mysqli_fetch_array($result);
	
		
		$topic = $row['topic'];
		$pattern = $row['pattern'];
		$thatpattern = $row['thatpattern'];
		$template = htmlentities($row['template']);
		$filename = $row['filename'];
		$id = $row['id'];
		
	
	
	$form = "<div id=\"container\"><fieldset> 
    <legend>Update AIML</legend><br/>
	
	<form name=\"teach\" action=\"search.php\" method=\"post\">
			
			<div class=\"fm-opt\">
				<label for=\"topic\">Topic: </label>
				<input type=\"text\" id=\"topic\" name=\"topic\" value=\"$topic\" />
			</div>		
			
			<div class=\"fm-opt\">
				<label for=\"thatpattern\">Previous Res: </label>
				<input type=\"text\" id=\"thatpattern\" name=\"thatpattern\"  value=\"$thatpattern\" />
			</div>	
			
			<div class=\"fm-opt\">
				<label for=\"pattern\">User Input: </label>
				<input type=\"text\" id=\"pattern\" name=\"pattern\"  value=\"$pattern\"/>
			</div>
		
			<div class=\"fm-opt\">
				<label for=\"template\">Bot Response: </label>
				<input type=\"text\" id=\"template\" name=\"template\"  value=\"$template\"/>
			</div>
			
						<div class=\"fm-opt\">
				<label for=\"filename\">Filename: </label>
				<input type=\"text\" id=\"filename\" name=\"filename\"  value=\"$filename\"/>
			</div>
			
	</fieldset>
			<div id=\"fm-submit\" class=\"fm-req\">
			<input type=\"hidden\" name=\"id\" id=\"id\" value=\"$id\">
				<input type=\"submit\" name=\"action\" id=\"action\" value=\"update\">
			</div>
			</form></div>";
	
mysqli_close($dbconn);
	return $form;
	
}

function updateAIML()
{
	//db globals
	global $dbn;
	$dbconn = openDB();
	
	$template = mysqli_escape_string($dbconn,trim($_POST['template']));
	$filename = mysqli_escape_string($dbconn,trim($_POST['filename']));
	$pattern = strtoupper(mysqli_escape_string($dbconn,trim($_POST['pattern'])));
	$thatpattern = strtoupper(mysqli_escape_string($dbconn,trim($_POST['thatpattern'])));
	$topic = strtoupper(mysqli_escape_string($dbconn,trim($_POST['topic'])));
	$id = trim($_POST['id']);


	if(($template == "")||($pattern== "")||($id==""))
	{
		$msg = "<div id=\"errMsg\">Please make sure you have entered a user input and bot response.</div>"; 
	}
	else
	{
		$sql = "UPDATE `$dbn`.`aiml` SET `pattern` = '$pattern',`thatpattern`='$thatpattern',`template`='$template',`topic`='$topic',`filename`='$filename' WHERE `id`='$id' LIMIT 1";
		//echo $sql;
		$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
		
		if($result)
		{
			$msg = "<div id=\"successMsg\">AIML Updated.</div>"; 
		}
		else
		{
			$msg = "<div id=\"errMsg\">There was an error updating the AIML - no changes made.</div>"; 
		}
	}
	mysqli_close($dbconn);
	
	return $msg;
	
}
?>