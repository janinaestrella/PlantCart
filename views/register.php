<?php
   require_once './../partials/template.php';
   
   require './../controllers/connection.php';  
   
   function get_content(){ ?>
                          
     <div class="container">
        <div class="row">
           <div class="col-md-8 offset-md-2"> 
                <h3 class="display-4  mb-5">Registration Form</h3>  <!--text-center -->
               <form action="./../controllers/process_register.php" method="post" id="registrationForm" class="my-3">
                  <div class="row">
                     <div class="col-md-6 text-center">
                        <div class="form-group">
                           <label for="firstname">First Name:</label>
                           <input type="text" name="firstname" id="firstname" class="form-control">
                        </div>
                        
                        <div class="form-group">
                           <label for="lastname">Last Name:</label>
                           <input type="text" name="lastname" id="lastname" class="form-control">
                        </div>
                        
                        <div class="form-group">
                           <label for="email">Email:</label>
                           <input type="email" name="email" id="email" class="form-control">
                        </div>
                        
                        <div class="form-group">
                           <label for="password">Password:</label>
                           <input type="password" name="password" id="password" class="form-control">
                        </div>
                        
                        <div class="form-group">
                           <label for="confirm_password">Confirm Password:</label>
                           <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100" id="reg-btn">Register</button>
                        
                     </div>
                  </div>    
               </form>
               
           
           </div>
        </div>
     </div>                     
                          
                          
<?php
   };
?>                          