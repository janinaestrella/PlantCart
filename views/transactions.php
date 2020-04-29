<?php
   require './../partials/template.php';

   function get_content() { 
?>
   <?php 
   $get_transactions = "SELECT 
                        transactions.transaction_code,
                        transactions.total,
                        users.firstname,
                        users.lastname,
                        payment_modes.name as payment_name,
                        statuses.name as status_name,
                        transactions.id
                        FROM transactions
                        JOIN users ON (transactions.user_id = users.id)
                        JOIN payment_modes ON (transactions.payment_mode_id = payment_modes.id)
                        JOIN statuses ON (transactions.status_id = statuses.id)
                        WHERE users.id = {$_SESSION['user']['id']}";

            
   ?>
   <div class="container">
      <div class="row my-5">
         <div class="col-12 col-sm-10 col-md-8 mx-auto">   
            <h3 class="display-4 text-center mb-5">Transactions</h3>
               <?php 
                  require_once './../controllers/connection.php';

                  $result = mysqli_query($conn, $get_transactions);   
                  while ($transaction = mysqli_fetch_assoc($result)){

               ?>         
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <!-- transaction code -->
                        <tr>
                           <td>Transaction Code:</td>
                           <td><?php echo $transaction['transaction_code']?></td>
                        </tr>

                        <!-- customer -->
                        <tr>
                           <td>Customer Name:</td>
                           <td><?php echo $transaction['firstname'] ." ". $transaction ['lastname'];?></td>
                        </tr>

                        <!-- payment mode -->
                        <tr>
                           <td>Payment Mode:</td>
                           <td><?php echo $transaction['payment_name'];?></td>
                        </tr>

                        <!-- transaction status -->
                        <tr>
                           <td>Status:</td>
                           <td><?php echo $transaction['status_name'];?></td>
                        </tr>
                     </table>

                     <!-- Purchased Items -->
                     <table class="table table-hover">
                        <tbody>
                           <tr>
                              <td>Product Name:</td>
                              <td>Price per Unit:</td>
                              <td>Quantity:</td>
                              <td>Subtotal:</td>
                           </tr>

                           <?php 
                           $get_product_transactions = "SELECT
                                                         product_transactions.quantity,
                                                         products.name,
                                                         products.price
                                                      FROM
                                                         product_transactions
                                                      JOIN products ON (
                                                         products.id = product_transactions.product_id )
                                                      WHERE
                                                         product_transactions.transaction_id = {$transaction['id']}";
                           $result_products = mysqli_query($conn, $get_product_transactions);
 
                           while ($product = mysqli_fetch_assoc($result_products)){
                           ?>
                           <!-- start of row per item -->
                           <tr>
                              <td><?php echo $product['name'];?></td>
                              <td>&#8369; <?php echo number_format($product['price'],2);?></td>
                              <td><?php echo $product['quantity'];?></td>
                              <td>&#8369; <?php echo number_format($product['price'] * $product['quantity'],2) ?></td>
                           </tr>
                           <!-- end of row per item -->
                           <?php
                           }
                           ?>
                        </tbody>

                        <tfoot>
                           <tr class="bg-secondary">
                              <td colspan="3">Total:</td>
                              <td>&#8369; <?php echo number_format($transaction['total'],2); ?></td>
                           </tr>
                        </tfoot>
                     </table>
      
                  </div>
               <!-- <hr> -->
               <?php
                  }
               ?>

         </div>   
      </div>
   </div>

<?php
   }
?>