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
               <td>Total: <?= number_format($total,2) ?> </td>
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

                        <button type="submit" class="btn btn-success w-100 my-100">Checkout</button>
                     </div>
                  </form>

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
      
<?php
   };
?>