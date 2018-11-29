
<?php
    require_once('../HOST/configRE.php');

    // echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
    // echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;
    $dataArray = array();
    if ($someQryObject = $link->query("
            SELECT SUB_ITEMS.BRAND, SUB_ITEMS.PRICE, SUB_ITEMS.QUANTITY, 
                ITEMS.TITLE 
            FROM sub_items, items, invoice 
            WHERE SUB_ITEMS.ISI_NUM = ITEMS.ITEM_NUM and 
                SUB_ITEMS.SI_NUM = INVOICE.OR_ID and 
                INVOICE.SHARING = TRUE")) {
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