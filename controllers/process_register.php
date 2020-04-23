<?php
   require_once 'connection.php';
   
   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $confirm_password = $_POST['confirm_password'];
   $role_id = 2;
   
   $sql_select = "SELECT * FROM user WHERE email = '$email'";
   $find_email = mysqli_query($conn, $sql_select);
   
   if (                                             //to validate if fields are not empty
		empty($firstname) || 
		empty($lastname) || 
		empty($email) || 
		empty($password) || 
		empty($confirm_password)
	){
		header('location: ./../views/register.php');
		
	} elseif ($password != $confirm_password){   	//to validate if password and confirm_password are not matched
		header('location: ../views/register.php');
      
	} elseif (mysqli_num_rows($find_email) > 0){  	// to validate if there are no duplicate emails
		// echo mysqli_error($find_email);													  
		header('location: ./../views/register.php');
		
	} else {
		$password = password_hash($password, PASSWORD_BCRYPT);  //to encrypt password
		$sql_insert = "INSERT INTO users (firstname, lastname, email, password, role_id) 
               VALUES ('$firstname', '$lastname', '$email', '$password', '$role_id')";
		
      if (mysqli_query($conn, $sql_insert)) {
			header('location: ./../views/login.php');   //successfully save in database
			
		} else {
			// echo "Error: " . mysqli_error($sql_query);
			header('location: ./../views/register.php');
			
		}
	}

   
?>

