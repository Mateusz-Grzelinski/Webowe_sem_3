<?php
$filename = "komunikator.txt";
$file = fopen($filename, "a");
$count = count(file($filename));
/* @var $_GET array */
$text = $_GET["nick"].": ".$_GET["message"]."\n";
fwrite($file, $text);
fclose($file);

while ($count > 11) {
	$file = file($filename);
	unset($file[0]);
	file_put_contents($filename, $file);
	$count--;
}

?>