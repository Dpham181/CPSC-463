
<?

session_start();
if ($_SESSION['type'] !== 'A') {
 $_SESSION = array();
 session_destroy();
 header("location: home.html");
 exit;
}
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
 header("location: home.html");
 exit;
}
if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
 header("location: home.html");
 exit;
}



?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Admin Site </title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <a href="#" id="additem">ADD ITEMS</a> |||
    <a href="#" id="vieworder">VIEW ORDERS</a> |||
    <a href="#" id="Update">UPDATE ITEMS</a>  |||


  </head>
  <body>

    <div id="title"></div>
    <div id="sub_item"></div>
    <div id="order"></div>
    <div id="update"></div>

    <script type="text/javascript">

    $('#additem').on( 'click', function(){
       $("#title").load("add_title.html");
       $("#sub_item").load("add_subitem.php");

       return false;
    });

    $('#vieworder').on('click', function(){
       $("#order").load("view_order.php");

       return false;
    });

    $('#Update').on('click', function(){
       $("#update").load("choose_category.php");

       return false;
    });
    </script>
  </body>


</html>
