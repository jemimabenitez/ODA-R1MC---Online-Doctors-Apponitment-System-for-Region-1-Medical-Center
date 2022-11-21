<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();


if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from doctors where id = '".$_GET['id']."'");
                  $_SESSION['msg']="data deleted !!";
		  }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Manage Doctors</title>
		
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

		<style>
		.addDoctor {
			float: left;
			margin-top: 30px;
			background-color: DodgerBlue;
			border: none;
			color: white;
			padding: 12px 16px;
			font-size: 13px;
			cursor: pointer;
		}

		.addDoctor:hover {
			background-color: RoyalBlue;
}

		form{
			margin: 10px 0 10px 47px;
			
		}
		</style>
	</head>
	<body>
		<div id="app">	
			<?php include('include/sidebar.php');?>	
				div class="app-content">
				
						<?php include('include/header.php');?>
					
			
				<div class="main-content" >

					
					<div class="wrap-content container" id="container">
					
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">| Search Doctors</h1>
																	</div>
								
							</div>

								<form action="" method="GET">
										<div class="input-group mb-3">
											<input type="text" required name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?> ">
											<button type="submit" class="btn btn-primary">Search</button>
										</div>
									</form>
								<div class="container-fluid container-fullw bg-white">
									
									

									<table class="table table-hover" id="sample-table-2">
				<thead>
					<tr>
						<th class="center">#</th>
						<th>Specialization</th>
						<th class="hidden-xs">Doctor Name</th>
						<th>Contact No.</th>
						<th>Email Address</th>
						<th>Creation Date </th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
						$con=mysqli_connect("localhost", "root", "", "oda_r1mc");

						if (isset($_GET['search'])){
							$filtervalues=$_GET['search'];
							$query="SELECT * FROM doctors WHERE CONCAT (specilization, doctorName, contactno, docEmail) LIKE '%$filtervalues%'";
							$count=1;
							$query_run=mysqli_query($con, $query);

							if (mysqli_num_rows($query_run)>0){
								foreach ($query_run as $items) {
									?>
										<tr>
											<td class="center"><?php echo $count;?>.</td>
											<td><?= $items['specilization'] ?></td>
											<td><?= $items['doctorName'] ?></td>
											<td><?= $items['contactno'] ?></td>
											<td><?= $items['docEmail'] ?></td>
											<td><?= $items['creationDate'];?>
											<td >
												<div class="visible-md visible-lg hidden-sm hidden-xs">
													<a href="edit-doctor.php?id=<?php echo $row['id'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a>
													
													<a href="manage-doctors.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
												</div>
												
												<div class="visible-xs visible-sm hidden-md hidden-lg">
													<div class="btn-group" dropdown is-open="status.isopen">
														<button type="button" class="btn btn-primary btn-o btn-sm dropdown-toggle" dropdown-toggle>
															<i class="fa fa-cog"></i>&nbsp;<span class="caret"></span>
														</button>
														
														<ul class="dropdown-menu pull-right dropdown-light" role="menu">
															<li>
																<a href="#">
																	Edit
																</a>
															</li>
															<li>
																<a href="#">
																	Share
																</a>
															</li>
															<li>
																<a href="#">
																	Remove
																</a>
															</li>
														</ul>
													</div>
												</div>
											</td>
										</tr>
										
<?php 
$count=$count+1;
											 ?>
									
									<?php
								}}
							else{
								?>
									<tr>
										<td colspan="7"><center>No record found</center></td>
									</tr>
								<?php
								
							}
						
}
						
					?>

					
				</tbody>
			</table>

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
		
	</body>
</html>
