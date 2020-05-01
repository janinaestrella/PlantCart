<?php
   
   require_once './../partials/template.php';
   
   function get_content(){ 
?>
   <div class="container mt-5">
      <div class="row">
         <div class="col-lg-12">
         <h3 class="display-4 text-center mb-5">What's in your Cart</h3>
            
         </div>
      </div>
   </div>
   
   <div class="table-responsive">
      <table class="table table-striped table-bordered" id="cart-items">
         <thead>
            <tr>
               <th>Items</th>
               <th>Prices</th>
               <th>Quantity</th>
               <th>Subtotal</th>
               <th>Actions</th>
            </tr> 
         </thead>
         
         <tbody>
            <?php 
            require_once './../controllers/connection.php';
            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 ){
               $total = 0;
               foreach($_SESSION['cart'] as $product_id => $product_quantity){
                  //query to insert data to products table
                  $sql_query = "SELECT * FROM products WHERE id = $product_id";
                  $result = mysqli_query($conn, $sql_query);
                  $indiv_product = mysqli_fetch_assoc($result);

                  //converts to associative array into a number of variable with names as the keys
                  extract($indiv_product);

                  $subtotal = $price * $product_quantity;
                  $total += $subtotal; 
            ?>
            
            <tr>
               <td><?= $name ?></td>
               <td><?= $price ?></td>
               <td><?= $product_quantity ?></td>
               <td><?= number_format($subtotal,2) ?></td>
               
               <td>
                  <!-- edit quantity in cart -->
                  <form action="./../controllers/replace_cart_controller.php?id=<?= $id ?>" method="POST">
                     <label for="quantity">Edit Quantity</label>
                     <input type="number" id="quantity" name="quantity" class="form-control form-control-sm"
                        value="<?php echo $product_quantity?>">
                     <button class="btn btn-warning w-100 my-1">Change Qty</button>
                  </form>

                  <!-- remove item from cart -->
                  <a href="./../controllers/remove_from_cart_controller.php?id=<?= $id ?>" method="POST" class="btn btn-danger w-100 my-1">Remove Item</a>
               </td>
            </tr>
               <?php } ?>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td>Total: <span id="total-amount"><?=$total?></span></td>
               <td>
                  <!-- payment modes -->
                  <form action="./../controllers/create_transactions.php" method="post">
                     <div class="form-group">
                        <label for="payment-mode"> Choose Payment Mode:</label>
                        <select name="payment-mode" id="payment-mode" class="form-control">
                           <?php 
                              $sql_query = "SELECT * FROM payment_modes";
                              $result = mysqli_query($conn, $sql_query);

                              while ($mode =  mysqli_fetch_assoc($result)){ 
                           ?>
                                 <option value="<?php echo $mode['id'];?>"><?php echo $mode['name'];?></option>
                           <?php
                              }
                           ?>

                        </select>

                        <button type="submit" class="btn btn-success w-100 my-1">Checkout</button>
                     </div>
                  </form>

                  <div class="text-center my-3">
                  OR
                  </div>
                  
                  <div id="paypal-smart-button"></div>


                  <!-- remove ALL items -->
                  <a href="./../controllers/clear_cart_controller.php" class="btn btn-outline-danger">Empty Cart</a>

               </td>
            </tr>
            <?php      
            } else {
                  echo "<tr>
                           <td class ='text-center' colspan='6'> No Products in Cart</td>
                        </tr>";  
            }
            ?>
  
         </tbody>
      
      </table>
   
   </div>
   
   <hr>
   <script
	    src="https://www.paypal.com/sdk/js?client-id=AcNeMJnwJ9fCobZ0vss5lIL6dqlPqwQ9NNUIEDX5PbPDkd8Ynk4B02W_eWoDTdy87pd7-Wa-62rt1LpL&currency=PHP"> 
	    // Required. Replace SB_CLIENT_ID with your sandbox client ID.
  	</script>
	<script>
		// console.log(typeof document.querySelector('#total-amount').innerHTML);

		paypal.Buttons({
			createOrder: function(data, actions) {
			    // This function sets up the details of the transaction, including the amount and line item details.
               return actions.order.create({
			      	purchase_units: [{
			      		amount: {
			      			value: document.querySelector('#total-amount').innerHTML
			      		}
			      	}]
			   });
		   },
         onApprove: function(data, actions) {
      		// This function captures the funds from the transaction.
      			return actions.order.capture().then(function(details) {
        		// This function shows a transaction success message to your buyer.
            //console.log(data.orderID);
        		alert('Transaction completed by ' + details.payer.name.given_name);
        		let formData = new FormData;
  				formData.append("orderID",data.orderID);
 
  				option = {
  					method: "POST",
  					body: formData
  					// JSON.stringify(data) //converts js data to text/string

  				}

  				fetch("http://localhost:8000/controllers/create_paypal_transaction.php", option)
  				// ()=>{} alternative to function()=>{}
  				.then((response)=>{
  					return response.text();
  				})
  				.then((data)=>{
  					console.log(data);
  				})
      		});
    		}
		}).render('#paypal-smart-button')
  		</script>
<?php
   };
?>

