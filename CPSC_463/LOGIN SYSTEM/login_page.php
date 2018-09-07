<?php

require_once 'secure_data.php';
require_once ('../HOST/configHT.php');

$email = $password = "";
$email_err = $password_err = "";

if( empty($email) ) $email = null;
if( empty($password)  ) $password  = null;
if($_SERVER["REQUEST_METHOD"]== "POST"){

  if(empty(trim(preg_replace("/\t|\R/",' ',$_POST['email'])))){
          $email_err = 'Please enter email.';
      } else{
        $email = secure($_POST["email"]);
      }
      // Check if password is empty
  if(empty(trim(preg_replace("/\t|\R/",' ',$_POST['password'])))){
          $password_err = 'Please enter your password.';
      } else{
        $password =secure($_POST["password"]);
      }

if ( empty($email)){
    $email_err= 'Please enter your email here.';
}else {
    $email = $email;
}
// password check
if ( empty($password)){
    $password_err= 'Please enter your password here.';
}else {
    $password = $password;
}

if(empty($email_err) &&empty($password_err) ){

$sql = "SELECT
        USERS_ACCCOUNT.ACC_NUM,
        USERS_ACCCOUNT.HASH_PASS,
        USERS_ACCCOUNT.ACC_TYPE
        FROM USERS_ACCCOUNT
        WHERE USERS_ACCCOUNT.EMAIL = ? ";
 $stmt = $link->prepare($sql);
 $stmt ->bind_param("s", $email);
 $stmt ->execute();
 $stmt->store_result();
 $stmt->bind_result(
   $dbacc,
   $dbhasdpass,
   $dbtype
   );
 if($stmt->fetch() == 1){

  if(password_verify($password,$dbhasdpass)){
    $stmt->close();
    $link->close();
      session_start();
      $_SESSION['email'] = $email;
      $_SESSION['id'] = $dbacc;
      $_SESSION['type'] = $dbtype;
    if($dbtype == 'A' ){


      header("location:../admin/admin_page.html");
    }
    else if($dbtype == 'R'){

      header("location:../user/regular_page.html");
    }
  }
  else {
    $password_err = "\n The password Incorrect ):";

  }
 }
}
}
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <!-- Required meta tags -->
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

         <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <link href="../CSS/signin.css" rel="stylesheet">


     <title>COFFEE SHOP</title>


   </head>
   <body>


       <body class="text-center">
         <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
           <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
           <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
           <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
              <label for="inputEmail" class="sr-only">Email address</label>
              <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
              <span class="help-block"><?php echo $email_err; ?></span>
          </div>
          <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

           <label for="inputPassword" class="sr-only">Password</label>
           <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
           <span class="help-block" style="color:red"><?php echo $password_err; ?></span>

         </div>
           <div class="checkbox mb-3">
             <label>
               <input type="checkbox" value="remember-me"> Remember me
             </label>
           </div>
           <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
           <button type="reset" class="btn btn-lg btn-primary btn-block" >Reset</button>

           <p>Don't have an account? <a href="register_page.html">Sign up now</a>.</p>
           <a href="forgot_pass.html">Forgot password?</a>
       </body>
   </body>


 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </html>
