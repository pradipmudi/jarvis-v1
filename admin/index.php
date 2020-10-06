<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//PHP MYSQLI AIML interpreter
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
session_start();
include("funcs/config.php");

if((isset($_POST['uname']))&&(isset($_POST['pw'])))
{
	$dbconn = openDB();
	$uname = mysqli_escape_string($dbconn,strip_tags(trim($_POST['uname'])));
	$pw = mysqli_escape_string($dbconn,strip_tags(trim($_POST['pw'])));
	
	$sql = "SELECT * FROM `$dbn`.`myprogramo` WHERE uname = '".$uname."' AND pword = '".MD5($pw)."'";
	
	$result = mysqli_query($dbconn,$sql)or die(mysql_error($dbconn));
	$count = mysqli_num_rows($result);
	$msg ="";
	
	if($count>0)
	{
		$row=mysqli_fetch_array($result);
		$_SESSION['poadmin']['uid']=$row['id'];
		$_SESSION['poadmin']['name']=$row['uname'];
		$_SESSION['poadmin']['lip']=$row['lastip'];
		$_SESSION['poadmin']['llastlogin']=date('l jS \of F Y h:i:s A', strtotime($row['lastlogin']));


		if(!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  	$ip=$_SERVER['REMOTE_ADDR'];
		}
		
		$sqlupdate = "UPDATE `$dbn`.`myprogramo` SET `lastip` = '$ip', `lastlogin` = CURRENT_TIMESTAMP WHERE uname = '".$uname."' limit 1";
		//echo $sql;
		mysqli_query($dbconn,$sqlupdate)or die(mysqli_error($dbconn));
		
		$_SESSION['poadmin']['ip']=$ip;
		$_SESSION['poadmin']['lastlogin']=date('l jS \of F Y h:i:s A');
	}
	else
	{
		$msg = "incorrect username/password";
	}
	
	mysqli_close($dbconn);
	
	if($msg == "")
	{
		header("location: pages/index.php");
	}
}
elseif(isset($_GET['msg']))
{
	$msg = htmlentities($_GET['msg']);
}
else
{
	$msg = "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>J.A..R.V.I.S.</title> 
<link rel="stylesheet" type="text/css" href="pages/inc/style.css" /> 
</head>

<body>
<div id="container"><p>&nbsp;</p><div align=center><h1><span class="orange">J.</span>A.R.V.I.S.</h1></div>
  <p><?php echo "<div id=\"errMsg\">$msg</div>";?></p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="38%" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td bgcolor="#FFFFFF">  <fieldset> 
    <legend>Login </legend> 
  <form id="fm-form" method="post" action="index.php" > 

    <div class="fm-req"> 
      <label for="uname">Username:</label> 
      <input name="uname" id="uname" type="text" maxlength="20" size="15"/> 
    </div> 
    <div class="fm-req"> 
      <label for="pw">Password:</label> 
      <input name="pw" id="pw" type="password" maxlength="20" size="15"/> 
    </div> 
    
    <div id="fm-submit" class="fm-req"> 
      <input name="Submit" value="Submit" type="submit" /> 
    </div> 
  </form></fieldset></td>
    </tr>
  </table>
  <p>&nbsp;</p>
 </div>
</body>
</html>
