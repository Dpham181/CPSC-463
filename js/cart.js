var Cart = [];
var cartNumber = 0;
var index = 0;
$('#cart-number').text(cartNumber);
function addToCart(dataArray){
    console.log(dataArray);
   
    index = itemExists(dataArray);
    if(index != -1){
        Cart[index].Quantity += 1;
    }
    else{
        Cart.push({ "Brand" : dataArray.BRAND, "Price" : dataArray.PRICE, "Quantity": 1, "id": dataArray.SI_NUM});
    }
    $('#cart-number').text(cartNumber+=1);
}

function openCart(){
    console.log(Cart);
    $(".modal-body").replaceWith(
       cartIterator(Cart, "modal-body")
    );
    $("#totalAmountValue").text(cartAmount);
}

function cartIterator(arr, subject){
    var cartItems = "<div class='"+subject+"'>";
    for(var i = 0; i < arr.length; i++){
        cartItems += "<p>Brand: "+arr[i].Brand+"<br/>Price: "+arr[i].Price+"</p><label>Quantity: "+arr[i].Quantity+"</label>";
    }
    cartItems +="</div>";
    return cartItems;
}

function itemExists(arr){
    for(var i = 0; i < Cart.length; i++){
        if(Cart[i].Brand == arr.BRAND){
            return i;
        }
    }
    return -1;
}

function cartAmount(){
    var total = 0;
    for(var i = 0; i < Cart.length; i++){
        total += (Cart[i].Price * Cart[i].Quantity);
    }
    return total;
}

function purchaseReceipt(session){
    datapost = {
        "Shopping" : Cart,
        "Session" : session,
        "Total" : cartAmount()
    }
    console.log(datapost);
    $.ajax({
        type:"POST",
        url:"http://localhost:8080/user/checkout.php",
        data: datapost,
        dataType: "application/json",
        contentType: "text/plain",
        success: function(res){
            console.log("checkout successful");
        }
    });
}