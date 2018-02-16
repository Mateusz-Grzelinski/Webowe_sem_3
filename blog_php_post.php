<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Zrobiłeś post</title>
	</head>
	<body>
		<?php include 'menu.php'; ?>

		<?php
// znajdź do jakiegoblogu przypisać post
// var_dump($_POST);
		$dirs = scandir('.');
		$blogdir = "";
		foreach ($dirs as $path) {
			if (is_dir($path) and $path != "." && $path != "..") {
				// echo $path, "<br />";
				$infofile = fopen($path . "/info", 'r');
				$tmp = fgets($infofile);
				// echo "to jest tmp", $tmp, $_POST["user"], strlen($tmp),strlen($_POST["user"]), "<br />"; //, strcmp($_POST["user"], $tmp);
				if (strcmp($_POST["user"], substr($tmp, 0, -1)) == 0) {
					// echo "uzytkownik ok <br />", md5($_POST["passwd"]), "<br />";
					$tmp = fgets($infofile);
					if (strcmp(md5($_POST["passwd"]), substr($tmp, 0, -1)) == 0) {
						// echo "Hasło ok";
						$blogdir = $path;
						break;
					}
				}
				fclose($infofile);
			}
		}
// użyj semafor do synchronizacji
		$SEM_KEY = 1;
		$sem_id = sem_get($SEMKEY, 1);

		if ($sem_id === false) {
			echo "Fail to get semaphore";
			exit;
		}

// check if counter file exist
		if ($blogdir != "" && !file_exists($blogdir . "/counter") && sem_acquire($sem_id)) {
			$filecounter = fopen($blogdir . "/counter", 'w');
			fwrite($filecounter, "0\n");
			fclose($filecounter);
			sem_release($sem_id);
		}

// stwórz plik z postem i zapisz załączniki
		if ($blogdir != "" && sem_acquire($sem_id)) {
			// unikalny licznik
			$filecounter = fopen($blogdir . "/counter", 'r');
			$counter = 0;
			$counter = fgets($filecounter);
			$counter = (int) $counter + 1;
			fclose($filecounter);
			file_put_contents($blogdir . "/counter", $counter . "\n");

			// zapisz treść
			$data = explode('-', $_POST['date']);
			$data = implode($data);
			$time = explode(':', $_POST['time']);
			$time = implode($time);

			$identifier = $data . $time . date('s');
			$filepost = fopen($blogdir . '/' . $identifier . $counter, 'w');
			fwrite($filepost, $_POST['opis']);
			fclose($filepost);

			// zapisz załączniki
//			 var_dump($_FILES);
			// echo "<br /><br />";
			$uploadedfiles = $_FILES['file']['tmp_name'];
			for ($i = 0; $i < count($uploadedfiles); $i++) {
				if ($uploadedfiles == "") {
					continue;
				}
				$tmppath = $uploadedfiles["$i"];
				echo "<br />path to, i to ", $i, " tmp:", $tmppath;
				$name = $_FILES["file"]["name"][$i];
				$ext = explode(".", $name);
				$extension = end($ext);
				echo $extension;
				move_uploaded_file(
						$tmppath, $blogdir . '/' . $identifier . $counter . '_' . $i . '.' . $extension
				);
			}
			sem_release($sem_id);
			echo "<br />Post z załącznikami zapisany";
		}
		?>


	</body>
</html>
