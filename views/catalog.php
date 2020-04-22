<?php
   require_once './../partials/template.php';
   
   function get_content(){ 
?>
   <div class="container">
      <div class="row my-5">
         <div class="col-sm-2 py-2">
            <img src="#" alt="image unavailable" class="card-img-top">
            <div class="card-body">
               <h4 class="card-title">Product Name</h4>
               <p class="card-text">
                  Price:
                  Description:
               </p>
            </div>
            
            <div class="card-footer">
               <input type="number" class="form-control" value="1">
               <button type="submit" class="btn btn-sm btn-outline-primary">Add to Cart</button>
            </div>
            
         
         </div>
      </div>
   </div>

      
<?php
   };
?>