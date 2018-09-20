
<?php

session_start();
if ($_SESSION['type'] !== 'A') {
 $_SESSION = array();
 session_destroy();
 header("location: ../LOGIN_SYSTEM/home.html");
 exit;
}
else {
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
        FROM ITEMS
            ";
$stmt=$link->prepare($sql);
$stmt -> execute();
$stmt->store_result();
$stmt->bind_result($item_num,$title);


?>
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


</head>
<link href="../css/a.css" rel="stylesheet">

<header>

    <h1> Coffee Management </h1>
    <img src="../img/logo.png" width="10%" height="60%">

    <div   class="flex-container">


        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown"><span class='glyphicon glyphicon-user' aria-hidden='true'></span> <?php echo $_SESSION['email'] . " ($session_role)"; ?>
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="../LOGIN_SYSTEM/logout.php"><span class='glyphicon-log-out' aria-hidden='true'></span>Logout</a></li>
                <li><a href='../LOGIN_SYSTEM/change-pass.php?email=<?php echo $_SESSION['email'] ?>'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span>Change Password</a></li>

            </ul>
            <a href="#add" data-toggle="modal"><button type='button' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Item</button></a>
            <a href="#vieworder" data-toggle="modal"><button type='button' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span> View Ordering</button></a>
            <a href="add_subitem.php"><button type='button' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-upload' aria-hidden='true'></span> Adding subitems </button></a>
          </div>
  </div>

</header>
<body>

<table class="table table-hover table-dark">


  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NAME</th>
      <th scope="col">BRAND</th>
      <th scope="col">PRICE</th>
      <th scope="col">STATUS</th>
      <th scope="col">QUANITY</th>
      <th scope="col">ACTION</th>

    </tr>
  </thead>
  <tbody>
    <?php
      $sql = "SELECT *
              FROM SUB_ITEMS
              ORDER BY SUB_ITEMS.ISI_NUM
                  ";
      $stmt1=$link->prepare($sql);
      $stmt1-> execute();
      $stmt1->store_result();
      $stmt1->bind_result(
                                   $SI_NUM,
                                   $ISI_NUM,
                                     $BRAND,
                                    $PRICE,
                                    $NAME,
                                    $STATUS,
                                    $QUANITY );



      $NONE= "Empty";
      if ($stmt1->num_rows == 0){
        echo "<tr>";
        echo "<th scope=\"row\">".""."</th>\n";
        echo "<td>".$NONE."</td>\n";
        echo "<td>".$NONE."</td>\n";
        echo "<td>".$NONE."</td>\n";
        echo "<td>".$NONE."</td>\n";
        echo "<td>".$NONE."</td>\n";
      }else{
      while($stmt1->fetch())
      {
      echo "<tr>";
      echo "<th scope=\"row\">".$SI_NUM."</th>\n";
      echo "<td>".$NAME."</td>\n";
      echo "<td>".$BRAND."</td>\n";
      echo "<td>".$PRICE."</td>\n";
      echo "<td>".$STATUS."</td>\n";
      echo "<td>".$QUANITY."</td>\n";
      echo "<td>";
      echo "<a href='choose_remove.php?id=" . $SI_NUM . "'><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></a> ";
      echo "<a href='update_item.php?id=" . $SI_NUM . "'> <button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button </a> ";
      echo "</td>\n";
    }
}
    $stmt1->data_seek(0);
    $stmt1->close();
?>


              </tbody>
            </table>

<!-- ADDING TITLE-->


    <div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Title</h4>
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
                    <button type="submit" class="btn btn-primary" name="add_title"><span class="glyphicon glyphicon-plus"></span> Add</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                </div>
            </div>
            </form>
        </div>
    </div>
  </div>



  <?php
  if (isset($_POST["add_title"])){
  $title = secure($_POST["item_name"]);
  $sql2 = "INSERT INTO ITEMS SET
          ITEMS.TITLE =?
   ";

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

                    FROM ORDERING
            ";

            $stmt =$link->prepare($sql);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($order_id, $customer_id, $payment_status , $date);

             ?>

            <div class="modal fade" id="vieworder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Orders</h4>
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
  <!-- update items -->


</body>
<footer>
  <p>&copy; CPSC 463 WEBSITE .<br />

</footer>
</html>
