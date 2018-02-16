<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lab PHP</title>
</head>
<body>
<?php include 'menu.php';?>

<?php
// echo 'debug info:<br /> ';
// var_dump($_POST);
// echo "<br/>";

$SEM_KEY = 2;
$sem_id = sem_get($SEMKEY, 1);

if ($sem_id === false) {
    echo "Fail to get semaphore";
    exit;
}

if (sem_acquire($sem_id)) {
    $dir = $_POST["blog_name"];
    $user_exists = 0;
    foreach (scandir('.') as $path) {
        if (is_dir($path) and $path!= "." && $path != "..") {
            $infofile = fopen($path."/info", 'r');
            $tmp = fgets($infofile);
            if (strcmp($_POST["name"], substr($tmp, 0, -1)) == 0) {
                echo "uzytkownik istnieje";
                $user_exists = 1;
                break;
            }
            fclose($infofile);
        }
    }

    echo "status: ",$user_exists;
    if (mkdir($dir, 0777) && $user_exists == 0) {
        $file = fopen($dir."/info", 'w');
        fwrite($file, $_POST["name"]."\n");
        $encoded = md5($_POST["passwd"]);
        fwrite($file, $encoded."\n");
        fwrite($file, $_POST["opis"]."\n");
        fclose($file);
        echo "utworzono nowy blog";
    } else {
        echo "nope. Użytkownik lub blog już istnieje";
    }
    sem_release($sem_id);
}


?>

</body>
</html>
