
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Zrobiłeś komentarz</title>
	</head>
	<body>

		<?php include 'menu.php'; ?>

		<?php
		$searchfor = $_GET['search'];

		if ($searchfor == "") {
			echo "<h2>Wszystkie blogi: </h2>";
			$dirs = scandir('.');
			foreach ($dirs as $blog) {
				if (is_dir($blog) && $blog != "." && $blog != "..") {
					// blog_show.php?search=moj+user
					echo "$blog";
					echo "<a class='blog' href=' blog_show.php?search=", urlencode($blog), "'> ", $blog, "</a> <br />";
				}
			}
		} else {
			$dirs = scandir('.');
			$blogistnieje = 0;
			foreach ($dirs as $blog) {
				if (is_dir($blog) && $blog != "." && $blog != ".." && strcmp($blog, $searchfor) == 0) {
					echo "<h1> Blog: $searchfor </h1>";
					$blogistnieje = 1;
					foreach (scandir($blog) as $content) {
						// jeśli zwykły post to wyświetl:
						$filename = $blog . '/' . $content;
						if ($content != "." && $content != ".." && $content != "info" && $content != "counter" && count(explode('.', $filename)) == 1) {
							echo "<h2> Post </h2>", file_get_contents($filename), "<br />";
							// poszukaj komentarzy:
							// var_dump(scandir($filename.'.k'));
							if (file_exists($filename . '.k')) {
								echo "<h3>Komentarze: </h3>";
								$commdir = opendir($filename . '.k');
								$readdir = 1;
								while ($readdir) {
									$readdir = readdir($commdir);
									// var_dump($readdir);
									if ($readdir != '.' && $readdir != '..') {
										echo file_get_contents($filename . '.k' . '/' . $readdir), "<br />";
									}
								}
								closedir($commdir);
							}
							// poszukaj załączników
							$i = 0;
							while (file_exists($filename . '_' . $i . '.txt')) {
//								if (file_exists($filename . '_' . $i . '.txt')) {
								echo "<a href='", $filename . '_' . $i . '.txt', "'> Załącznik $i </a> <br />";
								$i++;
//								}
							}
//							for ($i = 0; $i < 10; $i++) {
//								if (file_exists($filename . '_' . $i . '.txt')) {
//									echo "<a href='", $filename . '_' . $i . '.txt', "'> Załącznik $i </a> <br />";
//								}
//							}
						}
					}
				}
				if ($blogistnieje) {
					break;
				}
			}
			if (!$blogistnieje) {
				echo "<h1>Blog nie istnieje</h1>";
			}
		}
		?>





	</body>
</html>
