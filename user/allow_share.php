<?php

require_once('../HOST/configAD.php');
if (isset($_GET['id'])){
  $id= $_GET['id'];
  }

  // Need to update the items from where the items are deleted
  $sql = "UPDATE INVOICE 
          SET SHARING=TRUE
          WHERE INVOICE_ID = ?";
  $stmt=$link->prepare($sql);
  $stmt->bind_param("i", $id);
  if($stmt->execute()){
      $stmt->close();
      header("location: purchase_history.php");
      exit;
  }



 ?>
