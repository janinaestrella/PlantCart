<?php 
      require_once './../partials/template.php';
      function get_content(){ 
                             
      require_once 'connection.php';
      $placeholder = $_GET['name'];
?>
<div class="container">
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
   
   
