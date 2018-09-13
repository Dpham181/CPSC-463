<?php

require_once('../HOST/configAD.php');
require_once('../LOGIN_SYSTEM/secure_data.php');
$title = secure($_POST["title"]);
$sql = "INSERT INTO ITEMS SET
        ITEMS.TITLE =?
 ";

$stmt = $link->prepare($sql);
$stmt->bind_param("s", $title);
if ($stmt->execute()){
$stmt->close();
$link->close();
header("location:admin_page.php");

}

?>
