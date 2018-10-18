<!-- 
  This page is the sharing page of the admin panel.

  The update profile needs to update the database before admins can view the users for sharing.
    - The profile updates only if there is something in the database. I created a new user and it loads.
    - However, if the profile gets deleted, it will not create another row in the database.
-->


<!-- PHP Code to load the database -->
<?php

  session_start();
  
  if ($_SESSION['type'] !== 'A') {
    $_SESSION = array();
    session_destroy();
    header("location: ../LOGIN_SYSTEM/home.html");
    exit;
  } else {
    $session_role = " Admin ";
  }

  if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header("location: ../LOGIN_SYSTEM/home.html");
    exit;
  }

  if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
    header("location: ../LOGIN_SYSTEM/home.html");
    exit;
  }

  require_once('../HOST/configAD.php');
  require_once('../LOGIN_SYSTEM/secure_data.php');

  $item_num = $title = null;

  $sql = "SELECT
          ITEMS.ITEM_NUM,
          ITEMS.TITLE
          FROM ITEMS";

  $stmt=$link->prepare($sql);
  $stmt -> execute();
  $stmt->store_result();
  $stmt->bind_result($item_num,$title);

?>
<!-- End of loading the database -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADMIN PAGE</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Latest compiled and minified CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="../css/a.css" rel="stylesheet">

</head>


<!-- Header field -->
<header>

    <h1> Coffee Management </h1>
    <img src="../img/logo.png" width="10%" height="60%">

    <div class="flex-container">
        <div class="dropdown">
            <!-- Menu dropdown -->
            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">
              <span class='glyphicon glyphicon-user' aria-hidden='true'></span> 
              <?php echo $_SESSION['email'] . " ($session_role)"; ?>
              <span class="caret"></span>
            </button>
            <!-- Menu dropdown for email -->
            <ul class="dropdown-menu">
                <li>
                  <a href="../LOGIN_SYSTEM/logout.php">
                    <span class='glyphicon-log-out' aria-hidden='true'></span>Logout
                  </a>
                </li>
                <li>
                  <a href="#changepass" data-toggle="modal">
                    <span class='glyphicon glyphicon-edit' aria-hidden='true'></span>Change Password
                  </a>
                </li>
            </ul>
            <!-- End of menu dropdown -->

            <!-- Other buttons on the top bar -->
            <a href="admin_page.php">
              <button type="button" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>Dashboard</button>
            </a>
            <a href="#">
              <button type="button" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>Sharing</button>
            </a>
            <a href="#add" data-toggle="modal">
              <button type='button' class='btn btn-success btn-sm'>
                <span class='glyphicon glyphicon-plus' aria-hidden='true'></span>Item
              </button>
            </a>
            <a href="#vieworder" data-toggle="modal">
              <button type='button' class='btn btn-success btn-sm'>
                <span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>View Ordering
              </button>
            </a>
            <a href="#addsub" data-toggle="modal">
              <button type='button' class='btn btn-success btn-sm'>
                <span class='glyphicon glyphicon-plus' aria-hidden='true'></span>Adding subitems
              </button>
            </a>
            <!-- End of other buttons -->
        </div>
        <!-- End of class dropdown -->
  </div>

</header>
<!-- End of header field -->

<body>

<!-- This will produce a dark table -->
<table class="table table-hover table-dark">

  <!-- Table header -->
  <thead>
    <tr>
      <th scope="col">SELECT</th>
      <th scope="col">ID</th>
      <th scope="col">FIRST NAME</th>
      <th scope="col">LAST NAME</th>
      <th scope="col">ITEM NAME</th>
      <th scope="col">BRAND</th>
      <th scope="col">DESCRIPTION</th>
      <th scope="col">REVIEWS</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <!-- End of table header -->

  <!-- Table body -->
  <!-- This needs to be changed for the sharing page -->
  <!-- This is not working, because when you update your profile, the database doesn't get updated -->
  <tbody>
    <?php
        $sql = "SELECT
                PROFILE.PROFILE_ID,
                PROFILE.FIRST_NAME,
                PROFILE.LAST_NAME
                FROM PROFILE";

        $stmt1=$link->prepare($sql);
        $stmt1-> execute();
        $stmt1->store_result();
        $stmt1->bind_result(
                              $PROFILE_ID,
                              $FIRST_NAME,
                              $LAST_NAME
                           );

        $NONE= "Empty";

        if ($stmt1->num_rows == 0){
          echo "<tr>";
          echo "<td>".$NONE."</td>\n";
          echo "<td>".$NONE."</td>\n";
          echo "<td>".$NONE."</td>\n";
          echo "<td>".$NONE."</td>\n";
          echo "<td>".$NONE."</td>\n";
          echo "<td>".$NONE."</td>\n";
          echo "<td>".$NONE."</td>\n";
        } else {
          while($stmt1->fetch())
          {
            echo "<tr>";
            echo "<td>
                  <a href='#'>
                    <input class='form-check-input' type='checkbox' style='text-align: center; vertical-align: middle;'></input>
                    <!--<button type='button' class='btn btn-light btn-sm'>
                      <span class='glyphicon glyphicon-unchecked' aria-hidden='true'></span>
                    </button>-->
                  </a> 
                  </td>\n";
            echo "<td>".$PROFILE_ID."</td>\n";
            echo "<td>".$FIRST_NAME."</td>\n";
            echo "<td>".$LAST_NAME."</td>\n";
            echo "<td>"."</td>\n";
            echo "<td>"."</td>\n";
            echo "<td>"."</td>\n";
            echo "<td>"."</td>\n";
          }
        }

        $stmt1->data_seek(0);
        $stmt1->close();
    ?>

  </tbody>
  <!-- End of table body -->
</table>

<!-- Sharing -->
<!-- Want to have an option to select which users will be shared -->


<!-- Adding Title -->
<div id="add" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Title</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" class="form-horizontal" role="form">
          <div class="form-group">
            <label class="control-label col-sm-2" for="item_name">Item Name:</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Item Name" autofocus required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="add_title">
              <span class="glyphicon glyphicon-plus"></span>Add
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
              <span class="glyphicon glyphicon-remove-circle"></span>Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <!-- PHP segment for changing the password -->
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
        } else{
          $sql = " UPDATE USERS_ACCCOUNT  SET
                   USERS_ACCCOUNT.HASH_PASS = ?
                   WHERE USERS_ACCCOUNT.EMAIL = '$email' ";

          $stmt = $link->prepare($sql);
          $NEWPASS=PASSWORD_HASH($NEWPASS,PASSWORD_DEFAULT);
          $stmt->bind_param('s', $NEWPASS);
        
          if ($stmt->execute()){
            $stmt->close();
          } else {echo "ERROR";}
        }
      }

      else {
        echo "<script>window.alert('Invalid Password');</script>";
      }
    }
  }

  ?>
  <!-- End of PHP segment for changing the password -->


  <!-- When user clicks on change password -->
  <div id="changepass" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Password</h4>
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
              <button type="submit" class="btn btn-primary" name="changepass">
                <span class="glyphicon glyphicon-plus"></span>Change
              </button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">
                <span class="glyphicon glyphicon-remove-circle"></span>Cancel
              </button>
            </div>
        </div>
            </form>
      </div>
    </div>
  </div>
  <!-- End of user changing password -->


  <!-- Add items -->
  <div id="addsub" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Items</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" class="form-horizontal" role="form">
            <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span>
              <select  name="Item_id" required>
                <option value="" selected disabled hidden>Choose Category </option>
                <?php
                  $sql = "SELECT
                          ITEMS.ITEM_NUM,
                          ITEMS.TITLE
                          FROM ITEMS";

                  $stmt=$link->prepare($sql);
                  $stmt -> execute();
                  $stmt->store_result();
                  $stmt->bind_result($item_num,$title);
                  while( $stmt->fetch() )
                  {
                    echo "<option value=\"$item_num\">".$title."</option>\n";
                  }
                  $stmt->free_result();
                  $stmt->close();
                ?>
              </select>
            </span>
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
              <input type="Text" name="NAME" class="form-control" placeholder="NAME"  required />
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                  <input type="Text" name="BRAND" class="form-control" placeholder="BRAND" required />
                </div>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                    <input type="Text" name="PRICE" class="form-control" placeholder="PRICE"  required />
                </div>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                  <input type="Text" name="STATUS" class="form-control" placeholder="STATUS"  required />
                </div>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                  <input type="Text" name="QUANITY" class="form-control" placeholder="QUANITY"  required />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="add_sub">
                      <span class="glyphicon glyphicon-plus"></span>Add
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                      <span class="glyphicon glyphicon-remove-circle"></span>Cancel
                    </button>
                </div>
            </div> <!-- End div input-group -->
          </form>
        </div> <!-- End div modal-body -->
      </div> <!-- End div modal-content -->
    </div> <!-- End div modal-dialog -->
  </div> <!-- End div addsub -->
  <!-- End of add items -->

<?php

  if (isset($_POST["add_sub"])){
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
              SUB_ITEMS.QUANITY =?";

      $stmt = $link->prepare($sql);
      $stmt->bind_param("isissi",   $Item_id,
                                    $BRAND,
                                    $PRICE,
                                    $NAME,
                                    $STATUS,
                                    $QUANITY );
      if ($stmt->execute()){
        $stmt->close();
        echo("<meta http-equiv='refresh' content='1'>");
      }
    }
  }

  if (isset($_POST["add_title"])){
    $title = secure($_POST["item_name"]);
    $sql2 = "INSERT INTO ITEMS SET
             ITEMS.TITLE =?";

    $stmt2 = $link->prepare($sql2);
    $stmt2->bind_param("s", $title);
    $stmt2->execute();
    $stmt2->close();
    echo("<meta http-equiv='refresh' content='1'>");
  }

  ?>


  <!-- VIEW ORDER-->
  <?php

    $sql =" SELECT  ORDERING.ORDER_ID,
                    ORDERING.CORDER_ID,
                    ORDERING.PAYMENT_STATUS,
                    ORDERING.DATE_ORDER
            FROM ORDERING";

    $stmt =$link->prepare($sql);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($order_id, $customer_id, $payment_status , $date);

  ?>


  <div class="modal fade" id="vieworder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Orders</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-hover table-dark">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">CUSTOMER ID</th>
                <th scope="col">PAYMENT STATUS</th>
                <th scope="col">DATE ORDERING</th>
              </tr>
            </thead>
            <tbody>
              <?php
                while($stmt->fetch())
                {
                  echo "<tr>";
                  echo "<th scope=\"row\">".$order_id."</th>\n";
                  echo "<td>".$customer_id."</td>\n";
                  echo "<td>".$payment_status."</td>\n";
                  echo "<td>".$date."</td>\n";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>
<!-- End of view orders -->

</body>

<footer>
  <p>&copy; CPSC 463 WEBSITE .<br />

</footer>
</html>
