<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="alternate stylesheet" title="Horizontal layout" href="css/master_alternative.css" type="text/css" media="screen" />
		<title>Lab PHP</title>

		<script type="text/javascript">
            var repeat = 1;

            function setTime() {
                document.getElementById('time_id').value = date.getHours() + ':' + ('0' + date.getMinutes()).slice(-2); // + ':' + date.getSeconds();
            }
            function setDate() {
                element = document.getElementById('date_id');
                element.value = date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
            }
            function setCurrentTime() {
                date = new Date();
                setTime();
                setDate();
                if (repeat === 1) {
                    window.setTimeout('setCurrentTime()', 1000);
                }
            }
            function stop() {
                repeat = 0;
            }
            function validateTime() {
                element = document.getElementById('time_id');
                var match = element.value.match(/(\d{2}):(\d{2})$/);
                if (match != null && match != undefined && match[1] < 24 && match[1] > 0 && match[2] < 60 && match[2] >= 0) {
                } else {
                    setTime();
                }
            }
            function validateDate() {
                element = document.getElementById('date_id');
                var match = element.value.match(/^(\d{4})-(\d{2})-(\d{2})$/);

                if (match != null && match != undefined && match[2] > 0 && match[2] < 13 && match[3] < 31 && match[3] > 0) {
                } else {
                    setDate();
                }
            }
            function addAttachmentField() {
				var newAttachment = document.createElement('input');
				newAttachment.type = "file";
				newAttachment.name = "file[]";
//				newAttachment.value = "wyślij jeszcze";
				document.getElementById("post_div").appendChild(newAttachment);
            }
		</script>

	</head>
	<body onload="setCurrentTime();">
	<!--<body>-->
		<!--<script type="text/javascript"> setCurrentTime();</script>-->
		<?php include 'menu.php'; ?>

		<h1>Formularz do robienia posta</h1>
		<form action="blog_php_post.php" method="post" enctype="multipart/form-data">

			<div id="post_div">
				Imię: <br/>
				<input name="user" value="user" /> <br/><br/>

				User password:<br/>
				<input name="passwd" value="user" type="password" /> <br/><br/>

				Data:<br/>
				<input name="date"  id="date_id" value="" type="text" onchange="validateDate()" onclick="stop()"/> <br/><br/>

				Godzina:
				<input name="time" id="time_id" value="" type="text" onchange="validateTime()" onclick="stop()" /> <br/><br/>

				Wpis: <br/>
				<textarea name="opis" type="text" cols="80" rows="10">simple description</textarea> <br/>


				Załączniki (maks 3) <br/><br/>
				<input type="button" value="Add attachment" onclick="addAttachmentField()"/> <br/><br/>
				<input name="file[]" value="" type="file" /> <br/><br/>
				<!--<input name="file[]" value="" type="file" /> <br/><br/>-->
				<!--<input name="file[]" value="" type="file" /> <br/><br/>-->

				<input type="submit" value="Wyślij" name="submit" />
				<button type="reset" value="Reset">Reset</button> <br/> <br/>
			</div>
		</form>


	</body>
</html>
