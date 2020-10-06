<?PHP
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//jarvis chatbot admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
function getNews()
{
	//Pull certain elements 
	$news = "";
	 $reader = new XMLReader(); 
	  $reader->open("http://www.program-o.com/xml/programo_news.xml"); 
	while ($reader->read()) { 
	 switch ($reader->nodeType) { 
	   case (XMLREADER::ELEMENT): 
	
	if ($reader->name == "title") 
		 { 
		   $reader->read(); 
		   $title = trim($reader->value); 
		   $news .= "<div id=\"newsTitle\"><br/>$title</div>"; 
		   break; 
		 } 
	
	 if ($reader->name == "content") 
		 { 
		   $reader->read(); 
		   $content = trim( $reader->value ); 
		   $news .= "<div id=\"newsBody\"><br/>$content</div><br/><hr>"; 
		   break; 
		 } 
	
	 if ($reader->name == "date") 
		{ 
		   $reader->read(); 
		   $date = trim( $reader->value ); 
		   $news .= "<div id=\"newsDate\"><br/>$date</div>"; 
		   break; 
		} 
	  } 
	} 
	
	return $news;
}
?>