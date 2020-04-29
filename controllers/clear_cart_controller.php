<?php
   session_start();

   unset($_SESSION['cart']);

   header ("location: {$_SERVER['HTTP_REFERER']}");
   // or
   // header ("location: ./../views/cart.php");
   
?>