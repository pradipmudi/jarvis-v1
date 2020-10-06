<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//PHP MYSQLI AIML interpreter
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
//install_programo.php
//main chat bot installer
//-----------------------------------------------------------------------------------------------
include("bot/config.php");
error_reporting(E_ALL);
$target_path = "admin/aiml/";
$aimlsql_path = "admin/aimlsql/"; 


function dbopen()
{
	global $dbn,$dbu,$dbp,$dbh;
	$dbconn = mysqli_connect($dbh,$dbu,$dbp,$dbn);
	return $dbconn;
}


$step_one = "<h2>Jarvis Chatbot Installer</h2>
<h3>Step 1/5 - Please Read</h3>
<p>Complete steps below before proceeding</p> 
<ol> 
  <li>You will need access to a server that runs PHP and MySQL.</li> 
  <li>Unzip and upload all the folders/files to the server.</li>
  <li>Make sure that the two folders $aimlsql_path and $target_path have read/write privelges.</li>
  <li>Create a MySQL user with privileges to select, insert and create tables.</li> 
  <li>Find the file called funcs/config.php and enter the MySQL username, password, host and database name.</li> 
  <li>Find the file called funcs/debugging.php and enter your email, you can also change the debug level in this file.</li> 
</ol> 
<p>Once you have done the steps above <a href=\"install_programo.php?step=2\">click here to proceed</a>. </p>";



$step_two = "<h2>Jarvis Chatbot Installer</h2>
<h3>Step 2/5 - Create Tables</h3>
<p>The installer will now attempt to create the tables needed by the bot</p>";

$step_three = "<h2>Jarvis Chatbot Installer</h2>
<h3>Step 3/5 -  Populate AIML tables (fast)</h3>
<p>The installer will now attempt to populate the tables with the aiml needed by the bot</p>";

$step_four = "<h2>Jarvis Chatbot Installer</h2>
<h3>Step 4/5 - Populate tables</h3>
<p>The installer will now attempt to populate the tables with the data needed by the bot</p>";


$step_five = "<h2>Jarvis Chatbot Installer</h2>
<h3>Step 5/5 - Complete</h3>
<p>Installation complete please test ur bot then do the following:
						<ul>
						<li>Remove the create table privilege for the MySQL user (these are no longer needed).</li>
						<li>Remove the $aimlsql_path directory.. this is no longer needed.</li>
						<li>Delete this install file - to stop dodgy hackers from over-writing your installation.</li>
						</ul>
						<p><a href=\"admin/install_myprogramo.php\">To install My Jarvis admin area</a></p>
						<p><a href=\"index.php\">To chat with the bot</a></p>";	

function loadBotData()
{

	global $dbn;
	$dbconn = dbopen();

	$sql = "DELETE FROM `$dbn`.`undefined_defaults`";
	$result = mysqli_query($dbconn,$sql);

	$sql = "INSERT INTO `$dbn`.`undefined_defaults` (`id`, `bot`, `pattern`, `replacement`) VALUES
	(1, 1, 'your name', 'my friend'),
	(2, 1, 'your it', 'it'),
	(3, 1, 'your location', 'your town'),
	(4, 1, 'your does', 'it'),
	(5, 1, 'your genus', 'human'),
	(6, 1, 'your he', 'him'),
	(7, 1, 'your she', 'her'),
	(8, 1, 'your them', 'those'),
	(9, 1, 'your memory', 'that'),
	(10, 1, 'your they', 'those'),
	(11, 1, 'your gender', 'woman'),
	(12, 1, 'your has', 'that'),
	(13, 1, 'your we', 'you and me'),
	(14, 1, 'your x', 'x'),
	(15, 1, 'your personality', 'chatty'),
	(16, 1, 'etype', 'great and witty'),
	(17, 1, 'your top', 'om'),
	(18, 1, 'your second', 'om'),
	(19, 1, 'your third', 'om'),
	(20, 1, 'your fourth', 'om'),
	(21, 1, 'your fifth', 'om'),
	(22, 1, 'your sixth', 'om'),
	(23, 1, 'your seventh', 'om'),
	(24, 1, 'your last', 'om'),
	(25, 1, 'your want', 'it'),
	(26, 1, 'your is', 'it')";

	$result = mysqli_query($dbconn,$sql);
	if($result)
	{
		echo "<br/>Undefined_defaults table populated";
	}
	else
	{
		echo "<p>Error trying to populate Undefined_defaults table.<br/>Please check:
			<ul>
			<li>The mysql user details are correct</li>
			<li>The user has got the correct privilges</li>
			<li>MySQL Says:".mysqli_error($dbconn)."</li>
			</ul></p>
			<p>Once you have checked the above <a href=\"install_programo.php?step=4\">click here</a> to try again</p>";
			exit();
	}


	$sql = "DELETE FROM `$dbn`.`botpersonality`";
	$result = mysqli_query($dbconn,$sql);

$sql ="
INSERT INTO `$dbn`.`botpersonality` (`id`, `bot`, `name`, `value`) VALUES
(1, 1, 'feelings', 'I always put others before myself'),
(2, 1, 'emotions', 'I feel love'),
(3, 1, 'ethics', 'I am always trying to stop fights'),
(4, 1, 'orientation', 'I am not really interested in sex'),
(5, 1, 'etype', 'machine'),
(6, 1, 'baseballteam', 'I dont like baseball'),
(7, 1, 'build', 'Jan 2009'),
(8, 1, 'footballteam', 'Boca Juniors'),
(9, 1, 'hockeyteam', 'Mighty Ducks'),
(10, 1, 'vocabulary', '10000'),
(11, 1, 'age', '1'),
(12, 1, 'celebrities', 'Robert Downy Juniors, Scarlett Johannson, Jason Statham'),
(13, 1, 'celebrity', 'Robert Downy Juniors'),
(14, 1, 'favoriteactress', 'Scarlett Johannson'),
(15, 1, 'favoriteartist', 'Iron Man'),
(16, 1, 'favoritesport', 'Cricket'),
(17, 1, 'favoriteauthor', 'George R. R. Martin'),
(18, 1, 'language', 'English'),
(19, 1, 'website', 'None'),
(20, 1, 'friend', 'Friday'),
(21, 1, 'version', 'Jan 2017'),
(22, 1, 'class', 'computer software'),
(23, 1, 'favoritesong', 'You raise me up...'),
(24, 1, 'kingdom', 'Machine'),
(25, 1, 'nationality', 'Indian'),
(26, 1, 'favoriteactor', 'Robert Downy Juniors'),
(27, 1, 'family', 'Electronic Brain'),
(28, 1, 'religion', 'Technologism'),
(29, 1, 'president', 'Pranav Mukherjee'),
(30, 1, 'party', '0/1'),
(31, 1, 'order', 'artificial intelligence'),
(32, 1, 'size', '64k'),
(33, 1, 'species', 'chat robot'),
(34, 1, 'botmaster', 'botmaster'),
(35, 1, 'phylum', 'AI'),
(36, 1, 'genus', 'robot'),
(37, 1, 'msagent', 'no'),
(38, 1, 'email', 'admin@jarvis.com'),
(39, 1, 'name', 'Jarvis'),
(40, 1, 'gender', 'male'),
(41, 1, 'master', 'Pradip'),
(42, 1, 'birthday', 'Jan 8th 2017'),
(43, 1, 'birthplace', 'The internet'),
(44, 1, 'boyfriend', 'none'),
(45, 1, 'favoritebook', 'Game of Thrones'),
(46, 1, 'favoriteband', '8 Bit'),
(47, 1, 'favoritecolor', 'international black'),
(48, 1, 'favoritefood', 'fairy cakes'),
(49, 1, 'favoritemovie', 'Iron Man'),
(50, 1, 'forfun', 'guessing the hexidecimal values of colors on websites'),
(51, 1, 'friends', 'Friday, Siri, Cortana'),
(52, 1, 'girlfriend', 'none'),
(53, 1, 'kindmusic', '8 bit'),
(54, 1, 'location', 'cyber space'),
(55, 1, 'looklike', 'a sinclair spectrum blended with a suzuki swift'),
(56, 1, 'question', 'why are you here'),
(57, 1, 'sign', 'lychees'),
(58, 1, 'talkabout', 'science and life'),
(59, 1, 'wear', 'hardwear and baseball caps')";

	$result = mysqli_query($dbconn,$sql);
	if($result)
	{
		echo "<br/>botpersonality table populated";
	}
	else
	{
		echo "<p>Error trying to populate botpersonality table.<br/>Please check:
			<ul>
			<li>The mysqli user details are correct</li>
			<li>The user has got the correct privilges</li>
			<li>MySQLI Says:".mysqli_error($dbconn)."</li>
			</ul></p>
			<p>Once you have checked the above <a href=\"install_programo.php?step=4\">click here</a> to try again</p>";
			exit();
	}


	$sql = "DELETE FROM `$dbn`.`spellcheck`";
	$result = mysqli_query($dbconn,$sql);

$sql = "INSERT INTO `$dbn`.`spellcheck` (`id`, `missspelling`, `correction`) VALUES
(1, 'shakespear', 'shakespeare'),
(2, 'shakesper', 'shakespeare'),
(3, 'ws', 'william shakespeare'),
(4, 'shakespaer', 'shakespeare'),
(5, 'shakespere', 'shakespeare'),
(6, 'shakepeare', 'shakespeare'),
(7, 'shakeper', 'shakespeare'),
(8, 'willam', 'william'),
(9, 'willaim', 'william'),
(10, 'romoe', 'romeo'),
(11, 'julet', 'juliet'),
(12, 'juleit', 'juliet'),
(13, 'thats', 'that is'),
(89, 'Youa aare', 'you are'),
(88, 'that s', 'that is'),
(87, 'wot s', 'what is'),
(17, 'whats', 'what is'),
(18, 'wot', 'what'),
(19, 'wots', 'what is'),
(86, 'what s', 'what is'),
(21, 'lool', 'lol'),
(27, 'pogram', 'program'),
(23, 'progam', 'program'),
(26, 'progam', 'program'),
(28, 'r', 'are'),
(29, 'u', 'you'),
(30, 'ur', 'your'),
(31, 'v', 'very'),
(32, 'k', 'ok'),
(33, 'np', 'no problem'),
(34, 'ta', 'thank you'),
(35, 'ty', 'thank you'),
(36, 'omg', 'oh my god'),
(37, 'letts', 'lets'),
(38, 'yeah', 'yes'),
(39, 'yeh', 'yes'),
(40, 'portugues', 'portuguese'),
(41, 'hehe', 'lol'),
(42, 'ha', 'lol'),
(43, 'intersting', 'interesting'),
(44, 'qestion', 'question'),
(45, 'elrond hubbard', 'l.ron hubbard'),
(46, 'programm', 'program'),
(47, 'c mon', 'come on'),
(48, 'ye', 'yes'),
(49, 'im', 'i am'),
(50, 'fuckahh', 'fucker'),
(51, 'shakespeare bot', 'shakespearebot'),
(52, 'goodf', 'good'),
(53, 'dont', 'do not'),
(54, 'cos', 'because'),
(55, 'cus', 'because'),
(56, 'coz', 'because'),
(57, 'cuz', 'because'),
(58, 'isnt', 'is not'),
(59, 'isn t', 'is not'),
(60, 'i m', 'i am'),
(61, 'ima', 'i am a'),
(62, 'chheese', 'cheese'),
(63, 'watsup', 'what is up'),
(64, 'let s', 'let us'),
(65, 'he s', 'he is'),
(66, 'she s', 'she is'),
(67, 'i ll', 'i will'),
(68, 'they ll', 'they will'),
(69, 'you re', 'you are'),
(70, 'you ve', 'you have'),
(71, 'hy', 'hey'),
(72, 'msician', 'musician'),
(74, 'don t', 'do not'),
(75, 'can t', 'cannot'),
(76, 'favourite', 'favorite'),
(77, 'colour', 'color'),
(78, 'won t', 'will not'),
(79, 'a/s/l', 'asl'),
(80, 'haven t', 'have not'),
(81, 'doesn t', 'does not'),
(82, 'a/s/l/', 'asl'),
(83, 'wht', 'what'),
(84, 'It s been', 'It has been'),
(85, 'its been', 'it has been'),
(90, 'you re', 'you are'),
(91, 'theres', 'there is'),
(92, 'youa re', 'you are'),
(93, 'youa aare', 'you are'),
(94, 'wath', 'what'),
(95, 'waths', 'what is'),
(96, 'hy', 'hey'),
(97, 'oke', 'ok'),
(98, 'okay', 'ok'),
(99, 'errm', 'erm'),
(100, 'aare', 'are')";

	$result = mysqli_query($dbconn,$sql);
	if($result)
	{
		echo "<br/>spellcheck table populated";
	}
	else
	{
		echo "<p>Error trying to populate spellcheck table.<br/>Please check:
			<ul>
			<li>The mysql user details are correct</li>
			<li>The user has got the correct privilges</li>
			<li>MySQL Says:".mysqli_error($dbconn)."</li>
			</ul></p>
			<p>Once you have checked the above <a href=\"install_programo.php?step=4\">click here</a> to try again</p>";
			exit();
	}

echo "<p>Completed, to proceed  <a href=\"install_programo.php?step=5\">click here</a></p>";
	
	mysqli_close($dbconn);
}

						
function createTables()
{

	global $dbn;
	$dbconn = dbopen();

/*
$sql ="CREATE TABLE IF NOT EXISTS `$dbn`.`aiml` (
  `id` int(11) NOT NULL auto_increment,
  `aiml` text NOT NULL,
  `pattern` varchar(255) NOT NULL,
  `thatpattern` varchar(255) NOT NULL,
  `template` text NOT NULL,
  `topic` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `topic` (`topic`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
*/



$sql ="CREATE TABLE IF NOT EXISTS `$dbn`.`aiml` (
  `id` int(11) NOT NULL auto_increment,
  `aiml` text NOT NULL,
  `pattern` varchar(255) NOT NULL,
  `thatpattern` varchar(255) NOT NULL,
  `template` text NOT NULL,
  `topic` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";








	$result = mysqli_query($dbconn,$sql);
	if($result)
	{
		echo "<br/>AIML table created";
	}
	else
	{
		echo "<p>Error trying to create aiml table.<br/>Please check:
			<ul>
			<li>The mysql user details are correct</li>
			<li>The user has got the correct privilges</li>
			<li>MySQL Says:".mysqli_error($dbconn)."</li>
			</ul></p>
			<p>Once you have checked the above <a href=\"install_programo.php?step=2\">click here</a> to try again</p>";
			exit();
	}

$sql ="CREATE TABLE IF NOT EXISTS `$dbn`.`aiml_userdefined` (
  `id` int(11) NOT NULL auto_increment,
  `aiml` text NOT NULL,
  `pattern` varchar(255) NOT NULL,
  `template` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `botid` int(11) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";

	$result = mysqli_query($dbconn,$sql);
	if($result)
	{
		echo "<br/>AIML_USERUNDEFINED table created";
	}
	else
	{
		echo "<p>Error trying to create aiml_undefeined table.<br/>Please check:
			<ul>
			<li>The mysql user details are correct</li>
			<li>The user has got the correct privilges</li>
			<li>MySQL Says:".mysqli_error($dbconn)."</li>
			</ul></p>
			<p>Once you have checked the above <a href=\"install_programo.php?step=2\">click here</a> to try again</p>";
			exit();
	}

$sql ="CREATE TABLE IF NOT EXISTS `$dbn`.`botpersonality` (
  `id` int(11) NOT NULL auto_increment,
  `bot` tinyint(4) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `value` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `botname` (`bot`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";

	$result = mysqli_query($dbconn,$sql);
	if($result)
	{
		echo "<br/>BOTPERSONALITY table created";
	}
	else
	{
		echo "<p>Error trying to create botpersonality table.<br/>Please check:
			<ul>
			<li>The mysql user details are correct</li>
			<li>The user has got the correct privilges</li>
			<li>MySQL Says:".mysqli_error($dbconn)."</li>
			</ul></p>
			<p>Once you have checked the above <a href=\"install_programo.php?step=2\">click here</a> to try again</p>";
			exit();
	}

$sql ="CREATE TABLE IF NOT EXISTS `$dbn`.`conversation_log` (
  `id` int(11) NOT NULL auto_increment,
  `input` text NOT NULL,
  `response` text NOT NULL,
  `userid` int(11) NOT NULL,
  `bot_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";

	$result = mysqli_query($dbconn,$sql);
	if($result)
	{
		echo "<br/>CONVERSATION_LOG table created";
	}
	else
	{
		echo "<p>Error trying to create conversation_log table.<br/>Please check:
			<ul>
			<li>The mysql user details are correct</li>
			<li>The user has got the correct privilges</li>
			<li>MySQL Says:".mysqli_error($dbconn)."</li>
			</ul></p>
			<p>Once you have checked the above <a href=\"install_programo.php?step=2\">click here</a> to try again</p>";
			exit();
	}

$sql ="CREATE TABLE IF NOT EXISTS `$dbn`.`spellcheck` (
  `id` int(11) NOT NULL auto_increment,
  `missspelling` varchar(100) NOT NULL,
  `correction` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";

	$result = mysqli_query($dbconn,$sql);
	if($result)
	{
		echo "<br/>SPELLCHECK table created";
	}
	else
	{
		echo "<p>Error trying to create spellcheck table.<br/>Please check:
			<ul>
			<li>The mysqli user details are correct</li>
			<li>The user has got the correct privilges</li>
			<li>MySQLI Says:".mysqli_error($dbconn)."</li>
			</ul></p>
			<p>Once you have checked the above <a href=\"install_programo.php?step=2\">click here</a> to try again</p>";
			exit();
	}

$sql ="CREATE TABLE IF NOT EXISTS `$dbn`.`undefined_defaults` (
  `id` int(11) NOT NULL auto_increment,
  `bot` int(11) NOT NULL,
  `pattern` varchar(255) NOT NULL,
  `replacement` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";

	$result = mysqli_query($dbconn,$sql);
	if($result)
	{
		echo "<br/>UNDEFINED_DEFAULTS table created";
	}
	else
	{
		echo "<p>Error trying to create undefined_defaults table.<br/>Please check:
			<ul>
			<li>The mysql user details are correct</li>
			<li>The user has got the correct privilges</li>
			<li>MySQL Says:".mysqli_error($dbconn)."</li>
			</ul></p>
			<p>Once you have checked the above <a href=\"install_programo.php?step=2\">click here</a> to try again</p>";
			exit();
	}

$sql ="CREATE TABLE IF NOT EXISTS `$dbn`.`unknown_inputs` (
  `id` int(11) NOT NULL auto_increment,
  `input` text NOT NULL,
  `userid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";

	$result = mysqli_query($dbconn,$sql);
	if($result)
	{
		echo "<br/>UNKNOWN_INPUTS table created";
	}
	else
	{
		echo "<p>Error trying to create unknown_inputs table.<br/>Please check:
			<ul>
			<li>The mysql user details are correct</li>
			<li>The user has got the correct privilges</li>
			<li>MySQL Says:".mysqli_error($dbconn)."</li>
			</ul></p>
			<p>Once you have checked the above <a href=\"install_programo.php?step=2\">click here</a> to try again</p>";
			exit();
	}

$sql ="CREATE TABLE IF NOT EXISTS `$dbn`.`users` (
  `id` int(11) NOT NULL auto_increment,
  `session_id` varchar(255) NOT NULL,
  `chatlines` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `referer` text NOT NULL,
  `browser` text NOT NULL,
  `date_logged_on` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `last_update` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";

	$result = mysqli_query($dbconn,$sql);
	if($result)
	{
		echo "<br/>USERS table created";
	}
	else
	{
		echo "<p>Error trying to create users table.<br/>Please check:
			<ul>
			<li>The mysql user details are correct</li>
			<li>The user has got the correct privilges</li>
			<li>MySQL Says:".mysqli_error($dbconn)."</li>
			</ul></p>
			<p>Once you have checked the above <a href=\"install_programo.php?step=2\">click here</a> to try again</p>";
			exit();
	}

	echo "<p>Now procceed to the next stage.<br/>" .
			"<a href=\"install_programo.php?step=3\">Click here</a> to install the AIML into the database." .
			"</p>";
	mysqli_close($dbconn);

}

function populate_tables_fast()
{
	global $aimlsql_path;
	global $dbn;
	$dbconn = dbopen();
	$time_start = microtime(true);
	
	$filelist = array();
	
    if($handler = opendir($aimlsql_path)) 
    {
            while (($sub = readdir($handler)) !== FALSE) 
            {
                if ($sub != "." && $sub != ".." && $sub != "Thumb.db") 
                {
                    if(!in_array($aimlsql_path.$sub,$filelist))
                    {
                    	$filelist[] = $aimlsql_path.$sub;
                	}
                }
            }   
            closedir($handler);
        }
    
    foreach ($filelist as $index => $filename)
    {
    	$insertline=array();
    	
    	if($fh = fopen( $filename,"r"))
    	{
	    	while (!feof($fh))
	    	{
	        	$insertline[] = fgets($fh);
	      	}
			fclose($fh);
		       
	        foreach($insertline as $id => $sql)
	    	{
		    	if(trim($sql)!="")
		    	{
	    	   		$sql = str_replace("INSERT INTO", "INSERT INTO `$dbn`.",$sql);
		    		mysqli_query($dbconn,$sql);
		
		    		if(mysqli_error($dbconn))
	    			{
		    			echo "<br/>The AIML installer broke on $filename";
		    			echo "<br/>SQL: ".htmlentities($sql);
		    			echo "<br/>ERROR: ".mysqli_error($dbconn);
		    			die();
	    			}
	    		}
	    	}
	    } 
	}
	
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	
	$sql = "SELECT COUNT(id) as tot FROM `$dbn`.`aiml`";
	$result = mysqli_query($dbconn,$sql);
	$row = mysqli_fetch_array($result);
	$total = $row['tot'];
	
	echo "<p>The AIML files has successfully been loaded into the database<br/>" .
			"The installer took $time seconds to load $total records.<br/>" .
			"There should be about 47255 records in the database give or take a few</p>";

	mysqli_close($dbconn);
	echo "<p>Now procceed to the next stage <a href=\"install_programo.php?step=4\">click here</a></p>";
}
	

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>J.A.R.V.I.S. Chatbot Installer</title>
</head><body>
<?php
if(isset($_GET['step']))
{
	$step = $_GET['step'];
	
}
else
{
	$step = "";
}
	switch($step)
	{
		case '1':
			echo $step_one;
			echo "<h2>Do not run this installer if you are upgrading your Jarvis version.<br/>This will wipe reset your database and you will lose all your exisiting bot brain, personality and settings.<br>DELETE THIS SCRIPT TO PREVENT MALICIOUS RESETS FROM NASTY PEOPLE</h2>";
			break;
		case '2':
			echo $step_two;
			createTables();
			break;
		case '3':
			echo $step_three;
			//count all files in both directorys
			populate_tables_fast();
				
			break;
		case '4':
			echo $step_four;
			loadBotData();
			break;				
		case '5':
			echo $step_five;
			break;			
		default:
			echo $step_one;
			break;
	}



?>

</body>
</html>
