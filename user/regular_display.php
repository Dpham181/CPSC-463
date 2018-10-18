
<?php
    require_once('../HOST/configRE.php');

    // echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
    // echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;
    $dataArray = array();
    if ($someQryObject = $link->query("SELECT BRAND, PRICE, QUANTITY, TITLE FROM sub_items, items WHERE ISI_NUM = ITEM_NUM")) {
        while ($row = $someQryObject->fetch_array()) {
            $dataArray[]=$row;
        }
    }
    else{
        echo "query issue";
    }

    // print_r($dataArray);

    echo "<div class='container card-selection'>";
    echo "<div class='row mx-auto'>";

    for ($i = 0;$i<count($dataArray);$i+=1){
        echo "<div class='card'>";
        //echo "<img/>"
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>".$dataArray[$i][BRAND]."</h5>";
        echo "<p class='card-text card-price'>Price: $".$dataArray[$i][PRICE];
        echo "<p class='card-text'>".$dataArray[$i][TITLE]."</p>";
        echo "<a href='#' onclick='addToCart(".json_encode($dataArray[$i]).")' class='btn btn-primary'>Add to Cart</a>";
        echo "</div></div>";
    }
    echo "</div>";
    echo "</div>";

?>  