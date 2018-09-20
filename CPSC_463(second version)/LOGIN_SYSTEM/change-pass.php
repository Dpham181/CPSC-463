<?php




require_once('../HOST/configAD.php');
if (isset($_GET['email'])){
  $email= $_GET['email'];

  }
$sql = " UPDATE USERS_ACCCOUNT  SET

          USERS_ACCCOUNT.HASH_PASS = ?
                            ";

$stmt=$link->prepage($sql);

$stmt->bind_param("s", )








 ?>
