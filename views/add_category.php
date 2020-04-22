<?php
   require_once './../partials/template.php';
   
   function get_content(){ 
?>
   <div class="container">
      <div class="row my-5">
         <div class="col-12 col-sm-10 col-md-8 mx-auto">
            <form action="#" method="post">
               <div class="form-group">
               <label for="name">Category Name</label>
               <input type="text" name="name" id="catname" class="form-control">
               </div>
               
               <button type="submit" class="btn btn-primary">Add Category</button>
            
            
            
            </form>
         
         </div>
      </div>
   </div>

      
<?php
   };
?>