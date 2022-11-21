<?php
include_once('include/config.php');
require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");

if(isset($_POST['submit']))
{

	$errors = array();
	    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $file_name = time() . '_' . $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        $extensions = array("jpeg", "jpg", "png", "gif");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
        }

       

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/" . $file_name);

          
            $fnameUp=$con->real_escape_string($_POST['full_name']);
			$addressUp=$con->real_escape_string($_POST['address']);
			$genderUp=$con->real_escape_string($_POST['gender']);
			$contact_nameUp=$con->real_escape_string($_POST['contact_name']);

			$fname=strtoupper($fnameUp);
			$address=strtoupper($addressUp);
			$gender=strtoupper($genderUp);
			$contact_name=strtoupper($contact_nameUp);
			
			$contact_no=$con->real_escape_string($_POST['contact_no']);
			$email=$con->real_escape_string($_POST['email']);
			$password=$con->real_escape_string(md5($_POST['password']));

			if (empty($fname)){
				$errors['fname']="Full name is required";
			}
			if (empty($address)){
				$errors['address']="Address is required";
			}
			if (empty($gender)){
				$errors['gender']="Gender is required";
			}
			if (empty($contact_name)){
				$errors['contact_name']="Emergency contact name is required";
			}
			if (empty($contact_no)){
				$errors['contact_no']="Emergency contact number is required";
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email']="Email address is invalid";
			}
			if (empty($email)){
				$errors['email']="Email is required";
			}
			if (empty($password)){
				$errors['password']="Password is required";
			}
			

            $sqlInsert = "INSERT INTO users(fullname,address,gender,contact_name,contact_no,email, password,image) VALUES ('" . $fname . "','" . $address . "', '".$gender."','".$contact_name."','".$contact_no."','".$email."','".$password."','".$file_name."')";
            $result = $con->query($sqlInsert);

            if ($result) {
                echo "<script>alert('Registration is currently pending. Please try again later. Thank you.');</script>";
            } else {
                echo "Error in file uploading";
            }
        } else {
            print_r($errors);
        }
    } else {
        echo "Error in file uploading";
    }
    $mailTo=$_POST['email'];
	$body="<h1>Email Registration Verification</h1></br></br><a href='http://localhost/CAPSTONE/oda_r1mc/users/user-login.php'>Click this link to verify your account.Thank you.</a>";

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

	$mail->Subject="ODA R1MC EMAIL REGISTRATION";
	$mail->Body=$body;
	$mail->AltBody="This is the plain text version of the email content.";

	if(!$mail->send()){
		echo "Mailer error:". $mail->ErrorInfo;
	}else{
		echo "<script>alert('An email has been sent to you for verification.Thank you.');</script>";;
	}


}

$con->close();
?>

<!--$fname=$_POST['full_name'];
$address=$_POST['address'];
$gender=$_POST['gender'];
$contact_name=$_POST['contact_name'];
$contact_no=$_POST['contact_no'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$file= addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
$query=mysqli_query($con,"insert into users(fullname,address,gender,contact_name,contact_no,email,password,image) values('$fname','$address','$gender','$contact_name','$contact_no','$email','$password','$file')");
if($query)
{
	echo "<script>alert('Registration is currently pending. Please wait for the approval of the admin. Thank you.');</script>";
	header('location:user-login.php');
}
}
?> !-->


<!DOCTYPE html>
<html lang="en">

	<head>
		<title>User Registration</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		
		<script type="text/javascript">
function valid()
{
 if(document.registration.password.value!= document.registration.password_again.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.registration.password_again.focus();
return false;
}
return true;
}
</script>
		

	</head>

	<body class="login">
		<a href="../index.php">
		<img src="images/oda_logo.png" style="height: 150px; width: 250px; margin-left: 671px; margin-top: 50px;">
		</a>
		
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				<a href="../index.html"><h2><center>Patient Registration</center></h2></a>
				</div>
				
				<div class="box-register">
					<form name="registration" id="registration" enctype="multipart/form-data"  method="post" onSubmit="return valid();">
						<fieldset>
							<legend>
								Sign Up
							</legend>
							<p>
								Enter your personal details below:
							</p>
							<div class="form-group">
								<input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="address" placeholder="Address" required>
							</div>
							<div class="form-group">
								<label class="block">
									Gender
								</label>
								<div class="clip-radio radio-primary">
									<input type="radio" id="rg-female" name="gender" value="female" >
									<label for="rg-female">
										Female
									</label>
									<input type="radio" id="rg-male" name="gender" value="male">
									<label for="rg-male">
										Male
									</label>
								</div>
							</div>

							<p>Please give atleast any one(1) valid ID.</p>
							<a href="https://philippineids.com/list-of-valid-ids-in-the-philippines/">List of Valid IDs</a>
							<input type="file" name="image" id="image">
							<p>
								Enter emergency contacts below:
							</p>
							<div class="form-group">
								<input type="text" class="form-control" name="contact_name" placeholder="Full Name" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="contact_no" placeholder="Contact no." required>
							</div>

							<p>
								Enter your account details below:
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()"  placeholder="Email" required>
									<i class="fa fa-envelope"></i> </span>
									 <span id="user-availability-status1" style="font-size:12px;"></span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control"  id="password_again" name="password_again" placeholder="Password Again" required>
									<i class="fa fa-lock"></i> </span>
							</div>
							
							<div class="form-actions">
								<p>
									Already have an account?
									<a href="user-login.php">
										Log-in
									</a>
								</p>
								<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
									Submit <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>

					<div class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> ODA R1MC</span>. <span>All rights reserved</span>
					</div>

				</div>

			</div>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
		
	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>	
		
	</body>
	
</html>