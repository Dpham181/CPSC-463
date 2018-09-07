<?php


define('DB_SERVER', 'localhost');
define('DB_NAME', 'STORE_SITE');
$checkdb=array
  (
  array("A","admin",'admin123'),
  array("R","regular",'regular123')
  );
if($_SESSION['type'] === $checkdb[0][0]){
  define('DB_USERNAME', $checkdb[0][1]);
  define('DB_PASSWORD', $checkdb[0][2]);
}
elseif($_SESSION['type'] === $checkdb[1][0]){
  define('DB_USERNAME', $checkdb[1][1]);
  define('DB_PASSWORD', $checkdb[1][2]);
}

?>
