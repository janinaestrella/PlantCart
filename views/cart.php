<?php
   require_once './../partials/template.php';
   
   function get_content(){ 
?>
   <div class="container my-4">
      <div class="row">
         <div class="col-lg-12">
            <h2>Cart Page</h2>   
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
            <tr>
               <td>Item Name</td>
               <td>Item Price</td>
               <td>Quantity</td>
               <td>Subtotal</td>
               <td>
                  <form action="#" method="POST">
                     <button class="btn btn-danger">Remove Item</button>
                  </form>
               </td>
            </tr>
               <td></td>
               <td></td>
               <td></td>
               <td>Total: </td>
               <td>
                  <a href="#" class="btn btn-success">Check Out</a>
               </td>
            <tr>
            
            </tr>
         </tbody>
      
      </table>
   
   </div>
   
   <hr>
      
<?php
   };
?>