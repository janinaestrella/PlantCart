<?php
   require_once 'connection.php';
   
   //get data from add category.php using name
   $category_name = $_POST['catname'];
   
   //select query
   $sql_select = "SELECT * FROM categories WHERE name = '$category'";
   
   //connect query to database
   $select = mysqli_query($conn,$sql_select);  
   
  
   if (empty($category_name)){                      //validation if blank category was inputted
      header ("location: ./../views/add_category.php");
		// die ("Input a category");
	} elseif (mysqli_num_rows($result) > 0 ) {     //to check if category inputted is already existing
      //mysqli_num_rows -- returns an integer on how many entries are there in our query.
      echo "This category already exists.";    
     
   } else {
      //if not existing, insert new category to database
      $sql_insert = "INSERT INTO categories (name) VALUES ('$category_name')";
      $result = mysqli_query($conn,$sql_insert);  
      header ("location: ./../views/add_category.php");
   }
   
   
?>