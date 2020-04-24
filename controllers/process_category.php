<?php
   require_once 'connection.php';
   
   $category_name = $_POST['catname'];
   
   $sql_select = "SELECT * FROM categories WHERE name = '$category'";
   $select = mysqli_query($conn,$sql_select);  
   
   if (empty($category_name)){
		die ("Input a category");
	}
   
   if (mysqli_num_rows($result) > 0 ) {
      echo "This category already exists.";
   } else {
      $sql_insert = "INSERT INTO categories (name) VALUES ('$category_name')";
      $result = mysqli_query($conn,$sql_insert);  
      header ("location: ./../views/add_category.php");
   }
   
   
   
?>