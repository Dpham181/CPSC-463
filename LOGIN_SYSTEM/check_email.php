<?php
require_once ('../HOST/configAD.php');
require_once 'secure_data.php';

if(!empty($_POST["email"])){
$email = secure($_POST["email"]);
$sql = "SELECT USERS_ACCCOUNT.ACC_NUM FROM USERS_ACCCOUNT
          WHERE  USERS_ACCCOUNT.EMAIL =?";
$stmt = $link->prepare($sql);
$stmt ->bind_param("s", $email );
$stmt ->execute();
if($stmt->fetch() == 1){
  echo "<span style=color:Red> Email Already In Use.</span>";
}
else{
echo "<span style=color:Green> Email Ready To Use.</span>";

    }


}




 ?>
