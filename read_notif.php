<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"update users set status='0' where id = '".$_GET['id']."'");
                 
		  }
if(isset($_GET['accept']))
		  {
		          mysqli_query($con,"update users set status='1' where id = '".$_GET['id']."'");
                 
		  }

?>
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Patients | Appointment History</title>
		
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
		.modal_img{
			display: none;
			position: fixed;
			z-index: 1;
			padding-top: 100px;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgb(0,0,0);
			background-color: rgba(0,0,0,0.9);
		}

		.modal-content{
			margin: auto;
			margin-top: 50px;
			display: block;
			width: 80%;
			max-width: 700px;
			text-align: center;
			color: #ccc;
			padding: 10px 0;
			height: 80%;
		}

		.modal-content,#caption{
			-webkit-animation-name:zoom;
			-webkit-animation-duration:0.6s;
			animation-name: zoom;
			animation-duration: 0.6s;
		}
		@-webkit-keyframes zoom {
			from{-webkit-transform:scale(0)}
			to{-webkt-transform:scale(1)}
		}

		@keyframes zoom{
			from {transform: scale(0)}
			to {transform: scale(1)}
		}

		@media only screen and (max-width:700px){
			.modal-content{
				width: 100%
			}
		}
		.close{
			position: absolute;
			top: 2px;
			right:530px;
			color: #000000;
			font-size: 50px;
			font-weight: bold;
			transition: 0.3s;
		}

		.close:hover;
		.close:focus{
			color: #bbb;
			text-decoration: none;
			cursor: pointer;
		}
		.footer_close{
			margin-left: 945px;
			margin-top: 5px;
		}
	</style>	
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
									<h1 class="mainTitle">Patients  | Pending Registration</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>Patients </span>
									</li>
									<li class="active">
										<span>Pending Registration</span>
									</li>
								</ol>
							</div>
						</section>
						<form>
						<input type=button onClick="Javascript:window.location.href = 'http://localhost/CAPSTONE/oda_r1mc/send_mail.php';"  value='Send Email'>
					</form>
												<div class="container-fluid container-fullw bg-white">
						

									<?php  
$ret=mysqli_query($con,"select * from users");



 ?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  
    <th>#</th>
<th>Valid ID</th>
<th>Full Name</th>
<th>Address</th>
<th>Gender</th>
<th>Email</th>
<th>Date of Registration</th>
<th>Action</th>
<th>Result</th>
</tr>
<?php  
$cnt=1;
while ($row=mysqli_fetch_array($ret)) { 
  ?>
<tr>
  <td><?php echo $cnt;?></td>
  <td><img id="picture" src="uploads/<?php echo $row['image']; ?>" height="50" width="50"></td>
 <td><?php  echo $row['fullName'];?></td>
 <td><?php  echo $row['address'];?></td>
 <td><?php  echo $row['gender'];?></td> 
 <td><?php  echo $row['email'];?></td>
 <td><?php  echo $row['regDate'];?></td> 
 <td>
												<div class="visible-md visible-lg hidden-sm hidden-xs">
							<!--<button data-id='<?php echo $row['id']; ?>' class="view-data btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal"><i class="fa-solid fa-eye"></i></button> -->

							<a href="read_notif.php?id=<?php echo $row['id'];?>&accept=delete" onClick="return confirm('Are you sure you want to confirm this registration?')" class="btn btn-transparent btn-xs view_data" tooltip-placement="top" tooltip="View"><i class="fa-solid fa-check"></i></a>
													
	<a href="read_notif.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to decline this registration?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
												</div>

		<td>
		<?php	if(($row['status']==1))  
{
	echo "Registration <b>confirmed</b>";
}

if(($row['status']==0))  
{
	echo "Registration <b>declined</b>";
} 
if(($row['status']==NULL)) {
	echo "No action";
}

?>

		</td>
</tr>
<?php $cnt=$cnt+1;} ?>
</table>
                          
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
						
					
					</div>
				</div>
			</div>
	
	<div id="myModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Patient Registration Details</h4>  
                </div>  
                <div class="modal-body" id="patient_detail">  
                	
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
      <?php include('include/footer.php');?>
 </div> 
 

		
	
			
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



		<div id="imgModal" class="modal">
   

    <img class="modal-content" id="fullPicture">
    <div id="caption"></div>
    <a href="read_notif.php"><button class="footer_close btn btn-danger">Close</button></a>
</div>

<script>
    var modal=document.getElementById("imgModal");
    var img=document.getElementById("picture");
    var modalImg=document.getElementById("fullPicture");
    var captionText=document.getElementById("caption");

    img.onclick=function(){
    	modal.style.display="block";
    	modalImg.src=this.src;
    	captionText.innerHTML= this.alt;
    }
    
</script>
	
	</body>
</html>
