<?php


define('DB_SERVER', 'localhost');
define('DB_NAME', 'STORE_SITE');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'admin123');

$link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

if ($link === false){

  echo " there is something wrong with the sql connection";
}


?>
