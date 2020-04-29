<?php 
   session_start();

   $id =  $_GET['id'];
   
   //destroy the product inside the SESSION cart
   unset($_SESSION['cart'][$id]);

   //control structure that will check if the items saved on the CART SESSION is empty
   if(count($_SESSION['cart']) === 0){
      unset($_SESSION['cart']);
   }

   header ("location: {$_SERVER['HTTP_REFERER']}");

?>