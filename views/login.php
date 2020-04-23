<?php
   require_once './../partials/template.php';
   
   function get_content(){ ?>
      <div class="container">
         <div class="row text-center my-3">
            <div class="col-md-4 offset-md-4">
               <form action="./../controllers/authenticate.php" method="post">
               
               <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" id="username" name="username" class="form-control">
               </div>
               
               <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" id="password" name="password" class="form-control">
               </div>
               
               <button type="submit" class="btn btn-primary w-100">Log In</button>
               
               </form>   
            
            </div>
         
         
         
         </div>
      
      
      
      </div>
      
           
      
<?php     
   };
?>