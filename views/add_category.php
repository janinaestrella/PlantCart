<?php
   require_once './../partials/template.php';

  
   function get_content(){ 
?>
   <div class="container">
      <div class="row my-5">
         <div class="col-12 col-sm-10 col-md-8 mx-auto">
         <h3 class="display-4 text-center mb-5">Add Category Form</h3>
            <form action="./../controllers/process_category.php" method="post">
               <!-- <div class="form-group">
               <label for="catname" class="mr-1">Category Name</label>
               <input type="text" name="catname" id="catname" class="form-control">
               </div> 
               <button type="submit" class="btn btn-primary">Add Category</button> -->
              
               
               <div class="input-group mb-3 shadow p-3 mb-5 bg-white rounded ">
                  <input type="text" name="catname" id="catname" class="form-control" placeholder="Input New Category">
                  <div class="input-group-append">
                     <button class="btn btn-outline-primary" type="submit">Add Category</button>
                  </div>
               </div>
 
            </form>
            
            <div>
               
               <ul class="list-group" >
                  <?php   
                  require './../controllers/connection.php';
                  
                  $sql_select = "SELECT * FROM categories";
                  $select = mysqli_query($conn,$sql_select); 

                  while ($row = mysqli_fetch_assoc($select)){ ?>
                                                            
                     <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $row['name'] ?>
                     <div class="container d-flex justify-content-end ">
                     <a href="./../controllers/edit_category_form.php?id=<?php echo $row['id']?>&name=<?php echo $row['name']?>" class="btn btn-success mr-3">Edit</a>
                     <a href="./../controllers/delete_category.php?id=<?php echo $row['id']?>" class="btn btn-danger">Delete</a>
                     </div>
                     </li>
                  <?php }; ?> 
              
               </ul>
            </div>
         
         </div>
      </div>
   </div>

      
<?php
   };
?>