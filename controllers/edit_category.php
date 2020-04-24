<?php 
   
   require_once 'connection.php';
   
   //category name from edit_category_form.php
   $category_name = $_POST['category'];
   $id = $_GET['id'];

   $sql_update = "UPDATE categories SET name= '$category_name' WHERE id= '$id'";

   //connect to database and perform query
   $category = mysqli_query($conn, $sql_update);
   
   //go back to add category page
   header ("location: ./../views/add_category.php");
?>