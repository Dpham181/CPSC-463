// this is only needed for jasmine testing
var Cart = [];
var cartNumber = 0;
var index = 0;

document.getElementById("cart-number").innerText = cartNumber;
function addToCart(dataArray){
    console.log(dataArray);
   
    index = itemExists(dataArray);
    if(index != -1){
        Cart[index].Quantity += 1;
    }
    else{
        Cart.push({ "Brand" : dataArray.BRAND, "Price" : dataArray.PRICE, "Quantity": 1, "id": dataArray.SI_NUM});
    }
    // $('#cart-number').text(cartNumber+=1);
    document.getElementById("cart-number").innerText = (cartNumber += 1);
}

function openCart(){
    console.log(Cart);
    document.getElementById("cart-modal-body").innerHTML = cartIterator(Cart, "modal-body", "cart-modal-body");
    // $(".modal-body").replaceWith(
    //    cartIterator(Cart, "modal-body", "cart-modal-body")
    // );
    // $("#totalAmountValue").text(cartAmount);
    document.getElementById("totalAmountValue").innerText = cartAmount();
}

function cartIterator(arr, classid, idid){
    var cartItems = "<div class='"+classid+"' id='"+idid+"'>";
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
    // $.ajax({
    //     type:"POST",
    //     url:"http://localhost:8080/user/checkout.php",
    //     data: datapost,
    //     dataType: "application/json",
    //     contentType: "text/plain",
    //     success: function(res){
    //         console.log("checkout successful");
    //     }
    // });
    // httpRequest.onreadystatechange = function() {
 
    httpRequest = new XMLHttpRequest();
    if(!httpRequest) {
        alert("can't create XMLHTTP instance");
        return;
    }
    httpRequest.onreadystatechange = function () {
        if(httpRequest.readyState === XMLHttpRequest.DONE) {
            if(httpRequest.status === 200){
                console.log(httpRequest.responseText);
            }
            else {
                console.log("there was a problem")
            }
        }
    };
    httpRequest.open('POST', 'http://localhost:8080/user/checkout.php', true);
    httpRequest.setRequestHeader('Content-Type', 'application/json');
    httpRequest.send(JSON.stringify(datapost));

}

// modules needed for testing
testaddToCart = addToCart;
testopenCart = openCart;
// will allow us to send the functions to the testing suite