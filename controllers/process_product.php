<?php
   require_once 'connection.php';
   
   $product_name = $_POST['product-name'];
   $product_price = $_POST['product-price'];
   $product_image = $_FILES['product-image'];
   $product_description = $_POST['product-description'];
   $product_categoryid = $_POST['product-category'];
   
   $image_name = $product_image['name'];
   $image_type = strtolower (pathinfo($image_name, PATHINFO_EXTENSION)); #for getting file type
   $image_tmpname = $product_image['tmp_name'];
   $image_size = $product_image['size'];
   
   $is_not_image = true;
   $is_empty_file = true;

   #validation to check file size and fields should not be empty
   if( $image_size > 0 &&
      !empty($product_name) || 
		!empty($product_price) || 
		!empty($product_image) || 
		!empty($product_description) || 
		!empty($product_categoryid)){
     $is_empty_file = false;
   } 
   
   #validation to check file extension name - png, jpg, jpeg, svg, gif
   if ($image_type == "png" ||
       $image_type == "jpg" ||
       $image_type == "jpeg" ||
       $image_type == "svg" ||
       $image_type == "gif"){
         $is_not_image = false;
       }
   
   #validation for files with similar file names
   if(!$is_not_image && !$is_empty_file){
     $image_destination = "./../assets/images/" .date("Y-m-d-h-i-s",time()). "$image_name";
     move_uploaded_file($image_tmpname,$image_destination);
     
      $sql_insert = "INSERT INTO products (name, price, image, description, category_id) 
                   VALUES ('$product_name', $product_price, '$image_name', '$product_description', $product_categoryid)";
      
      $insert = mysqli_query($conn,$sql_insert);
      header('location: ./../views/add_product.php');
     
   } else {
     echo "<h2> Upload Failed! </h2>";
   }
   
   
   
   
   
   
   // -------------------------------refactor-------------------------------//
   
   
   // if (                                             //fields should not be empty
	// 	empty($product_name) || 
	// 	empty($product_price) || 
	// 	empty($product_image) || 
	// 	empty($product_description) || 
	// 	empty($product_categoryid)
	// ){
	// 	// header('location: ./../views/add_product.php');
   //    echo ("dapat ndi blank");
      
   // } elseif ($image_size <= 0){                      //size must not be 0
   //    // header('location: ./../views/add_product.php');
   //    echo("file size kulang");
      
   // } elseif ($image_type != "png" ||                //file extension name should be png, jpg, jpeg, svg, gif ONLY!
   //           $image_type != "jpg" ||
   //           $image_type != "jpeg" ||
   //           $image_type != "svg" ||
   //           $image_type != "gif") {
   //    // header('location: ./../views/add_product.php');  
   //    echo ("extension type mo mali");
   //    var_dump($image_type);
           
   // } else {
   //    // echo ("boom pasok sa database");
      
   //    $image_destination = "assets/images/$image_name";
   //    move_uploaded_file($image_tmpname,$image_destination);
      
   //    $sql_insert = "INSERT INTO products (name, price, image, description) 
   //                 VALUES ('$product_name', $product_price, LOAD_FILE ('$image_name'), '$product_description', $product_categoryid)";
                  
   //    $insert = mysqli_query($conn,$sql_insert);
   // }                         
      
?>