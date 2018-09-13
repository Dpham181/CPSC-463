<?php

require_once('../HOST/configAD.php');
require_once('../LOGIN_SYSTEM/secure_data.php');

$sql =" SELECT  ORDERING.ORDER_ID,
                 ORDERING.CORDER_ID,
                  ORDERING.PAYMENT_STATUS
        FROM ORDERING
";

$stmt =$link->prepare($sql);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($order_id, $customer_id, $payment_status);

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  </head>
  <body>
    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">CUSTOMER ID</th>
          <th scope="col">PAYMENT STATUS</th>
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

      echo "</tr>";
      }
        ?>

      </tbody>
    </table>

  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
