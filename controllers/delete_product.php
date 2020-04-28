<?php
   require './connection.php';

   $id = $_GET['id'];

   $sql_delete = "DELETE FROM products WHERE id = $id";
   
   $result = mysqli_query($conn, $sql_delete);

   header ('location: ./../views/catalog.php');
?>