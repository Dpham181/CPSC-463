describe("Adding to the Cart", function () {
      it('add item to a list and return an increment of 1', function () {
          var arr = {"Brand": "Toffee Coffee", "Price": "10", "Quantity": 2, "id": "1" }
          var test1 = addToCart(arr, 0);
          expect(test1).toEqual(1);
      });
  });
  
  describe("Opening the cart", function () {
      it('iterate through the cart', function(){
          var arr = [{"Brand": "Toffee Coffee", "Price": "10", "Quantity": 2, "id": "1" }];
          var cartHtml = cartIterator(arr, "modal-body", "cart-modal-body");
          console.log(cartHtml);
          expect(cartHtml).toBe("<div class='modal-body' id='cart-modal-body'><p>Brand: Toffee Coffee<br/>Price: 10</p><label>Quantity: 2</label></div>");
      });
      it('return cart amount', function(){
          var arr = [
              {"Brand": "Toffee Coffee", "Price": "10", "Quantity": 2, "id": "1" },
              {"Brand": "Toffee Coffee", "Price": "10", "Quantity": 1, "id": "1" }
          ];
          var test3 = cartAmount(arr);
          expect(test3).toEqual(30);
      });
  });