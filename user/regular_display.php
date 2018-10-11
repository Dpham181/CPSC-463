<?php
    echo '<p>did this work</p>';
    $link = mysqli_connect("127.0.0.1", "dbhost", "danh123", "STORE_SITE");
    if (!$link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
    echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
    echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;
    $dataArray = [];
    if($someQryObject = $link->query("SELECT * FROM sub_items")){
        printf("Select returned %d rows.\n", $someQryObject->num_rows);
        $row = $someQryObject->fetch_assoc();
    }
    var_dump($row);
?>  