<?php

require_once('../HOST/configAD.php');
require_once('../LOGIN_SYSTEM/secure_data.php');


$Item_id = (int) secure($_POST["Item_id"]);
$BRAND = secure($_POST["BRAND"]);
$PRICE= (int) secure($_POST["PRICE"]);
$NAME = secure($_POST["NAME"]);
$STATUS= secure($_POST["STATUS"]);
$QUANITY = (int) secure($_POST["QUANITY"]);

$sql = "SELECT
       SUB_ITEMS.ISI_NUM,
       SUB_ITEMS.BRAND,
        SUB_ITEMS.PRICE,
        SUB_ITEMS.NAME,
        SUB_ITEMS.STATUS,
        SUB_ITEMS.QUANITY

        FROM SUB_ITEMS
        WHERE SUB_ITEMS.SI_NUM = '$Item_id'

            ";
$stmt=$link->prepare($sql);
$stmt -> execute();
$stmt->store_result();
$stmt->bind_result(
                             $ISI_NUM,
                               $BRANDt,
                              $PRICEt,
                              $NAMEt,
                              $STATUSt,
                              $QUANITYt );


$stmt->fetch();

if (empty ($_POST["Item_id"])) $Item_id = 0;
if (empty ($_POST["BRAND"])) $BRAND = $BRANDt;
if (empty ($_POST["PRICE"])) $PRICE = $PRICEt;
if (empty ($_POST["NAME"])) $NAME = $NAMEt;
if (empty ($_POST["STATUS"])) $STATUS = $STATUSt;
if (empty ($_POST["QUANITY"])) $QUANITY = $QUANITYt;

$stmt->close();


$sql = "UPDATE SUB_ITEMS SET
        SUB_ITEMS.BRAND =?,
        SUB_ITEMS.PRICE =?,
        SUB_ITEMS.NAME =?,
        SUB_ITEMS.STATUS =?,
        SUB_ITEMS.QUANITY =?
WHERE   SUB_ITEMS.SI_NUM = '$Item_id'


 ";

$stmt = $link->prepare($sql);
$stmt->bind_param("sissi",
                              $BRAND,
                              $PRICE,
                              $NAME,
                              $STATUS,
                              $QUANITY );
if ($stmt->execute()){
$stmt->close();
$link->close();
header("location: admin_page.php");
}







 ?>
