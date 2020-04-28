<?php
   require_once   './../partials/template.php';

   function get_content(){

      require './../controllers/connection.php';

      $id = $_GET['id'];
      $sql_select_single_query = "SELECT * FROM products WHERE id = {$id}";
      $result = mysqli_query($conn,$sql_select_single_query);

      $product = mysqli_fetch_assoc($result);
?>
      <!-- Replicate the input files in add_product.php -->
      <div class="container mt-5">
         <div class="row my-5">
            <div class="col-12 col-sm10 col-md-8 mx-auto">
            <h3 class="display-4 text-center mb-5">Edit Product Form</h3>

            <form action="./../controllers/edit_product_controller.php?id=<?php echo $product['id'];?>" 
               method="post" enctype="multipart/form-data">

               <!-- Product Name -->
               <div class="form-group">
               <label for="product-name" class="small">Product Name:</label>
               <input type="text" name="product-name" class="form-control form-control-sm" 
                  value="<?php echo $product['name'];?>">
               </div>
               
               <!-- Product Price -->
               <div class="form-group">
               <label for="product-price" class="small">Product Price:</label>
               <input type="text" name="product-price" class="form-control form-control-sm" 
                  value="<?php echo $product['price'];?>">
               </div>

               <!-- Product Image -->
               <div class="form-group">
               <label for="product-image" class="small">Product Image:</label>
               <input type="file" name="product-image" id="product-image" class="form-control-file form-control-sm" 
                  value="<?php echo $product['image'];?>">
               </div>

               <!-- Product Description -->
               <div class="form-group">
               <label for="product-description" class="small">Product Description:</label>
               <textarea name="product-description" id="product-description" rows="5" cols="30"
                  class="form-control"><?php echo $product['description'];?>
               </textarea>
               </div>

               <!-- Product Category -->
               <div class="form-group">
               <label for="product-category" class="small">Product Category:</label>
               <select name="product-category" id="product-category" class="form-control-sm">
                  <?php 
                     require_once './../controllers/connection.php';

                     $sql_query = "SELECT * FROM categories";
                     $result = mysqli_query($conn, $sql_query);

                     while($category = mysqli_fetch_assoc($result)){
                  ?>
                        <option value="<?php echo $category['id'];?>"
                           <?php if($category['id'] == $product['category_id']){
                              echo "selected";    
                           } ?>
                        >
                           <?php echo $category['name'];?>
                        </option>
                  <?php
                  }
                  ?>
               </select>
               </div>

               <!-- Button to edit product -->
                  <div class="text-center">
                     <button class="btn btn-success px-5" type="submit">Update Product</button>

                  </div>
         
            </form>
            </div>
         </div>
      </div>
<?php
   }
?>