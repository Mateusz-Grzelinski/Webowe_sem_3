<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lab PHP</title>
</head>
<body>
    <?php echo 'Przykładowy tekst' ?>

  <form action="first.php" method="post">

  <div>
    liczba (post):<br />
    <input name="n" value="" /><br />

    plik (post):<br />
    <input name="plik" value="" /><br />
    <input type="submit" value="Wyślij" name="submit" />
  </div>

  </form>

 <br/> <br/> <br/> <br/> <br/>
 <br/> <br/> <br/> <br/> <br/>

  <form action="first.php" method="get">

  <div>
    Imię drugie (get):<br />
    <input name="imie" value="" /><br />
    <input type="submit" value="Wyślij" name="submit" />
  </div>

  </form>

  <form action="first.php" method="get">

  <div>
    krzyzowka (get):<br />
    <input name="krzyzowka" value="" /><br />
    <input type="submit" value="Wyślij" name="submit" />
  </div>

  </form>


<?php
  function witaj($imie = 'Jasiu') {
      return 'Cześć ' . $imie . '!';
  }

  echo('<br/> To jest _GET: <br/>');
  print_r($_GET);
  echo("<br/> To jest _POST: <br/>");
  print_r($_POST);
  echo("<br/><br/>");

  if ($_GET[imie] == 'Mateusz'){
    echo("access granted");
    print_r(witaj($_GET[imie]));
  }
  else {
    echo("GO AWAY!!!");
  }

  // header('Content-type: text/plain');
  // $plik = fopen($_GET['imie'].'.txt', 'r');
  // while (!feof($plik)) {
  //     $s = fgets($plik);
  //     echo $s;
  // }
  // fclose($plik);

    function print_loop(){
      $plik = fopen($_POST['plik'].'.txt', 'r');
      $read = fgets($plik);
        echo ($read);
      $n = $_POST['n'] + 0;
      while ( $n > 0 ){
        echo ($read);
        $n = $n - 1;
      }
      fclose($plik);
    }

  function krzyzowka(){
    $plik = fopen("slownik.txt", 'r');
    $klucz = $_GET['krzyzowka'];
    while (!feof($plik)) {
        $read = fgets($plik);
        for($i=0; i<strlen($read); $i++){
          if ($read[i] == '_'){
            continue;
          }elseif($read[i] == $read[i]){
            
          }
          echo($letter);
        }
    }
    
    fclose($plik);
  }
  // print_loop();
?>
</body>
</html>
