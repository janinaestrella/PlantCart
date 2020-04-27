<?php
   require_once './../partials/template.php';

  
   function get_content(){
      
?>
   
   <div class="container">
      <div class="row my-5">
         <div class="col-12 col-sm-10 col-md-8 mx-auto">
        
         <!-- message to tell the user if there was an error uploading new product -->
         <?php 
            if (isset($_SESSION['error_message'])){
         ?>
            <div class="alert alert-danger">
               <?php echo $_SESSION['error_message']; ?>
            </div>
         
         <?php 
            unset($_SESSION['error_message']);
            } 
         ?>

         <h3 class="display-4 text-center mb-5">Add Product Form</h3>
         <form action="./../controllers/process_product.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
            <label for="product-name">Product Name:</label>
            <input type="text" name="product-name" id="product-name" class="form-control">
            </div>
            
            <div class="form-group">
            <label for="product-price">Product Price:</label>
            <input type="text" name="product-price" id="product-price" class="form-control">
            </div>
            
            <div class="form-group">
            <label for="product-image">Product Image:</label>
            <input type="file" name="product-image" id="product-image" class="form-control-file">
            </div>
            
            <div class="form-group">
            <label for="product-description">Product Description:</label>
            <textarea name="product-description" id="product-description" cols="30" rows="5" class="form-control"></textarea>
            </div>
            
            <div class="form-group">
            <label for="product-category">Product Category:</label>
            <select name="product-category" id="product-category" class="form-control">
 
               <?php 
                  require './../controllers/connection.php';
                  
                  $sql_select = "SELECT * FROM categories";
                  $result = mysqli_query($conn, $sql_select);
                  
                  while ($category = mysqli_fetch_assoc($result)){ ?>
                     <option value= "<?php echo $category['id'];?>">
                        <?php echo $category['name'];?>
                     </option>
               <?php  } ?>
            </select>
            </div>
         
            <div class="text-center">
               <button class="btn btn-warning px-5" type="submit">Add New Product</button>
            </div>
         </form>
         </div>
      </div>
   </div>

      
<?php
   };
?>