<?php
   require_once 'connection.php';
   
   $sql_delete = "DELETE FROM categories WHERE id={$_GET['id']}";
   
   //connect to database and perform query
   mysqli_query($conn, $sql_delete);

   //go back to add category page
   header ("location: ./../views/add_category.php");

?>