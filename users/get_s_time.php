<?php
include('include/config.php');
if(!empty($_POST["date"])) 
{

 $sql=mysqli_query($con,"SELECT s_time FROM doctors WHERE id='".$_POST['date']."'");
 while($row=mysqli_fetch_array($sql))
 	{?>
 <option value="<?php echo htmlentities($row['s_time']); ?>"><?php echo htmlentities($row['s_time']); ?></option>

  <?php

}
}

?>

