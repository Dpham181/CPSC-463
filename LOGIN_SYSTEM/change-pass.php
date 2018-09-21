<?php
session_start();

if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
  header("location: ../LOGIN_SYSTEM/home.html");
 exit;
}

$email = $_SESSION['email'];
$NEWPASS="";
$oldpassword="";
$oldpassword_err="";
$password_err="";
$confirm_password_err="";
if($_SERVER["REQUEST_METHOD"]== "POST"){
  require_once('../HOST/configAD.php');
  require_once('../LOGIN_SYSTEM/secure_data.php');


if (!empty($_POST['oldpassword'])){
      $oldpassword = secure($_POST['oldpassword']) ;
      $sql= " SELECT USERS_ACCCOUNT.HASH_PASS
                FROM USERS_ACCCOUNT
                WHERE USERS_ACCCOUNT.EMAIL = ?";
      $stmt1 = $link->prepare($sql);
      $stmt1-> bind_param("s", $email);
      if($stmt1->execute()){
      $stmt1->store_result();
      $stmt1->bind_result($hashed_password);
            }
}
if ($stmt1->fetch() == 1){
if(password_verify($oldpassword,$hashed_password)){

  $NEWPASS= secure($_POST['newpass']) ;
  $sql = " UPDATE USERS_ACCCOUNT  SET

          USERS_ACCCOUNT.HASH_PASS = ?

          WHERE USERS_ACCCOUNT.EMAIL = '$email'

                            ";

$stmt = $link->prepare($sql);
$NEWPASS=PASSWORD_HASH($NEWPASS,PASSWORD_DEFAULT);
$stmt->bind_param('s', $NEWPASS);
if ($stmt->execute()){
  $link->close();


}
else {echo "ERROR";}
}
else {
  $oldpassword_err=" Your old password doesnt match with our record";


}
}
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CHANGE PASS FORM</title>

  </head>
  <body>
    <section>
      <div class="container">
<div class="row">
<div class="col-sm-4">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <label>Current Password</label>
    <div class="form-group pass_show">
      <input type="password" name="oldpassword" class="form-control"  placeholder="old password" required>
        <span class="help-block"><?php echo $oldpassword_err; ?></span>
      </div>
       <label>New Password</label>
        <div class="form-group pass_show">
          <input type="password" name="newpass" class="form-control"  placeholder="New password" required>
                <span class="help-block"><?php echo $password_err; ?></span>
        </div>
       <label>Confirm Password</label>
        <div class="form-group pass_show">
          <input type="password" name="confirm_password" class="form-control"  placeholder="confirmed password" required>
              <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
                <input id="submit" type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
      </div>
    </form>

</div>
</div>
</div>
    </section>
  </body>
</html>
