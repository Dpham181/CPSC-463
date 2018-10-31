<?php
require_once('../HOST/configRE.php');
require_once('../LOGIN_SYSTEM/secure_data.php');
session_start();
if ($_SESSION['type'] !== 'R') {
 $_SESSION = array();
 session_destroy();
 header("location: home.html");
 exit;
}
$session_role = " Regular User ";

if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
 header("location: home.html");
 exit;
}
if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
 header("location: home.html");
 exit;
}



 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Regular Site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Latest compiled and minified CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="../css/u.css" rel="stylesheet">

  </head>

  <header>

      <a href="../home.html"><img src="../img/logo.png" width="10%" height="90%"></a>
    
      <div class="flex-container">
        <span class="fa-stack fa-lg">
        <span class="fa fa-circle fa-stack-2x "></span>
        <a href="#" onclick="openCart()" data-toggle="modal" data-target="#cart-modal"><span class="fas fa-shopping-cart fa-stack-1x"></span></a>
        <span class="fa cart-number fa-stack-1x"><p id="cart-number">0</p></span>
        </span>

        <a href="#"><button class="btn btn-info btn-sm" type="button">Home</button></a>
        <a href="purchase_history.php">
          <button class="btn btn-default btn-sm" type="button">Purchase History</button>
        </a>
        <a href="shared_items.php">
          <button class="btn btn-success btn-sm" type="button">Shared Orders</button>
        </a>

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown"><span class='glyphicon glyphicon-user' aria-hidden='true'></span> <?php echo $_SESSION['email'] . " ($session_role)"; ?>
            <ul class="dropdown-menu">
                <li><a href="../LOGIN_SYSTEM/logout.php"><span class='glyphicon-log-out' aria-hidden='true'></span>Logout</a></li>
                <li><a href="#changepass" data-toggle="modal"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Change Password</a></li>
                <li><a href="#profile" data-toggle="modal"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Update Profile</a></li>
            </ul>
          </div>
        </div>

  </header> 


   <body>
     <!-- displaying items to the regular user -->
     <?php include 'regular_display.php'; ?>

     <!-- Modal for shopping cart -->
     <div class="modal fade" id="cart-modal" tabindex="-1" role="dialog" aria-hidden="true">
       <div class='modal-dialog' role='document'>
        <div class='modal-content'>
        <div class='modal-header'>
            <h5 class='modal-title'>Cart</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        <div class='modal-body'>
          <p>Your cart is empty...</p>
        </div>
        <div class="totalAmount text-center"><p>Total: $<span id="totalAmountValue">0</span></p></div>
        <div class='modal-footer'>
            <button type='button'  name="purchase" class='btn btn-primary' onclick="purchaseReceipt()">Purchase Items</button>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        </div>
        </div>
    </div>
    </div>
    </div>
    <?php
        # query purchase data here
    ?>
     <!-- ________________________________________________________Start of Password change form -->
     <?php
     $NEWPASS="";
     $oldpassword="";
     $oldpassword_err="";
     $password_err="";
     $confirm_password_err="";
     if (isset($_POST["changepass"])){
     $email = $_SESSION['email'];

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
       $confirmpass= secure($_POST['confirm_password']) ;

       if ( $NEWPASS != $confirmpass){
         echo "<script>window.alert('Password Not Match!');</script>";



       }else{

       $sql = " UPDATE USERS_ACCCOUNT  SET

               USERS_ACCCOUNT.HASH_PASS = ?

               WHERE USERS_ACCCOUNT.EMAIL = '$email'

                                 ";

     $stmt = $link->prepare($sql);
     $NEWPASS=PASSWORD_HASH($NEWPASS,PASSWORD_DEFAULT);
     $stmt->bind_param('s', $NEWPASS);
     if ($stmt->execute()){
       $stmt->close();

     }
     else {echo "ERROR";}
     }
     }
     else {
       echo "<script>window.alert('Invalid Password');</script>";



     }
     }
     }


      ?>
     <div id="changepass" class="modal fade" role="dialog">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Change PassWord</h4>
                 </div>
                 <div class="modal-body">
                     <form method="post" class="form-horizontal" role="form">
                       <div class="input-group">

                       <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                         <input type="password" name="oldpassword" class="form-control"  placeholder="old password" required>
                         </div>

                          <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                             <input type="password" name="newpass" class="form-control"  placeholder="New password" required>
                           </div>

                        <div class="input-group">

                        <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                      <input type="password" name="confirm_password" class="form-control"  placeholder="confirmed password" required>
                        </div>


                 <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" name="changepass"><span class="glyphicon glyphicon-Edit"></span> Change</button>
                     <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                 </div>
             </div>
             </form>
         </div>
     </div>
     </div>

<!-- ________________________________________________________End of Password change form _____________________________________________________-->


<!-- ________________________________________________________Start of profile change form_____________________________________________________ -->


<?php
$id = $_SESSION['id'];
$sql = " SELECT
          PROFILE.FIRST_NAME,
          PROFILE.LAST_NAME,
          PROFILE.COUNTRY,
          PROFILE.ZIPCODE,
          PROFILE.CITY,
          PROFILE.STREET,
          PROFILE.STATE
          FROM PROFILE
          WHERE PROFILE.AUSER_ID = ?
";
$stmt = $link->prepare($sql);
$stmt ->bind_param("i", $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt -> bind_result(
$firstname,
$lastname,
$country,
$zipcode,
$city,
$street,
$state
);
$stmt->fetch();
$stmt->close();
if (isset($_POST["editprofile"])){

  $firstname = secure($_POST["FIRST_NAME"]);
  $lastname = secure($_POST["LAST_NAME"]);
  $street = secure($_POST["street"]);
  $zipcode = secure($_POST["zipcode"]);
  $state = secure($_POST["state"]);
  $city  = secure($_POST["city"]);
  $country = secure($_POST["country"]);
$sql = " UPDATE PROFILE SET
          PROFILE.FIRST_NAME =? ,
          PROFILE.LAST_NAME =? ,
          PROFILE.COUNTRY =? ,
          PROFILE.ZIPCODE =? ,
          PROFILE.CITY =? ,
          PROFILE.STREET =? ,
          PROFILE.STATE =?
          WHERE PROFILE.AUSER_ID ='$id'


";
$stmt = $link->prepare($sql);
$stmt -> bind_param("sssisss",
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

}

 ?>

<div id="profile" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">


  <div class="container">
    <h1>Edit Profile</h1>
  	<hr>
	<div class="row">


      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a>
          <i class="fa fa-coffee"></i>
          This is an <strong>.alert</strong>. Use this to show important messages to the user.
        </div>
        <h3>Personal info</h3>

        <form method="post" class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" name="FIRST_NAME" type="text" value="<?php echo $firstname ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control"  name="LAST_NAME" type="text" value="<?php echo $lastname ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Street:</label>
            <div class="col-lg-8">
              <input class="form-control" name="street" type="text" value="<?php echo $street ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">City:</label>
            <div class="col-lg-8">
              <input class="form-control" name ="city"  type="text" value="<?php echo $city ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">State:</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select  name="state" class="form-control">
                  <option selected><?php echo $state ?></option>
                  <option>CA</option>
                  <option>WA</option>
                  <option>OR</option>
                  <option>TX</option>
                  <option>NONE</option>

                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Country:</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select  name="country" class="form-control">
                  <option selected><?php echo $country ?></option>
            <option >Bolivia, Plurinational State of</option>
          	<option >Bonaire, Sint Eustatius and Saba</option>
          	<option >Bosnia and Herzegovina</option>
          	<option >Botswana</option>
          	<option >Bouvet Island</option>
          	<option >Brazil</option>
          	<option >British Indian Ocean Territory</option>
          	<option >Brunei Darussalam</option>
          	<option >Bulgaria</option>
          	<option >Burkina Faso</option>
          	<option >Burundi</option>
          	<option >Cambodia</option>
          	<option >Cameroon</option>
          	<option >Canada</option>
          	<option >Cape Verde</option>
          	<option >Cayman Islands</option>
          	<option >Central African Republic</option>
          	<option >Chad</option>
            <option >United States</option>

                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">ZipCode:</label>
            <div class="col-md-8">
              <input type="text" name ="zipcode" value="<?php echo $zipcode ?>" class="form-control" id="inputZip">
            </div>
          </div>



      </div>
  </div>
</div>
<hr>
          <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="editprofile"><span class="glyphicon glyphicon-plus"></span> Change</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
            </div>
        </div>
        </form>
    </div>
</div>
</div>



<!-- ________________________________________________________End of profile change form_____________________________________________________ -->




  </body>

  <footer>
    <p>&copy; CPSC 463 WEBSITE .</p>

  </footer>
  <script src="../js/cart.js"></script>
</html>
