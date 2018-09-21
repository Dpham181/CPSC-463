<?php
if (isset($_GET['id'])){
  $id= $_GET['id'];
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


              <form class="form form-signup" role="form" action="process_update.php" method="POST">


                    <input type="hidden" name="Item_id" value="<?php echo $id; ?>">

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


</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
