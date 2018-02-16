<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Zrobiłeś komentarz</title>
</head>
<body>

<?php include 'menu.php';?>
<?php
// check if counter file exist
// if (!file_exists("counter")) {
//     $filecounter = fopen("counter", 'w');
//     fwrite($filecounter, "0\n");
//     fclose($filecounter);
// }

// stwórz plik z komentarzem

// unikalny licznik
// $filecounter = fopen("counter", 'r');
// $counter = 0;
// $counter = fgets($filecounter);
// $counter = (int)$counter + 1;
// fclose($filecounter);
// file_put_contents("counter", $counter."\n");
//
// // zapisz treść
// $data = explode('-', $_POST['date']);
// $data = implode($data);
// $time = explode(':', $_POST['time']);
// $time = implode($time);
//
// $identifier = $data.$time.date('s');
// $filepost = fopen($blogdir.'/'.$identifier.$counter, 'w');
// fwrite($filepost, $_POST['opis']);
// fclose($filepost);
// użyj semafor do synchronizacji

$SEM_KEY = 4;
$sem_id = sem_get($SEM_KEY, 1);

if ($sem_id === false) {
    echo "Fail to get semaphore";
    exit;
}

// stwórz katalog jeśli nie istnieje
// if (sem_acquire($sem_id)) {
    $commdir = $_POST['post'].'.k';
    if (sem_acquire($sem_id)) {
        if (!file_exists($commdir)) {
            mkdir($commdir, 0777);
        }

        // nadaj unikalną nazwę dla komentarza
        $filename = 0;

        while (file_exists($commdir.'/'.$filename)) {
            $filename++;
        }

        $commfile = fopen($commdir.'/'.$filename, 'w');
        fwrite($commfile, $_POST['comm_val']);
        fwrite($commfile, "\n");
        fwrite($commfile, date('Y-m-d, H:i:s'));
        fwrite($commfile, "\n");
        fwrite($commfile, $_POST['author']);
        fwrite($commfile, "\n");
        fwrite($commfile, $_POST['opis']);
        fwrite($commfile, "\n");
        fclose($commfile);
        sem_release($sem_id);
    }

    echo "zrobiono komentarz";
    // sem_release($sem_id);
// }

?>

</body>
</html>
