
<?php session_start();?>
<nav class="navbar navbar-expand-lg navbar-light bg-lightSS">
  <a class="navbar-brand" href="#">PushCart <i class="fas fa-shopping-cart"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="./../views/home.php">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="./../views/add_category.php">Add Category</a>
      <a class="nav-item nav-link" href="./../views/add_product.php">Add Product</a>
      <a class="nav-item nav-link" href="./../views/catalog.php">Catalog</a>
      <a class="nav-item nav-link" href="./../views/cart.php">Cart</a>
        <span class="badge bg-light test-dark" id="cart-count">
      <?php
        if(isset($_SESSION['cart'])){
          echo array_sum($_SESSION['cart']);
        } else {
          echo 0;
        }
      ?>
        </span>
      
      <?php if(isset($_SESSION['email'])) { ?>
        <a class="nav-item nav-link" href="./../controllers/logout.php">Logout</a>
        
      <?php } else { ?>
        <a class="nav-item nav-link" href="./../views/register.php">Register</a>
        <a class="nav-item nav-link" href="./../views/login.php">Login</a>
        
      <?php } ?>

      
    </div>
  </div>
</nav>