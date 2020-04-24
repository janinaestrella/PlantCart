<?php
   session_start();
   
   require_once 'connection.php';
   
   $_SESSION['email'] = $_POST['email'];
   $_SESSION['password'] = $_POST['password'];
   
   $email = $_SESSION['email'];
   $inputted_password = $_SESSION['password'];
   
   //select from table users using email
   $sql_select = "SELECT email, password FROM users WHERE email ='$email'";
   
   //connect query               
   $result = mysqli_query($conn, $sql_select);
   
   //to get selected data from user table
   $row = mysqli_fetch_assoc($result);   
   
   //to compare inputted password and hashed password from users table
   $password = password_verify($inputted_password , $row['password'] );           
                  
   //log in if match
   if ($password){
      header ("location: ./../views/home.php");
   } else {
      session_destroy();
      header ("location: ./../views/login.php"); //log in failed
   }


?>