<?php 
	error_reporting(0);
	$sql_get=mysqli_query($con, "SELECT * FROM appointment WHERE userStatus='1' && doctorStatus='1' && doctorId='".$_SESSION['id']."' ");
	$count=mysqli_num_rows($sql_get);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<body>
<header class="navbar navbar-default navbar-static-top">
					<!-- start: NAVBAR HEADER -->
					<div class="navbar-header">
						<a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
							<i class="ti-align-justify"></i>
						</a>
						<a class="navbar-brand" href="#">
							<h2 style="padding-top:20% ">ODA R1MC</h2>
						</a>
						<a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
							<i class="ti-align-justify"></i>
						</a>
						<a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<i class="ti-view-grid"></i>
						</a>
					</div>
					<!-- end: NAVBAR HEADER -->
					<!-- start: NAVBAR COLLAPSE -->
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-right">
							<!-- start: MESSAGES DROPDOWN -->
								<li  style="padding-top:2% ">
								<h2>Online Doctors Appointment</h2>
							</li>
						
							<li class="dropdown notif">
									<a href class="dropdown-toggle" data-toggle="dropdown" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="fa-solid fa-bell"><span class="badge badge-light"><?php echo $count; ?></span></i>
										<i class="ti-angle-down"></i></i></span>
										<div class="dropdown-menu dropdown-dark" aria-labelledby="navbarDropdown">
										<?php
												$sql_get1=mysqli_query($con, "SELECT * FROM appointment WHERE userStatus='1' && doctorStatus='1' && doctorId='".$_SESSION['id']."'");

												if (mysqli_num_rows($sql_get1)>0){
													while ($result=mysqli_fetch_assoc($sql_get1)) {
														echo '<a class="dropdown-item" style="color:white;" href="read_notif.php?id='.$result['id'].'">'.$result['userId'].'</a>';
														echo '<div class="dropdown-divider"></div>';
													}
												}else{

												 echo '<a class="dropdown-item text-danger font-weight-bold" href="#">No pending request.</a>';
												}
											?>	
											

										</div>
								</li>
							<li class="dropdown current-user">
								<a href class="dropdown-toggle" data-toggle="dropdown">
									<img src="assets/images/images.jpg" > <span class="username">



									<?php $query=mysqli_query($con,"select doctorName from doctors where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
	echo $row['doctorName'];
}
									?> <i class="ti-angle-down"></i></i></span>
								</a>
								<ul class="dropdown-menu dropdown-dark">
									<li>
										<a href="read-notif.php">
											Notification Center
										</a>
									</li>

									<li>
										<a href="edit-profile.php">
											My Profile
										</a>
									</li>
								
									<li>
										<a href="change-password.php">
											Change Password
										</a>
									</li>
									<li>
										<a href="logout.php">
											Log Out
										</a>
									</li>
								</ul>
							</li>
							<!-- end: USER OPTIONS DROPDOWN -->
						</ul>
						<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
						<div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
							<div class="arrow-left"></div>
							<div class="arrow-right"></div>
						</div>
						<!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
					</div>
				
					
					<!-- end: NAVBAR COLLAPSE -->
				</header>

</body>
</html>
