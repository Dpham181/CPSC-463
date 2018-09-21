<?php

function secure($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = preg_replace("/\t|\R/",' ',$data);
  return $data;
}

?>
