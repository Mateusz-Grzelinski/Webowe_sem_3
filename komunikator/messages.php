<?php
sleep(1);
$filename = "komunikator.txt";

if (!file_exists($filename)) { 
	$file = fopen($filename, "w");
	fwrite($file, "Czatujmy!\n");
	fclose($file);
}
else { 
	$file = fopen($filename, "r");
	$text = fread($file, filesize($filename));
	fclose($file);
	echo $text;
}
?>
