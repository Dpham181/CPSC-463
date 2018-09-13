<?php

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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update_item</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  </head>
  <body>

    <div id="fullscreen_bg" class="fullscreen_bg" />
    <form class="form-signin"  action="update_item.php" method="POST"  >
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <h3 class="text-center">
                          Chosing Category</h3>
                <form class="form form-signup" role="form" action="add_title.php" method="POST">

                  <div class="form-group">
                    <div class="input-group">

                      <select  name="Item_id" required>
                                    <option value="" selected disabled hidden>Choose Category </option>
                                  <?php
                                    while( $stmt->fetch() )
                                    {
                                      echo "<option value=\"$item_num\">".$title."</option>\n";
                                    }
                                    $stmt->data_seek(0);
                                    $stmt->close();
                                    $link->close();
                                  ?>

                        </select>

                    </div>
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary btn-block" role="button"> Processing</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

  </body>
</html>
