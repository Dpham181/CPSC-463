<?php

require_once('../HOST/configAD.php');
require_once('../LOGIN_SYSTEM/secure_data.php');
if (!empty ($_POST["Item_id"] &&
              $_POST["BRAND"] &&
              $_POST["PRICE"] &&
              $_POST["NAME"] &&
              $_POST["STATUS"] &&
              $_POST["QUANITY"])
    ){


$Item_id = secure($_POST["Item_id"]);
$BRAND = secure($_POST["BRAND"]);
$PRICE= secure($_POST["PRICE"]);
$NAME = secure($_POST["NAME"]);
$STATUS= secure($_POST["STATUS"]);
$QUANITY = secure($_POST["QUANITY"]);

$sql = "INSERT INTO SUB_ITEMS SET
        SUB_ITEMS.ISI_NUM =?,
        SUB_ITEMS.BRAND =?,
        SUB_ITEMS.PRICE =?,
        SUB_ITEMS.NAME =?,
        SUB_ITEMS.STATUS =?,
        SUB_ITEMS.QUANITY =?


 ";

$stmt = $link->prepare($sql);
$stmt->bind_param("isissi",   $Item_id,
                              $BRAND,
                              $PRICE,
                              $NAME,
                              $STATUS,
                              $QUANITY );
if ($stmt->execute()){
$stmt->close();
$link->close();
header("location:admin_page.php");

}

}


?>
