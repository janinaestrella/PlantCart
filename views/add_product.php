<?php
   require_once './../partials/template.php';
   
   function get_content(){ 
?>
   <div class="container">
      <div class="row my-5">
         <div class="col-12 col-sm-10 col-md-8 mx-auto">
         <h3 class="display-4 text-center mb-5">Add Product Form</h3>
         <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
            <label for="product-name">Product Name:</label>
            <input type="text" name="product-name" id="product-name" class="form-control">
            </div>
            
            <div class="form-group">
            <label for="product-price">Product Price:</label>
            <input type="text" price="product-price" id="product-price" class="form-control">
            </div>
            
            <div class="form-group">
            <label for="product-image">Product Image:</label>
            <input type="file" image="product-image" id="product-image" class="form-control-file">
            </div>
            
            <div class="form-group">
            <label for="product-description">Product Description:</label>
            <textarea name="product-description" id="product-description" cols="30" rows="5" class="form-control"></textarea>
            </div>
            
            <div class="form-group">
            <label for="product-category">Product Category:</label>
            <select name="product-category" id="product-category" class="form-control">
               <option value="#">Option 1</option>
               <option value="#">Option 2</option>
               <option value="#">Option 3</option>
               <option value="#">Option 4</option>
            
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