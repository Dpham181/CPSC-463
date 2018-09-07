
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

    <button onclick="myFunction()">Add Titile</button>
    <script>
function myFunction() {
    var x = document.getElementById("add_title");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>

  </head>
  <body>
    <div id="add_title"style="display: none" >
    <?php  require_once('add_titile.html'); ?>
    </div>
  </body>
</html>
