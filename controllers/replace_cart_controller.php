<?php
   session_start();

   $id = $_GET['id'];
   $quantity = $_POST['quantity'];
   $_SESSION['cart'][$id] = $quantity; //save the new qty in the product currently stored in the SESSION cart

   header ("location: {$_SERVER['HTTP_REFERER']}");

?>