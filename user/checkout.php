<!-- checkout.php :: this file is in charge of updating the database for the user's history -->
<?php
    // $data = $_POST["http://localhost:8080/user/checkout.php"];
    // var_dump($_POST);
    require_once('../HOST/configAD.php');

    // php doesn't like json from javascript, so we need to get the input content after an ajax post is made
    $data = json_decode(file_get_contents('php://input'));
    print_r($data->Shopping);
    print_r($data->Session);
    // $dataArray = [];
    // $orderId;
    $customerID;
    $orderID;
    // $data/json_decode values is treated as a class object, so dereference with arrows.
    // this is how you get the brand name from the first item in the shopping cart
    // $data->Shopping[0]->Brand
    // sorry for making it ugly..
    //query customer for the unique key value
    //update ordering with new incrememnt key, then unique key of customer, then timestamp
    //update invoice with orderid as the incremement key of ordering as long as the same key is valid.
    //this way we don't have to keep track of timestamps when checking reciept on individual prices.
    $paymentstatus = "pass";
    // $selectCustomer = "select * from CUSTOMER where R_ID=".$data->Session->id.";";
    $stmt = $link->prepare("SELECT CUSTOMER_ID FROM CUSTOMER WHERE R_ID=(?);");
    $stmt->bind_param('i', $data->Session->id);
    
    if($stmt->execute()){
        $stmt->bind_result($id);
        while($stmt->fetch()){
            $customerID = $id;
        }
    }
    else{
        echo "Error: " . $query . "<br>" . $link->error;
    }
    $stmt->close();
    var_dump($customerID);
    $stmt = $link->prepare("INSERT INTO ORDERING(CORDER_ID, PAYMENT_STATUS) VALUES (?,?)");
    $stmt->bind_param('is', $customerID, $paymentstatus);
    if($stmt->execute()) {
        echo "it worked";
    }
    else {
        echo "Error: " . $query . "<br>" . $link->error;
    }
    $stmt->close();


    // $getLatestOrderingID = "SELECT max(ORDER_ID) from ORDERING where CORDER_ID = ".$customerID.";";
    $stmt = $link->prepare("SELECT max(ORDER_ID) from ORDERING where CORDER_ID = (?);");
    $stmt->bind_param('i', $customerID);
    if($stmt->execute()){
        $stmt->bind_result($id);
        while($stmt->fetch()){
            $orderID = $id;
            var_dump($orderID);
        }
    }
    else{
        echo "Error: " . $query . "<br>" . $link->error;
    }
    $stmt->close();
    // $updateInvoice = "INSERT INTO INVOICE (ITEMS_ID, OR_ID, QUANTITY, PRICE, CUS_INFO, TOTAL)"
    // ." VALUES (".$data->Shopping[0]->id.",".$dataArray[0].",".$data->Shopping[0]->Quantity.",".$data->Shopping[0]->Price.",\"...\",".$data->Total.");";
    $stmt = $link->prepare("INSERT INTO INVOICE (ITEMS_ID, OR_ID, QUANTITY, PRICE, CUS_INFO, TOTAL)"
    ." VALUES (?,?,?,?,\"...\",?);");
    for ($i=0; $i<count($data->Shopping); $i++){
        $stmt->bind_param('iiiii',$data->Shopping[$i]->id,$orderID,$data->Shopping[$i]->Quantity,$data->Shopping[$i]->Price,$data->Total);
        if($stmt->execute()) {
            echo "it worked";
        }
        else {
            echo "Error: " . $query . "<br>" . $link->error;
        }
    }
    $stmt->close();
    // $link->query();
    // -- subitems id --- SI_NUM the unique subitem number
    // -- order id ---- CUSTOMER_ID
    // -- QUANTITY
    // -- price
    // -- customer INFO_ID lets make this a hash! or current date is probably smarter and easier
    // -- total
    // INVOICE DUMP
    // INVOICE_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    // ITEMS_ID INT(10) UNSIGNED NOT NULL,
    // OR_ID INT (10) UNSIGNED NOT NULL,
    // QUANTITY INT(250) UNSIGNED DEFAULT 0,
    // PRICE INT (10) UNSIGNED DEFAULT 0,
    // CUS_INFO VARCHAR(250),
    // TOTAL INT(10) UNSIGNED DEFAULT 0,

?>