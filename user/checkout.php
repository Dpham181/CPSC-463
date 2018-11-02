<!-- this file is in charge of updating the database for the user's history -->
<?php
    // $data = $_POST["http://localhost:8080/user/checkout.php"];
    // var_dump($_POST);
    require_once('../HOST/configAD.php');

    // php doesn't like json from javascript, so we need to get the input content after an ajax post is made
    $data = json_decode(file_get_contents('php://input'));
    print_r($data->Shopping);
    print_r($data->Session);
    $dataArray = [];
    $customerID = 2;
    // $data/json_decode values is treated as a class object, so dereference with arrows.
    // this is how you get the brand name from the first item in the shopping cart
    // $data->Shopping[0]->Brand
    // sorry for making it ugly..
    print_r($data->Session->email);
    print_r($data->Shopping[0]->Brand);
    date_default_timezone_set('America/Los_Angeles');
    $date = date('m/d/Y h:i:s a');
    //query customer for the unique key value
    //update ordering with new incrememnt key, then unique key of customer, then timestamp
    //update invoice with orderid as the incremement key of ordering as long as the same key is valid.
    //this way we don't have to keep track of timestamps when checking reciept on individual prices.
    $paymentstatus = "pass";
    $selectCustomer = "select * from CUSTOMER where CUSTOMER_ID=".$data->Session->id.";";
    if($someQryObject = $link->query($selectCustomer)){
        echo "it worked";
        echo "Grabbing the customer ID value";
        var_dump($someQryObject->fetch_all());
    }
    else{
        echo "Error: " . $query . "<br>" . $link->error;
    }
    $stmt = $link->prepare("INSERT INTO ORDERING(CORDER_ID, PAYMENT_STATUS) VALUES (?,?)");
    $stmt->bind_param('is', $customerID, $paymentstatus);
    if($stmt->execute()) {
        echo "it worked";
    }
    else {
        echo "Error: " . $query . "<br>" . $link->error;
    }
    $stmt->close();

    $getLatestOrderingID = "SELECT max(ORDER_ID) from ORDERING where CORDER_ID = ".$customerID.";";
    if($someQryObject = $link->query($getLatestOrderingID)){
        echo "it worked";
        while ($row = $someQryObject->fetch_array()) {
            $dataArray[]=$row;
        }
        echo "Grabbing the latest ordering ID value";
        print_r($dataArray[0]);
    }
    else{
        echo "Error: " . $query . "<br>" . $link->error;
    }
    $updateInvoice = "INSERT INTO INVOICE (ITEMS_ID, OR_ID, QUANTITY, PRICE, CUS_INFO, TOTAL)"
    ." VALUES (".$data->Shopping[0]->id.",".$dataArray[0].",".$data->Shopping[0]->Quantity.",".$data->Shopping[0]->Price.",\"...\",".$data->Total.");";
    if(TRUE === $link->query($updateInvoice)) {
        echo "it worked";
    }
    else {
        echo "Error: " . $query . "<br>" . $link->error;
    }
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