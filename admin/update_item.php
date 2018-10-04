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
  <link rel="stylesheet" href="../CSS/admin.css">

  <!-- Pasted here -->
  <link rel="icon" href="../../../../favicon.ico">

  <!-- Custom styles for this template -->
  <link href="../css/home.css" rel="stylesheet">

  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body class="text-center">

    <header>

        <img src="../img/logo.png" width="10%" height="60%">

        <div class="flex-container">
          <div class="inner">
            <nav class="nav nav-masthead justify-content-center">
              <a class="nav-link active" href="home.html">Home</a>
              <a class="nav-link" href="LOGIN_SYSTEM/login_page.php">Sign In</a>
              <a class="nav-link" href="contact.html">Contact</a>
            </nav>
          </div>
        </div>

    </header>
    

    <!-- Navigation bar -->
    <div class="sidenav">
      <a href="#">Dashboard</a>
      <a href="#">Profile</a>
      <a href="#">Messages</a>
      <a href="#">Update Items</a>
      <a href="#">Settings</a>
    </div>
    <!-- End of navigation bar -->


    <main role="main" class="inner cover">
      <br />
      <h1 class="cover-heading">Update Items</h1>
    </main>

    <footer class="mastfoot mt-auto">
      <div class="inner">
        <p>&copy; CPSC 463 WEBSITE .</p>
      </div>
    </footer>
  </div>


  <div class="containter">
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6 col-xs-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Update Items</div>
          <div class="panel-body">
            
            <!-- Container of the form -->
            <div class="container">

              <form class="form form-signup" role="form" action="process_update.php" method="POST">

                <input type="hidden" name="Item_id" value="<?php echo $id; ?>">


                <div class="row">
                  <div class="col-3"></div>
                  <div class="col-6">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                        <input type="Text" name="NAME" class="form-control" placeholder="NAME" />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-3"></div>
                  <div class="col-6">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                          <input type="Text" name="BRAND" class="form-control" placeholder="BRAND" />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-3"></div>
                  <div class="col-6">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                          <input type="Text" name="PRICE" class="form-control" placeholder="PRICE" />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-3"></div>
                  <div class="col-6">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                        <input type="Text" name="STATUS" class="form-control" placeholder="STATUS" />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-3"></div>
                  <div class="col-6">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-scale"></span></span>
                        <input type="Text" name="QUANITY" class="form-control" placeholder="QUANITY" />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-3"></div>
                  <div class="col-6">
                    <button type="submit" class="btn btn-sm btn-primary btn-block" role="button"> Editing Item</button>
                  </div>
                </div>

              </form>

            </div>

            <!-- end of form container -->

          </div>
        </div>
      </div>
    </div>
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
        <div class="col-4">
          <button type="submit" class="btn btn-sm btn-primary btn-block" role="button"> Editing Item</button>
        </div>
      </div>

    </form>

  </div>
  <!-- End of form container -->


</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
