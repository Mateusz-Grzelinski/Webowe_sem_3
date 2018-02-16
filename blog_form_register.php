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

<h1>Formularz do zakładanie konta:</h1>
  <form action="blog_php_register.php" method="post">

  <div>
    Imię: <br/>
    <input name="name" value="" /> <br/><br/>

    User password:<br/>
    <input name="passwd" value="" type="password" /> <br/><br/>

    Nazwa blogu: <br/>
    <input name="blog_name" value="" /> <br/><br/>

    Opis: <br/>
    <textarea name="opis" value="" type="text" cols="80" rows="10"> </textarea> <br/>

    <input type="submit" value="Wyślij" name="submit" />
     <button type="reset" value="Reset">Reset</button>
  </div>

</body>
</html>
