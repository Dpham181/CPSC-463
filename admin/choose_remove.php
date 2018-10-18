<?php




require_once('../HOST/configAD.php');
if (isset($_GET['id'])){
  $id= $_GET['id'];
  }

  // Need to update the items from where the items are deleted
  $sql = "DELETE FROM SUB_ITEMS WHERE SUB_ITEMS.SI_NUM = ? LIMIT 1";
  $stmt=$link->prepare($sql);
  $stmt->bind_param("i", $id);
  if($stmt->execute()){
      $stmt->close();
      header("location: admin_page.php");
      exit;
  }



 ?>
