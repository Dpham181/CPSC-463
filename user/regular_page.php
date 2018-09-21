<?php

session_start();
if ($_SESSION['type'] !== 'R') {
 $_SESSION = array();
 session_destroy();
 header("location: home.html");
 exit;
}
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
 header("location: home.html");
 exit;
}
if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
 header("location: home.html");
 exit;
}



 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Regular Site</title>
  </head>
  <body>
    
  </body>
</html>
