<!-- 
  This file is used to make changes to sub items.
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

  $id = null;

  if (isset($_GET['id'])){
    $id= $_GET['id'];
  }

  $sub_item_name = null;

  $sql2 = "SELECT SUB_ITEMS.NAME
           FROM SUB_ITEMS
           WHERE SUB_ITEMS.SI_NUM='3'";
  $stmt2=$link->prepare($sql2);
  $stmt2->execute();
  $stmt2->store_result();
  $stmt2->bind_result($sub_item_name);

?>
<!-- End of loading the database -->

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>ADMIN UPDATE SUBITEMS</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <!-- Latest compiled and minified CSS -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <!-- Pasted here -->
  <link rel="icon" href="../../../../favicon.ico">

  <!-- Custom styles for this template -->
  
  <!-- <link href="../css/home.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="../CSS/a.css">
  <link rel="stylesheet" href="../CSS/admin.css">

  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
        </ul> <!-- End of menu dropdown -->
    </div> <!-- End of class dropdown -->
  </div> <!-- End of flex-container -->

</header> <!-- End of header field -->

<!-- <body class="text-center"> -->
  <body>
    <main role="main" class="inner cover"><br />
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <h1 class="cover-heading">
            <?php 
              if (isset($_GET['id'])){
                $id= $_GET['id'];
              }
            
              $sub_item_name = null;
              $sub_item_brand = null;
            
              $sql2 = "SELECT SUB_ITEMS.NAME, SUB_ITEMS.BRAND
                      FROM SUB_ITEMS
                      WHERE SUB_ITEMS.SI_NUM=$id";
              $stmt2=$link->prepare($sql2);
              $stmt2->execute();
              $stmt2->store_result();
              $stmt2->bind_result($sub_item_name, $sub_item_brand);
              $stmt2->fetch();

              echo "Update Subitem: $sub_item_brand - $sub_item_name"; 
              $stmt->free_result();
              $stmt->close();
            ?>
          </h1>
        </div>
      </div>
    </main>
    <footer class="mastfoot mt-auto">
      <div class="inner">
        <p>&copy; CPSC 463 WEBSITE .</p>
      </div>
    </footer>
  </div>

  <!-- Container for the form -->
  <div class="container">
    <form class="form form-signup" role="form" action="process_update.php" method="POST">
      <input type="hidden" name="Item_id" value="<?php echo $id; ?>">
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
              <input type="Text" name="NAME" class="form-control" placeholder="NAME" />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                <input type="Text" name="BRAND" class="form-control" placeholder="BRAND" />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                <input type="Text" name="PRICE" class="form-control" placeholder="PRICE" />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
              <input type="Text" name="STATUS" class="form-control" placeholder="STATUS" />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
              <input type="Text" name="QUANITY" class="form-control" placeholder="QUANITY" />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-2">
          <button type="submit" class="btn btn-sm btn-primary btn-block" role="button">Update</button>
        </div>
        <div class="col-2">
          <form action="admin_page.php">
            <button type="submit" class="btn btn-sm btn-warning btn-block" role="button">Back</button>
          </form>
        </div>
      </div>
    </form>
  </div>
  <!-- End of form container -->


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


</body>
<!--
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
</html>
