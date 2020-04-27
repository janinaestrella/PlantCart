
let addToCartBtns = document.querySelectorAll(".addToCart");

addToCartBtns.forEach (
   function (addToCartBtn) {
      addToCartBtn.addEventListener("click", (indiv_button) => {
         let product_id = indiv_button.target.getAttribute("data-id");
         let product_quantity = indiv_button.target.previousElementSibling.value;

         //validataion if qty is greater than 0
         if (product_quantity <=0){
            alert("Please enter a valid quantity");
         } else {
         //prepare data to be sent via fetch method
            let data = new FormData;
            data.append("productId", product_id);
            data.append("productQuantity", product_quantity);

            fetch("./../controllers/update_cart.php", {
               method: "POST", 
               body: data
            })
            .then(function(response){
               return response.text();
            })
            .then(function(data){
               document.querySelector("#cart-count").innerHTML = data;
            })

         }
      })
   }

)
