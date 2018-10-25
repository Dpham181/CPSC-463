<!-- this file is in charge of updating the database for the user's history -->
<?php
    // $data = $_POST["http://localhost:8080/user/checkout.php"];
    // var_dump($_POST);

    // php doesn't like json from javascript, so we need to get the input content after an ajax post is made
    $data = json_decode(file_get_contents('php://input'));
    print_r($data);
    var_dump($data);
    // for( $i = 0; $i < $data.)
?>