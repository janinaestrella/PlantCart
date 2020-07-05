<?php
   require_once './../partials/template.php';

   function get_content(){ 
   require_once './../controllers/connection.php';
?>

   <div class="container mt-5">
   <h3 class="display-4 text-center mb-5">Catalog</h3>
      <!-- Create filter of categories -->

      <a href="./catalog.php" class="btn btn-primary">Show All </a>

      <?php 
      $category_query = "SELECT * FROM categories";
      $categories = mysqli_query($conn, $category_query);

      foreach($categories as $indiv_category){
      ?>
         <!-- Display category names -->
         <a href="./catalog.php?category_id=<?= $indiv_category['id']?>" class="btn btn-success">    
            <?= $indiv_category['name'] ?>
         </a>

      <?php } ?>
   </div>

   <div class="row">
      <!-- Pull all the products from the database -->
      <?php
      $sql_query = "SELECT * FROM products";
      if(isset($_GET['category_id'])){
         $sql_query .= " WHERE category_id = ". $_GET['category_id'];
      }
  
      $products = mysqli_query($conn, $sql_query);
      
      foreach($products as $indiv_products){
         
      ?>
      <!-- Modal when delete button is clicked -->
      <div class="modal fade" id="modal<?php echo $indiv_products['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>

                     <div class="modal-body">
                        Are you sure you want to delete this product?
                     </div>

                     <div class="modal-footer">
                        <a href="./../controllers/delete_product.php?id=<?php echo $indiv_products['id']?>" 
                           class="btn btn-outline-primary" id="confirm-delete">Yes</a> 

                           <?php 

                           $sql_delete = "DELETE FROM products WHERE id={$indiv_products['id']}";
   
                           //connect to database and perform query
                           mysqli_query($conn, $sql_delete);

                           ?>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                     </div>  
                  </div>
            </div>
         </div>
         <!-- End of Modal --> 
         <!-- Cards -->
         <div class="col-sm-3 py-2">
            <div class="card h-100">
               <img src="./../assets/images/<?= $indiv_products['image']?>" alt="Image Unavailable" class="card-img-top">

               <div class="card-body">
                  <h4 class="card-title">
                     <?= $indiv_products['name']?>
                  </h4>   
                  <p class="card-text">
                     <?= $indiv_products['description']?>
                     <br>
                     <?= $indiv_products['price']?>
                  </p>  
               </div>

               <div class="card-footer">
                  <!-- Quantity of the item that will be ordered -->
                  <input type="number" class="form-control" value=1>
                  <button type="button" class="btn btn-success addToCart" data-id="<?= $indiv_products['id']?>">
                     Add to Cart
                  </button>
               </div>

               <!-- Admin Functions -->              
               <div class="row">
                  <div class="col-12 col-sm-8 mb-2 mx-auto">

                     <!-- Update Button-->
                     <a href="./edit_product.php?id=<?php echo $indiv_products['id'];?>" 
                     class="btn btn-sm btn-warning my-1 w-100">Edit Product</a>

                     <!-- Delete Button-->
                     <button type="button" data-toggle="modal" data-target="#modal<?php echo $indiv_products['id'];?>" data-id="<?php echo $indiv_products['id'];?>"
                     class="btn btn-sm btn-danger my-1 w-100">Delete</button>
                  </div>

               </div>
  
            </div>

         </div>  

      <?php } ?> 

   </div>
   
<?php
   };
?>

<script type="text/javascript" src="./../assets/js/addToCart.js"></script>