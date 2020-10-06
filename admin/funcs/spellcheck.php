<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
function spellCheckForm()
{
	$form = "<div id=\"container\">
				<fieldset> 
    				<legend>Add to spell checker</legend><br/>
						<form name=\"teach\" action=\"spellcheck.php\" method=\"post\">
							<div class=\"fm-opt\">
								<label for=\"missspell\">Misspell: </label>
								<input type=\"text\" id=\"missspell\" name=\"missspell\" />
							</div>		
							<div class=\"fm-opt\">
								<label for=\"correction\">Correction: </label>
								<input type=\"text\" id=\"correction\" name=\"correction\" />
							</div>	
							<div id=\"fm-submit\" class=\"fm-req\">
								<input type=\"submit\" name=\"action\" id=\"action\" value=\"add\">
							</div>
							</fieldset>
						</form>
					
				</div><hr>";
	return $form;
	
}

function insertSpell()
{
	//db globals
	global $dbn;
	$dbconn = openDB();
	
	$correction = mysqli_escape_string($dbconn,trim($_POST['correction']));
	$missspell = mysqli_escape_string($dbconn,trim($_POST['missspell']));
	
	if(($correction == "") || ($missspell == ""))
	{
		$msg = "<div id=\"errMsg\">You must enter a spelling mistake and the correction.</div>";
	}
	else
	{
		$sql = "INSERT INTO `$dbn`.`spellcheck` VALUES (NULL,'$missspell','$correction')";
		$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
		
		if($result)
		{
			$msg = "<div id=\"successMsg\">Correction added.</div>"; 
		}
		else
		{
			$msg = "<div id=\"errMsg\">There was a problem adding the correction - no changes made.</div>"; 
		}	
	}
	mysqli_close($dbconn);
	
	return $msg;
}

function searchSpellForm()
{
	$form = "<div id=\"container\">
				<fieldset> 
    				<legend>Search</legend><br/>
						<form name=\"search\" action=\"spellcheck.php\" method=\"post\">
						<div class=\"fm-req\">
							<input type=\"text\" id=\"search\" name=\"search\" />
							<input type=\"submit\" name=\"action\" id=\"action\" value=\"search\">
						</div>
						</form>
				</fieldset>
				</div><hr>";
	return $form;
}

function delSpell($id)
{
	global $dbn;
	$dbconn = openDB();
	
	if($id=="")
	{
		$msg = "<div id=\"errMsg\">There was a problem deleting the correction - no changes made.</div>"; 
	}
	else
	{
	
		$sql = "DELETE FROM `$dbn`.`spellcheck` WHERE `id` = $id LIMIT 1";
		//echo $sql;
		$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
		
		if($result)
		{
			$msg = "<div id=\"successMsg\">Correction deleted.</div>"; 
		}
		else
		{
			$msg = "<div id=\"errMsg\">There was a problem deleting the correction - no changes made.</div>"; 
		}	
	}	
	
	mysqli_close($dbconn);
	return $msg;
}


function runSpellSearch()
{
	//db globals
	global $dbn;
	$dbconn = openDB();
	$i=0;
	
	$search = mysqli_escape_string($dbconn,trim($_POST['search']));
	
	$sql = "SELECT * FROM `$dbn`.`spellcheck` WHERE `missspelling` LIKE '%$search%' OR `correction` LIKE '%$search%' LIMIT 50";
	$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
	
	$htmltbl = "<table>
					<thead>
						<tr>
							<th class=\"sortable\">Misspelling</th>
							<th class=\"sortable\">Correction</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>";
	
	while($row=mysqli_fetch_array($result))
	{
		$i++;
		
		$misspell = $row['missspelling'];
		$correction = $row['correction'];
		$id = $row['id'];
		
		$action = "<a href=\"spellcheck.php?action=edit&id=$id\"><img src=\"Img/edit.png\" border=0 width=\"15\" height=\"15\" /></a>
					<a href=\"spellcheck.php?action=del&id=$id\" onclick=\"return confirm('Do you really want to delete this misspelling? You will not be able to undo this!')\";><img src=\"Img/del.png\" border=0 width=\"15\" height=\"15\"/></a>";
		
		$htmltbl .= "<tr valign=top>
							<td>$misspell</td>
							<td>$correction</td>
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
	
	mysqli_close($dbconn);
	
	return $htmlresults;
	
}


function editSpellForm($id)
{
	
		//db globals
	global $dbn;
	$dbconn = openDB();
		
	$sql = "SELECT * FROM `$dbn`.`spellcheck` WHERE `id` = '$id' LIMIT 1";
	$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
	
	$row=mysqli_fetch_array($result);
	
		
		$missspelling = $row['missspelling'];
		$correction = $row['correction'];
		$id = $row['id'];
		
	
	
	$form = "<div id=\"container\">
				<fieldset> 
    				<legend>Update Spell checker</legend><br/>
						<form name=\"spell\" action=\"spellcheck.php\" method=\"post\">
			
			<div class=\"fm-opt\">
				<label for=\"topic\">Misspelling: </label>
				<input type=\"text\" id=\"missspelling\" name=\"missspelling\" value=\"$missspelling\" />
			</div>		
			
			<div class=\"fm-opt\">
				<label for=\"correction\">Correction: </label>
				<input type=\"text\" id=\"correction\" name=\"correction\"  value=\"$correction\" />
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

function updateSpell()
{
	//db globals
	global $dbn;
	$dbconn = openDB();
	
	$missspelling = mysqli_escape_string($dbconn,trim($_POST['missspelling']));
	$correction = mysqli_escape_string($dbconn,trim($_POST['correction']));
	$id = trim($_POST['id']);

	if(($id=="")||($missspelling=="")||($correction==""))
	{
		$msg = "<div id=\"errMsg\">There was a problem editing the correction - no changes made.</div>"; 
	}
	else
	{
		$sql = "UPDATE `$dbn`.`spellcheck` SET `missspelling` = '$missspelling',`correction`='$correction' WHERE `id`=$id LIMIT 1";
	//echo $sql;
		$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
		
		if($result)
		{
			$msg = "<div id=\"successMsg\">Correction edited.</div>"; 
		}
		else
		{
			$msg = "<div id=\"errMsg\">There was a problem editing the correction - no changes made.</div>"; 
		}	
	}
	return $msg;	
}
?>