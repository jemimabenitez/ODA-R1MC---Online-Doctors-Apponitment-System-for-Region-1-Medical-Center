<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$birthdate=$_POST['birthdate'];
	$age=$_POST['age'];
	$address=$_POST['address'];
	$email=$_POST['email'];
$sql=mysqli_query($con,"Update admin set name='$name',birthdate='$birthdate',age='$age', address='$address' email='$email' where id='".$_SESSION['id']."'");
if($sql)
{
echo "<script>alert('Admin profile updated successfully!');</script>";

}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Update Profile</title>
		
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
									<h1 class="mainTitle">Admin | Update Profile</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Update Profile</span>
									</li>
								</ol>
							</div>
						</section>
					
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Update Profile</h5>
												</div>
												<div class="panel-body">
									<?php $sql=mysqli_query($con,"select * from admin where id='".$_SESSION['id']."'");
while($data=mysqli_fetch_array($sql))
{
?>
<h4>Admin's Profile</h4>
<p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']);?></p>

<hr />
													<form role="form" name="adddoc" method="post" onSubmit="return valid();">
														

<div class="form-group">
															<label for="doctorname">
																 Name
															</label>
	<input type="text" name="name" class="form-control" value='<?php echo htmlentities($data['name']);?>' >
														</div>
<div class="form-group">
															<label for="doctorname">
																 Email Address
															</label>
	<input type="text" name="email" class="form-control" value='<?php echo htmlentities($data['email']);?>' >
														</div>


	
<div class="form-group">
									<label for="fess">
																 Birthdate
															</label>
					<input type="date" name="birthdate" class="form-control" required="required"  value="<?php echo htmlentities($data['birthdate']);?>">
														</div>

<div class="form-group">
									<label for="fess">
																 Age
															</label>
					<input type="number" name="age" class="form-control"  required="required"  value="<?php echo htmlentities($data['age']);?>">
														</div>

<div class="form-group">
									<label for="fess">
																 Address
															</label>
					<input type="text" name="address" class="form-control"  required="required"  value="<?php echo htmlentities($data['address']);?>">
														</div>
<div class="form-group">
									<label for="fess">
																 Username
															</label>
					<input type="email" name="uemail" class="form-control"  readonly="readonly"  value="<?php echo htmlentities($data['username']);?>">
					<a href="change-username.php">Update your username</a>
														</div>


														
													
														
														
														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Update
														</button>
													</form>
													<?php } ?>
												</div>
											</div>
										</div>
											
											</div>
										</div>
									
								</div>
							
						
						
					</div>
				</div>
			</div>
		
	<?php include('include/footer.php');?>
			
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
		</script>
		  <script type="text/javascript">
            $('#timepicker1').timepicker();
        </script>
        </script>
		  <script type="text/javascript">
            $('#timepicker2').timepicker();
        </script>
	
	</body>
</html>
