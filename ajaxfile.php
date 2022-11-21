<?php
	include "include/config.php";

	$userid=$_POST['userid'];
	$sql="select * from users where id=".$userid;
	$result=mysqli_query($con, $sql);
	while ($row=mysqli_fetch_array($result)){
		?>

		<table border='0' width='100%'>
			<tr>
				<td width="300"><img src="uploads/<?php echo $row['image']; ?>">
				<td style="padding:20px;">
					<p>Full Name: <?php echo $row['fullName']; ?></p>
					<p>Address: <?php echo $row['address']; ?></p>
					<p>Gender: <?php echo $row['gender']; ?></p>
					<p>Contact Name: <?php echo $row['contact_name']; ?></p>
					<p>Contact No.: <?php echo $row['contact_no']; ?></p>
					<p>Email: <?php echo $row['email']; ?></p>
				</td>
			</tr>
			
		</table>
	<?php }

?>