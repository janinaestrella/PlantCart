<?php
   require_once 'connection.php';
   
   $name = $_POST['name'];
   
   $sql_insert = "INSERT INTO categories (name) VALUES ('$name')";
   
   mysqli_query($conn,$sql_insert);   
   
   header ("location: ./../views/add_category.php");
   
?>