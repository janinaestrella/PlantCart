<?php 
   require_once './connection.php';

   session_start();

   //session cart is an associative array. Using JOIN, it will put the array to a string
   // separated by a comma (,)
   $product_id = join(",",array_keys($_SESSION['cart']));

   //IN is used to check from a range of selection in product_id
   $sql_query_products = "SELECT * FROM products WHERE id IN ($product_id)";
   $result = mysqli_query($conn, $sql_query_products);
   
   $total = 0;

   while ($row = mysqli_fetch_assoc($result)){
      $subtotal = $row['price'] * $_SESSION['cart'][$row['id']]; //DI KO TO GETS
      $total += $subtotal;
   }

   // var_dump ($_SESSION['cart']);
   // var_dump ($row['id']);
   // echo ($subtotal);
   // echo $_POST['orderID'];

   //Transactions table:
   $transaction_code =  $_POST['orderID']; //"transaction code";
   $user_id = $_SESSION['user']['id'];
   $payment_mode_id = 3; //hardcoded for paypal
   $status_id = 1; 

   $sql_insert_transaction_query = "INSERT INTO transactions (
                                                transaction_code,
                                                total, 
                                                user_id,
                                                payment_mode_id,
                                                status_id )
                                          VALUES (
                                                '$transaction_code',
                                                $total,
                                                $user_id,
                                                $payment_mode_id,
                                                $status_id)";
   
   $result_insert_transaction_query = mysqli_query($conn, $sql_insert_transaction_query);

   $transaction_id = mysqli_insert_id($conn);

   $array_entries = [];
   
   foreach ($_SESSION['cart'] as $id => $quantity) {
      $array_entries[] = "($transaction_id, $id, $quantity)";
   } 

   $values = join(",", $array_entries);

   //to entries to pivot table
   $insert_pivot_query = "INSERT INTO product_transactions (
                                 transaction_id,
                                 product_id,
                                 quantity )
                           VALUES $values";

   // INSERT INTO product_transactions (transaction id, id, quantity)
	// VALUES (4,1,4),(4,2,3)                        
   
   $result = mysqli_query($conn, $insert_pivot_query);

   //at the event of clear cart
   unset($_SESSION['cart']);

   header ("location: ./../views/transactions.php");





?>