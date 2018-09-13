<?php
require_once('../HOST/configAD.php');
require_once('../LOGIN_SYSTEM/secure_data.php');

if (!empty($_POST["Item_id"]) ){
$Item_id = secure($_POST["Item_id"]);
  $sql = "SELECT
         SUB_ITEMS.ISI_NUM,
         SUB_ITEMS.BRAND,
          SUB_ITEMS.PRICE,
          SUB_ITEMS.NAME,
          SUB_ITEMS.STATUS,
          SUB_ITEMS.QUANITY

          FROM SUB_ITEMS
          WHERE SUB_ITEMS.ISI_NUM = '$Item_id'

              ";
  $stmt=$link->prepare($sql);
  $stmt -> execute();
  $stmt->store_result();
  $stmt->bind_result(
                               $ISI_NUM,
                                 $BRAND,
                                $PRICE,
                                $NAME,
                                $STATUS,
                                $QUANITY );

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>ADMIN UPDATE SUBITEMS</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>
  <div id="fullscreen_bg" class="fullscreen_bg" />



    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-body">
              <h3 class="text-center">
                        Update Item</h3>
                        <table class="table table-hover table-dark">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">NAME</th>
                              <th scope="col">BRAND</th>
                              <th scope="col">PRICE</th>
                              <th scope="col">STATUS</th>
                              <th scope="col">QUANITY</th>

                            </tr>
                          </thead>
                          <tbody>
                        <?php
                          while($stmt->fetch())
                          {
                          echo "<tr>";
                          echo "<th scope=\"row\">".$ISI_NUM."</th>\n";
                          echo "<td>".$NAME."</td>\n";
                          echo "<td>".$BRAND."</td>\n";
                          echo "<td>".$PRICE."</td>\n";
                          echo "<td>".$STATUS."</td>\n";
                          echo "<td>".$QUANITY."</td>\n";

                          echo "</tr>";
                          }
                          $stmt->data_seek(0);
                            ?>

                          </tbody>
                        </table>


              <form class="form form-signup" role="form" action="process_update.php" method="POST">

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span>


                    <select  name="Item_id" required>
                                  <option value="" selected disabled hidden>Choose Items </option>
                                <?php
                                  while( $stmt->fetch() )
                                  {
                                    echo "<option value=\"$ISI_NUM\">".$NAME."</option>\n";
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
                <button type="submit" class="btn btn-sm btn-primary btn-block" role="button"> Editing Item</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
