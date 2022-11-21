<?php
	session_start();
	include('include/config.php');

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name,$get_email,$token){

	$mail= new PHPMailer(true);                      //Enable verbose debug output
    $mail->isSMTP(); 
    $mail->SMTPAuth   = true;  
                                               //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     
    $mail->Username   = 'kesiabenitez31@gmail.com';                     //SMTP username
    $mail->Password   = 'prettyjemimakesia@31';   
                                //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('kesiabenitez31@gmail.com', '$get_name');
    $mail->addAddress($get_email);  
       //Add a recipient
    $mail->isHTML(true);
    $mail->Subject="Reset Password Notification";

    $email_template="
    	<h2>Hello</h2>
    	<h3>You are receiving this email because we received a password reset request for your account.</h3>
    	<br/><br/>
    	<a href='http://localhost/'>Click this</a>
    ";

    $mail->Body=$email_template;
    $mail->send();

    

}




	if(isset($_POST['reset'])){
		$email=mysqli_real_escape_string($con, $_POST['email']);
		$token= md5(rand());

		$check_email= "SELECT email FROM admin WHERE email='$email' LIMIT 1";
		$check_email_run= mysqli_query($con, $check_email);

		if(mysqli_num_rows($check_email_run)>0){
			$row=mysqli_fetch_array($check_email_run);
			$get_name=$row['name'];
			$get_email=$row['email'];

			$update_token= "UPDATE admin SET verify_token='$token' WHERE email='$get_email' LIMIT 1 ";
			$update_token_run=mysqli_query($con, $update_token);

			if ($update_token_run){
				send_password_reset($get_name, $get_email, $token);
				$_SESSION['status']= "We e-mailed you a password reset link.";
				header("Location: forgot-password.php");
				exit(0);

			}else{
				$_SESSION['status']= "Something went wrong. #1";
				header("Location: forgot-password.php");
				exit(0);
			}

		}else{
			$_SESSION['status']= "No Emal Found";
			header("Location: forgot-password.php");
			exit(0);
		}
	}

?>