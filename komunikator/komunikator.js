
function checked() {
	return document.getElementById("check").checked;
}

function checkValues() {
	return document.getElementById("nick").value && document.getElementById("message").value;
}

function update() {
	document.getElementById("chat").innerHTML = "";

	var xmlhttp;
	if (window.XMLHttpRequest) { // Dla przegladarek IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // Dla przegladarek IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange = function () {
//		sleep(1);
		if (xmlhttp.readyState == 3 && xmlhttp.status == 200) {
			if (checked()) { 
				document.getElementById("chat").innerHTML = xmlhttp.responseText;
			}
		}
		if (xmlhttp.readyState == 4) {
			xmlhttp.open("GET", "messages.php", true);
			xmlhttp.send();
		}
	}
	xmlhttp.open("GET", "messages.php", true);
	xmlhttp.send();
}

function send() {
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("debug").innerHTML = xmlhttp.responseText; // Do debugowania
		}
	}


	var nickValue = encodeURIComponent(document.getElementById("nick").value);
	var messageValue = encodeURIComponent(document.getElementById("message").value);

	xmlhttp.open("GET", "wyslij.php?nick=" + nickValue + "&message=" + messageValue, true);
	xmlhttp.send();

	document.getElementById("message").value = "";
}