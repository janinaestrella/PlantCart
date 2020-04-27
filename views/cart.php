<?php
   
   require_once './../partials/template.php';
   
   function get_content(){ 
?>
   <div class="container my-4">
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
               <th></th>
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
                  <form action="#" method="POST">
                     <button class="btn btn-danger">Remove Item</button>
                  </form>
               </td>
            </tr>
               <?php } ?>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td>Total: <?= number_format($total,2) ?> </td>
               <td>
                  <a href="#" class="btn btn-success">Check Out</a>
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