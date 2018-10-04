<?php
require_once 'secure_data.php';
require_once ('../HOST/configAD.php');
$email = $pass = $firstname = $lastname =$street = $street2 = $zipcode = $state = $city = null;

$email = secure($_POST["email"]);
$pass =   secure($_POST["password"]);
$firstname = secure($_POST["FIRST_NAME"]);
$lastname = secure($_POST["LAST_NAME"]);
$street = secure($_POST["street"]);
$zipcode = secure($_POST["zipcode"]);
$state = secure($_POST["state"]);
$city  = secure($_POST["city"]);
$country = secure($_POST["country"]);

// checking email if exit or not
$sql = "SELECT USERS_ACCCOUNT.ACC_NUM FROM USERS_ACCCOUNT
          WHERE  USERS_ACCCOUNT.EMAIL =?";
$stmt = $link->prepare($sql);
$stmt ->bind_param("s", $email );
$stmt ->execute();
if($stmt->fetch()==1 ){

  header("location:register_page.html");
}
else
{
// register to user account
$sql= " INSERT INTO USERS_ACCCOUNT SET
        USERS_ACCCOUNT.EMAIL =?,
        USERS_ACCCOUNT.HASH_PASS =?
      " ;

$stmt = $link->prepare($sql);
$hash_pass = PASSWORD_HASH($pass, PASSWORD_DEFAULT);
$stmt ->bind_param("ss", $email , $hash_pass );
$stmt ->execute();
$stmt->close();
 // close first sql
// GET THE USER ID FOR PROFILE 1-1 RELATIONSHIP
$sql= " SELECT USERS_ACCCOUNT.ACC_NUM FROM USERS_ACCCOUNT WHERE
        USERS_ACCCOUNT.EMAIL =?";
$stmt = $link->prepare($sql);

$stmt ->bind_param("s", $email);
$stmt ->execute();
$stmt->store_result();
$stmt->bind_result($pid);
$stmt->fetch();
$stmt->free_result();
$stmt->close();

// INSERT INTO CUSTOMER table
$sql= "INSERT INTO CUSTOMER SET
        CUSTOMER.R_ID = ?";
$stmt = $link->prepare($sql);

$stmt ->bind_param("s", $pid);
$stmt ->execute();

$stmt->close();
// register to profile implement here doing later
$sql = " INSERT INTO PROFILE SET
          PROFILE.AUSER_ID =? ,
          PROFILE.FIRST_NAME =? ,
          PROFILE.LAST_NAME =? ,
          PROFILE.COUNTRY =? ,
          PROFILE.ZIPCODE =? ,
          PROFILE.CITY =? ,
          PROFILE.STREET =? ,
          PROFILE.STATE =?



";
$stmt = $link->prepare($sql);
$stmt -> bind_param("isssssss",
$pid,
$firstname,
$lastname,
$country,
$zipcode,
$city,
$street,
$state
);
$stmt->execute();
$stmt->close();
$link->close();
header("location:login_page.php");

}


?>
