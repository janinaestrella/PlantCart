<?php 
      require_once './../partials/template.php';
      function get_content(){ 
                             
      require_once 'connection.php';
      $placeholder = $_GET['name'];
?>
<div class="container mt-5">
<h3 class="display-4 text-center mb-5">Edit Category Form</h3>
   <div class="row my-5">
      <div class="col-12 col-sm-10 col-md-8 mx-auto">   
   
      <form action="edit_category.php?id=<?php echo $_GET['id']?>" method="post">   
         <div class="input-group mb-3 shadow p-3 mb-5 bg-white rounded ">
            <input type="text" name="category" id="category" class="form-control" placeholder="<?php echo $placeholder ?>">
            <div class="input-group-append">
               <button class="btn btn-outline-primary" type="submit">Edit Category</button>
            </div>
         </div>
      </form>
      </div>
   </div>
</div>
<?php }; ?>
   
   
