<html>
<title>Talk It Up!</title>
<body>
	<center>
<?php

$log = fopen("log.txt","a");
$password = $_POST['password'];
$xml = $_POST['xml'];
$channel = "</channel>";
$rss = "</rss>";
$xml_temp_name = "xml_temp.xml";

$domain = "jeehtoven.com";
$directory_name = $_POST['directory'];
$home = "/home5/jeehtove/public_html/";
$directory = $home . $directory_name;
$count = 0;

date_default_timezone_set('America/New York');
$date = date('m/d/Y h:i:s a', time());

$title = $_POST['title'];
$author = $_POST['author'];
$subtitle = $_POST['subtitle'];
$summary = $_POST['summary'];

$podcast_file_tmp = $_FILES['podcast']['tmp_name'];
$podcast_file = $_FILES['podcast']['name'];
$image_file = $_FILES['image']['name'];
$image_file_tmp = $_FILES['image']['tmp_name'];

$image = "http://" . $domain . "/" . $directory_name . "/" . $image_file;
$enclosure = "http://" . $domain . "/" . $directory_name . "/" . $podcast_file;
$guid = "http://" . $domain . "/" . $directory_name . "/" . $podcast_file;
$pubdate = $date;

$duration = $_POST['duration'];

$explicit = $_POST['explicit'];


// upload file
if (move_uploaded_file($podcast_file_tmp,$directory . "/" . $podcast_file) && $password == '1234')
  {
  echo "Successfully uploaded $podcast_file.";
  }
else
  {
  echo "Error uploading $podcast_file.<br><br>";

	print_r(error_get_last());
  }

// close connection
ftp_close($ftp_conn);

if (file_exists($xml))
{
	fwrite($log, $date . " " . $xml . " does exist. Attempting to open file..." . PHP_EOL);
	$xml_open = fopen($xml,"r");
	fwrite($log, $date . " " . $xml . " opened. Attempting to open temp file..." . PHP_EOL);
	$xml_temp = fopen($xml_temp_name,"a") or die("Unable to open file!");
	while(!feof($xml_open))
	{
		fwrite($log, $date . " " . $xml . " hasn't ended. Attempting to create work area..." . PHP_EOL);
		$xml_work_area = fgets($xml_open);
		$xml_work_area = trim($xml_work_area);
		
		//write($log, $date . " " . "Does xml_work_area equal </channel>? " . $xml_work_area . PHP_EOL);
		//fwrite($log, $date . " " . "Does xml_work_area equal </rss>? " . $xml_work_area . PHP_EOL);
		
		if(strcmp($xml_work_area,$rss) == 0 || strcmp($channel,$xml_work_area) == 0)
		{
			
		}
		
		else
		{
			$answer = strcmp($xml_work_area,$channel);
			fwrite($log, $date . " " . "Current work area: " . $xml_work_area . PHP_EOL);
			fwrite($xml_temp,$xml_work_area . PHP_EOL);
			fwrite($log, $date . " " . "Reading next line...by the way: strcmp = " . $answer . " while the work area was " . $xml_work_area . ". I compared with " . $channel. PHP_EOL);	
		}
		
	}
	
	
	
	fwrite($xml_temp,"<item>". PHP_EOL);
	fwrite($xml_temp,"<title>" . $title . "</title>". PHP_EOL);
	fwrite($xml_temp,"<itunes:author>" . $author . "</itunes:author>". PHP_EOL);
	fwrite($xml_temp,"<itunes:subtitle>" . $subtitle . "</itunes:subtitle>". PHP_EOL);
	fwrite($xml_temp,"<itunes:summary>" . $summary . "</itunes:summary>". PHP_EOL);
	fwrite($xml_temp,"<itunes:image href='" . $image . "'/>". PHP_EOL);
	fwrite($xml_temp,"<enclosure url='" . $enclosure . "' type='audio/x-m4a' />". PHP_EOL);
	fwrite($xml_temp,"<guid>" . $guid . "</guid>". PHP_EOL);
	fwrite($xml_temp,"<pubDate>" . $pubdate . "</pubDate>". PHP_EOL);
	fwrite($xml_temp,"<itunes:duration>" . $duration . "</itunes:duration>". PHP_EOL);
	fwrite($xml_temp,"<itunes:explicit>" . $explicit . "</itunes:explicit>". PHP_EOL);
	fwrite($xml_temp,"</item>". PHP_EOL);
	
	//fwrite($xml_temp,"<itunes:explicit>" . $explicit . "</itunes:explicit>". PHP_EOL);
	fwrite($xml_temp,"</channel>". PHP_EOL);
	fwrite($xml_temp,"</rss>". PHP_EOL);
	
	fclose($xml_temp);
	fclose($xml_open);
	rename($xml, "xml_backup_" . date("mdYHi"));
	rename($xml_temp_name,$xml);
	
	fwrite($log, $date . " " . "EOF reached." . PHP_EOL);
	
	echo " Changes updated in " . $xml .". Thank you.";
	
}

else 
{
	fwrite($log, $date . " " . $xml . " not found." . PHP_EOL);
	echo "XML File not found.";
}

?>
	</center>
<body>