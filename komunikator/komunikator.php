<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Czat</title>
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />

		<link rel="alternate stylesheet" title="Horizontal layout" href="/css/master_alternative.css" type="text/css" media="screen" />
		<script type="text/javascript" src="komunikator.js"></script>

	</head>
	<body>
		<?php include '../menu.php'; ?> <br/>

		<input type="checkbox" name="check" id="check" onchange="update();"/>Uruchom chat<br/>
		<textarea rows="20" cols="80" id="chat" style="background: #FFF; color:black" disabled></textarea><br/>

		Podaj nick: <input type="text" name="nick" id="nick" /><br/>
		Wiadomość: <br/><input type="text" name="message" id="message" /><br/>
		<button type="button" value="Wyślij" onclick="if (checked() && checkValues()) {
					send();
				} else {
					alert('Nick i wiadomość');
				}">Wyślij</button>
		<br/><br/><br/>

		<div id="debug"></div>
	</body>
</html>
