
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

    <button onclick="TITILE()">Add Titile</button>
    <button onclick="Test1()">Add Sub Item</button>

    <script>
function TITILE() {
    var x = document.getElementById("add_title");

    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}
function Test1() {
    var y = document.getElementById("add_subitem");

    if (y.style.display === "none") {
        y.style.display = "block";
    } else {
        y.style.display = "none";
    }

}
</script>

  </head>
  <body>
    <div id="add_title"style="display: none" >
    <?php  require_once('add_title.html'); ?>
    </div>
    <div id="add_subitem"style="display: none" >
    <?php  require_once('add_subitem.php'); ?>
    </div>
  </body>
</html>
