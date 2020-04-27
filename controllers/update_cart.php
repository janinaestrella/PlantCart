<?php

   session_start();

   function getCartCount() {
      return array_sum($_SESSION['cart']);
   }

   $product_id = $_POST['productId']; #productId
   $product_quantity = $_POST['productQuantity']; #productQuantity

   if(isset($_SESSION['cart'][$product_id])){
      $_SESSION['cart'][$product_id] += $product_quantity
   } else {
      #declare a session variable with a key equal to the received product id from catalog fetch request 
      #and value equal to receieved quantity
      $_SESSION['cart'][$product_id] = $product_quantity;
   }

   echo getCartCount();
?>