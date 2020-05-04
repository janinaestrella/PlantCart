<?php
   // require PHP Mailer;
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
      require './../vendor/autoload.php';

   session_start();
   // die(var_dump($_SESSION));

   //to check if user is logged in when making a transaction
   if (!isset($_SESSION['user'])){
      //if session is empty then redirect to login page
      header ("location: ./../views/login.php");
   
   }

   $total = 0;
   $product_id = join (",", array_keys($_SESSION['cart']));

   require_once './connection.php';
   // die(var_dump($_SESSION['user']));

   $sql_select_query = "SELECT * FROM products WHERE id IN ($product_id)";
   $result = mysqli_query($conn, $sql_select_query);

   while ($product = mysqli_fetch_assoc($result)){
      $subtotal = $product['price'] * $_SESSION['cart'][$product['id']];
      $total += $subtotal;
   }

   // get customer details and transaction details
   $transaction_code = generateTransactionCode();
   $user_id = $_SESSION['user']['id'];
   $status_id = 1;

   //get type of payment mode from cart.php
   $payment_mode_id = $_POST['payment-mode'];
   // die(var_dump($_POST));

   function generateTransactionCode(){
      $transaction_code = "";
      $chars = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F'];

      for ($i = 0; $i < 5; $i++){
         $index = rand(0,15);

         $transaction_code = $transaction_code . $chars[$index];
      }

      $transaction_code = $transaction_code . getdate()[0];
      return $transaction_code;
   }

   //query to add transaction details inside transactions table
   $sql_add_transaction = "INSERT INTO transactions (
                                       transaction_code,
                                       
                                       total,
                                       user_id,
                                       status_id,
                                       payment_mode_id )
                              VALUES ( '$transaction_code',
                                        $total,
                                        $user_id,
                                        $status_id,
                                        $payment_mode_id )";
                                       
   $result = mysqli_query($conn, $sql_add_transaction);
   
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
   
   $result = mysqli_query($conn, $insert_pivot_query);

   // =================================================
   // Start of SMTP
   // =================================================

		// start of sending email to customer
		// Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
         // Server settings
         $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
         $mail->isSMTP();                                            // Send using SMTP
         $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
         $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
         $mail->Username   = 'phpmailert3st3r@gmail.com';            // SMTP username
         $mail->Password   = 'walongaskterisk';                      // SMTP password
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
         $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

         // Recipients
         $mail->setFrom('phpmailert3st3r@gmail.com', 'Deli Club');
         $mail->addAddress('joe@example.net', 'Joe User');           // Add a recipient
         $mail->addAddress('wigil76120@mailop7.com');                // Name is optional
         // $mail->addReplyTo('info@example.com', 'Information');
         // $mail->addCC('cc@example.com');
         // $mail->addBCC('bcc@example.com');

         // Attachments
         // $mail->addAttachment('/var/tmp/file.tar.gz');               // Add attachments
         // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');          // Optional name

         // Content
         $mail->isHTML(true);                                  // Set email format to HTML
         $mail->Subject = 'Thank you for purchasing our products!';
         $mail->Body    = '<h1>Your Transaction Code is <strong>{$transaction_code}</strong></h1>';
         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

         $mail->send();
         echo 'Message has been sent';
      } catch (Exception $e) {
         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

   // ================================================
   // End of SMTP
   // ================================================
      
   //at the event of clear cart
   unset($_SESSION['cart']);

   header ("location: ./../views/transactions.php");
   
?>