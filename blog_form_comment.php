<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="alternate stylesheet" title="Horizontal layout" href="css/master_alternative.css" type="text/css" media="screen" />
    <title>Lab PHP</title>
</head>
<body>
<?php include 'menu.php';?>

  <h1> Napisz ładny komentarz</h1>
  <form action="blog_php_comment.php" method="post">
  <div>
    Komentowany Wpis:<br>

   <select name="post">
       <?php
       $dirs = scandir('.');
       foreach ($dirs as $path) {
           if (is_dir($path) and $path!= "." && $path != "..") {
               $userspecyficdir = scandir($path);
               foreach ($userspecyficdir  as $post) {
                   $postpath = $path.'/'.$post;
                   if ($postpath != "."
                     && $postpath != ".."
                     && count(explode('.', $post)) == 1
                     && $post != "info"
                     && $post != "counter") {
                       echo "<option>" . $path.'/'.$post . "</option>";
                   }
               }
           }
       }
       ?><br>
   </select><br><br>


    <textarea name="opis" value="Twój komentarz" type="text" cols="80" rows="10"> </textarea> <br/>
    <select name="comm_val">
     <option value="pozytywny">pozytywny</option>
     <option value="neutralny">neutralny</option>
     <option value="negatywny">negatywny</option>
     <option value="pozytywny">nie wiem :|</option>
    </select>
    Autor:
    <input name="author" value="" /> <br/><br/>

    <input type="submit" value="Wyślij" name="submit" />
     <button type="reset" value="eset">Reset</button>
  </div>

</body>
</html>
