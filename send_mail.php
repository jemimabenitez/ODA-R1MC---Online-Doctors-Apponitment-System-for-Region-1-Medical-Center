<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");


	if(isset($_POST['send'])){


	$mailTo=$_POST['email'];
	$body=$_POST['body'];

	$mail=new PHPMailer\PHPMailer\PHPMailer();
	
	
	
	$mail->isSMTP();

	$mail->Host="mail.smtp2go.com";

	$mail->SMTPAuth=true;

	$mail->Username="odar1mc";
	$mail->Password="jemimakesia";

	$mail->SMTPSecure="tls";
	$mail->Port="2525";

	$mail->From="odar1mcadmin@gmail.com";
	$mail->FromName="ODA R1MC ADMIN";

	$mail->addAddress($mailTo, "Patient");

	$mail->isHTML(true);

	$mail->Subject="ODA R1MC REGISTRATION";
	$mail->Body=$body."<a href='http://localhost/CAPSTONE/oda_r1mc/send_mail.php'>Google</a>";
	$mail->AltBody="This is the plain text version of the email content.";

	if(!$mail->send()){
		echo "Mailer error:". $mail->ErrorInfo;
	}else{
		echo "<script>alert('Email has been sent!');</script>";;
	}

}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Send Email</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		
	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
			<div class="app-content">
				

					<?php include('include/header.php');?>
			
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin  | Send Email</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin </span>
									</li>
									<li class="active">
										<span>Send Email</span>
									</li>
								</ol>
							</div>
						</section>
		<div class="container-fluid container-fullw bg-white">
			<form method="post">
		<label>Email To:</label>
		<input type="email" name="email" id="email">

		<label>Body</label>
		<textarea name="body" cols="30" rows="10"></textarea>

		<button type="submit" name="send">Send email</button>
	</form>
		</div>
		
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
	
		<script src="assets/js/main.js"></script>
	
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
	
	</body>
</html>
