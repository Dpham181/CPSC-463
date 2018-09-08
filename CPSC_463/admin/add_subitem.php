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
$stmt->bind_result($item_num,$titile);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>ADMIN ADDING SUBITEMS</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
  <div id="fullscreen_bg" class="fullscreen_bg" />
  <form class="form-signin" action="add_subitem.php" method="POST" >
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-body">
              <h3 class="text-center">
                        Adding Sub Item Title</h3>
              <form class="form form-signup" role="form" action="add_title.php" method="POST">

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                    <select name="Item_id" required>
                                  <option value="" selected disabled hidden>Choose category </option>
                                <?php
                                  while( $stmt->fetch() )
                                  {
                                    echo "<option value=\"$item_num\">".$titile."</option>\n";
                                  }
                                  $stmt->free_result();
                                  $stmt->close();
                                  $link->close();
                                ?>

                      </select>
                     </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary btn-block" role="button"> Add Item</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

</body>

</html>
