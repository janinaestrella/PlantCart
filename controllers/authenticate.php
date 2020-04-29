<?php
   session_start();
   
   require_once 'connection.php';
   
   //catch the input from the login form. 
	$email = $_POST['email']; 
	$password = $_POST['password'];

	//search query 
	$user_query = "SELECT * FROM users WHERE email = '$email'"; 

	$result = mysqli_query($conn, $user_query); 
 	$user_info = mysqli_fetch_assoc($result); 

 	//password_verify compares a NON HASHED password to a HASHED password. 
 	if(password_verify($password, $user_info['password'])){
 		$_SESSION['user'] = $user_info; 
 		header('location: ./../views/home.php');

 	}else {
 		header("location: ./../views/login.php");
    }
    
   // $_SESSION['email'] = $_POST['email'];
   // $_SESSION['password'] = $_POST['password'];
   
   // $email = $_SESSION['email'];
   // $inputted_password = $_SESSION['password'];
   
   // //select from table users using email
   // $sql_select = "SELECT email, password FROM users WHERE email ='$email'";
   
   // //connect query               
   // $result = mysqli_query($conn, $sql_select);
   
   // //to get selected data from user table
   // $row = mysqli_fetch_assoc($result);   
   
   // //to compare inputted password and hashed password from users table
   // $password = password_verify($inputted_password , $row['password'] );           
                  
   // //log in if match
   // if ($password){
   //    header ("location: ./../views/home.php");
   // } else {
   //    session_destroy();
   //    header ("location: ./../views/login.php"); //log in failed
   // }


?>