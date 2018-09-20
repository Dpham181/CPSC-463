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
  <title>ADMIN ADDING SUBITEMS</title>
</head>

<body>
  <div id="fullscreen_bg" class="fullscreen_bg" />
  <form class="form-signin" action="add_sub.php" method="POST" >
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-body">
              <h3 class="text-center">
                        Adding Item</h3>
              <form class="form form-signup" role="form" action="add_sub.php" method="POST">

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span>


                    <select  name="Item_id" required>
                                  <option value="" selected disabled hidden>Choose Category </option>
                                <?php
                                  while( $stmt->fetch() )
                                  {
                                    echo "<option value=\"$item_num\">".$title."</option>\n";
                                  }
                                  $stmt->free_result();
                                  $stmt->close();
                                  $link->close();
                                ?>

                      </select>
                    </span>

                     </div>


                     <div class="form-group">
                       <div class="input-group">
                         <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                         <input type="Text" name="NAME" class="form-control" placeholder="NAME" />
                       </div>
                     </div>


                     <div class="form-group">
                       <div class="input-group">
                         <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                         <input type="Text" name="BRAND" class="form-control" placeholder="BRAND" />
                       </div>
                     </div>


                     <div class="form-group">
                       <div class="input-group">
                         <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                         <input type="Text" name="PRICE" class="form-control" placeholder="PRICE" />
                       </div>
                     </div>


                     <div class="form-group">
                       <div class="input-group">
                         <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                         <input type="Text" name="STATUS" class="form-control" placeholder="STATUS" />
                       </div>
                     </div>

                     <div class="form-group">
                       <div class="input-group">
                         <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                         <input type="Text" name="QUANITY" class="form-control" placeholder="QUANITY" />
                       </div>
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
