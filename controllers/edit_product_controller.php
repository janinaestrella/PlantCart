<?php

   // get values from edit_product.php
   $product_id = $_GET['id'];
   $product_name = htmlspecialchars(trim ($_POST['product-name']));  
   $product_price = htmlspecialchars(trim ($_POST['product-price']));  
   $product_category = htmlspecialchars(trim ($_POST['product-category']));  
   $product_description = htmlspecialchars(trim ($_POST['product-description'])); 

   //function to check if image selected is not empty
   function checkIfFileSelected($file){
      if(empty($_FILES['product-image']['name'])){
         return false;
      } else {
         return true;
      }
   }

   //function to check the file type and size of the image
   function saveFile($file){
      $filename = $file['name'];
      $filesize = $file['size'];
      $filetype = strtolower (pathinfo($filename, PATHINFO_EXTENSION));
      $file_tmp_name = $file['tmp_name'];

      $is_not_image = true;
      $is_empty_file = true;

      //to check is file size is not 0
      if (
         $filetype == "jpg" ||
         $filetype == "jpeg" ||
         $filetype == "png" ||
         $filetype == "gif" ||
         $filetype == "svg" 
      ) {
         $is_not_image = false;
      }

      //to validate name
      if ($filesize > 0){
         $is_empty_file = false;
      }

      //to validate file type
      if (!$is_empty_file && !$is_not_image){
         $filename_with_date = date("Y-m-d-h-i-s",time()) . "$filename";
			$destination = "../assets/images/" . $filename_with_date;
         move_uploaded_file($file_tmp_name, $destination);
         
			return $filename_with_date;
 
      }
      return false;
   }

   //function to check if all fields are not empty
   function checkInputIsComplete($name, $price, $category,$description){
      
      if(empty($name) ||
         empty($price) ||
         empty($category) ||
         empty($description) 
      ){
         return false;
      } else {
         return true;
      }
 
   }

   if(checkInputIsComplete($product_name, $product_price, $product_category, $product_description)){
      require './../controllers/connection.php';

      if(checkIfFileSelected($_FILES['product-image'])){
         $image = saveFile($_FILES['product-image']);

         $sql_update = "UPDATE products 
                       SET name = '$product_name',
                           price = $product_price,
                           category_id = $product_category,
                           description = '$product_description',
                           image = '$image'
                       WHERE
                           id = $product_id
                       ";

         mysqli_query($conn, $sql_update);
         header ('location: ./../views/catalog.php?id={$product_id}');

      } else {
         header ("location: {$_SERVER['HTTP_REFERER']}");
      }

   }


?>


<!-- 
trim - removes white spaces or other characters from the beginning and end
htmlspecialchars() - converts special characters to HTML entities 
-->
