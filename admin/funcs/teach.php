<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
function teachBotForm()
{
	$form = "<div id=\"container\"><fieldset> <br/>
    <legend>Add new</legend><br/>
	
	<form name=\"teach\" action=\"teach.php\" method=\"post\">
			
			<div class=\"fm-opt\">
				<label for=\"topic\">Topic: </label>
				<input type=\"text\" id=\"topic\" name=\"topic\" />
			</div>		
			
			<div class=\"fm-opt\">
				<label for=\"thatpattern\">Previous Bot Res: </label>
				<input type=\"text\" id=\"thatpattern\" name=\"thatpattern\" />
			</div>	
			
			<div class=\"fm-opt\">
				<label for=\"pattern\">User Input: </label>
				<input type=\"text\" id=\"pattern\" name=\"pattern\" />
			</div>
		
			<div class=\"fm-opt\">
				<label for=\"template\">Bot Response: </label>
				<input type=\"text\" id=\"template\" name=\"template\" />
			</div>
	</fieldset>
			<div id=\"fm-submit\" class=\"fm-req\">
				<input type=\"submit\" name=\"action\" id=\"action\" value=\"teach\">
			</div>
			</form></div>";
	




					
	return $form;
	
}

function insertAIML()
{
	//db globals
	global $dbn;
	$dbconn = openDB();
	
	$template = mysqli_escape_string($dbconn,trim($_POST['template']));
	$pattern = strtoupper(mysqli_escape_string($dbconn,trim($_POST['pattern'])));
	$thatpattern = strtoupper(mysqli_escape_string($dbconn,trim($_POST['thatpattern'])));
	$topic = strtoupper(mysqli_escape_string($dbconn,trim($_POST['topic'])));
	
	if(($pattern=="") || ($template=="")) 
	{
		$msg = "<div id=\"errMsg\">You must enter a user input and bot response.</div>"; 
	}
	else
	{
		$sql = "INSERT INTO `$dbn`.`aiml` (`id`,`pattern`,`thatpattern`,`template`,`topic`,`filename`) VALUES (NULL,'$pattern','$thatpattern','$template','$topic','ADMIN ADDED')";
		
		$result = mysqli_query($dbconn,$sql)or die(mysqli_error($dbconn));
		
		if($result)
		{
			$msg = "<div id=\"successMsg\">AIML added.</div>"; 
		}
		else
		{
			$msg = "<div id=\"errMsg\">There was a problem adding the AIML - no changes made.</div>"; 
		}	
	}
	mysqli_close($dbconn);
	
	return $msg;
}

function showhelp()
{
$showhelp = "<div>
  <b class=\"hintbox\">
  <b class=\"hintbox1\"><b></b></b>
  <b class=\"hintbox2\"><b></b></b>
  <b class=\"hintbox3\"></b>
  <b class=\"hintbox4\"></b>
  <b class=\"hintbox5\"></b></b>

  <div class=\"hintboxfg\">



		<h3>Help...</h3>
		<dd>Adding a 'Topic' means that the bot will only be able to access this response if a previous aiml category has set this topic as it's current topic.</dd>
		<dd>The 'Previous Bot Response' means that the bot must have answered with this text in it's last response.</dd>
		<dd>The 'User Input' is the the users input used to access the bots response.</dd>
		<dd>The 'Bot Response' is the text the bot will output when the 'user Input' has been matched.</dd>

	
	<br/>

		<h3>Simple Example</h3>
			<dd>User input: hello how are you</dd>
			<dd>Bot Response: I am well thank you and you?</dd>		
		
		<br/>

		<h3>Intermediate example:</h3>			
			<dd>Previous Bot Response: I am well thank you and you</dd>
			<dd>User input: ok thanks </dd>
			<dd>Bot Response: That is great to hear</dd>
	
		
		<br/>
	
		<h3>Advanced example:</h3>				
			
			<dd>1. First response <u>MUST</u> set the topic</dd>
			<dd>User input: I like chatbots </dd>
			<dd>Bot Response: What do you like about them?<set topic=\"chatbots\"></dd>
					<br/>
			<dd>2. Second pattern can only be accessed because the topic has been set in the previous response</dd>
			<dd>Topic: chatbots</dd>
			<dd>User input: I just think they are cool </dd>
			<dd>Bot Response: Yes chatbots are cool </dd>
	


   <br/>--You can find alot of information on the net about writing well formed aiml.<br/>--If you want to learn more about writing AIML <a href=\"http://www.alicebot.org/documentation/aiml-primer.html\" target=\"_new\" class=\"hbox\">start here</a> 
   </div>

  <b class=\"hintbox\">
  <b class=\"hintbox5\"></b>
  <b class=\"hintbox4\"></b>
  <b class=\"hintbox3\"></b>
  <b class=\"hintbox2\"><b></b></b>
  <b class=\"hintbox1\"><b></b></b></b>
</div>";

return $showhelp;

}


?>