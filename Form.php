<?php
$con=mysqli_connect('localhost','root','password','student');

if(isset($_REQUEST['submit']))
{
	if(($_REQUEST['rollno'])=='' && ($_REQUEST['name'])=='' && ($_REQUEST['city'])=='' && ($_REQUEST['mobile'])=='')
	{
		echo "<script>alert('fill all the records');</script>";
	}
	else
	{
		$rollno=$_REQUEST['rollno'];
		$name=$_REQUEST['name'];
		$city=$_REQUEST['city'];
		$mobile=$_REQUEST['mobile'];
		$result=mysqli_query($con,"INSERT INTO student (rollno,name,city,mobile) VALUE('$rollno','$name','$city','$mobile')");
	}
}
if(isset($_REQUEST['delete'])) 
{
	$rollno=$_REQUEST['rollno'];
	
	$result=mysqli_query($con,"DELETE FROM student WHERE rollno={$rollno}");
	
}
if(isset($_REQUEST['update']))
{
	if(($_REQUEST['rollno'])=='' && ($_REQUEST['name'])=='' && ($_REQUEST['city'])=='' && ($_REQUEST['mobile'])=='')
	{
		echo "<script>alert('fill all the records');</script>";
	}
	else
	{
		$rollno=$_REQUEST['rollno'];
		$name=$_REQUEST['name'];
		$city=$_REQUEST['city'];
		$mobile=$_REQUEST['mobile'];
	
	$sql="UPDATE student SET rollno='$rollno',name='$name',city='$city',mobile='$mobile' WHERE rollno={$_REQUEST['rollno']}";
	$result=mysqli_query($con,$sql);
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fetch Database</title>
	<link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/all.min.css">
</head>
<body>
	<br>
<div class="container-fluid">
	<?php
		if(isset($_REQUEST['update']))
		{
			$sql="SELECT * FROM student WHERE rollno={$_REQUEST['rollno']}";
			$result=mysqli_query($con,$sql);
			$row=mysqli_fetch_assoc($result);
		}
	?>
	<form method="POST" class="col-md-5 text-center" action="">
		<h4>Form</h4>
		<input type="text" name="rollno" class="form-control" placeholder="Enter your rollno" value="<?php if(isset($row["rollno"])){
			echo $row["rollno"];
		}?>"><br>
		<input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?php if(isset($row["name"])){
			echo $row["name"];
		}?>"><br>
		<input type="text" name="city" class="form-control" placeholder="Enter your city" value="<?php if(isset($row["city"])){
			echo $row["city"];
		}?>"><br>
		<input type="text" name="mobile" class="form-control" placeholder="Enter your mobile" value="<?php if(isset($row["mobile"])){
			echo $row["mobile"];
		}?>"><br>
		<input type="submit" name="submit" class="btn btn-danger">
		<input type="submit" name="update" class="btn btn-danger" value="update">
		<input type="reset" name="reset" value="Reset" class="btn btn-danger">
	</form>
	<div class="col-md-7">
		<h4 class="text-center">Table</h4>
	<?php
		$sql="SELECT * FROM student";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result) > 0){
		echo "<table class='table table-bordered table-condensed table-striped text-center'>";
		echo "<thead>";
		echo "<td>Rollno</td>";
		echo "<td>Name</td>";
		echo "<td>City</td>";
		echo "<td>Mobile</td>";
		echo "<td>Action</td>";
		echo "</thead>";
		echo "<tbody>";
		 while ($row=mysqli_fetch_assoc($result)) {
		 	echo "<tr>";
		 	echo "<td>".$row['rollno']."</td>";
		 	echo "<td>".$row['name']."</td>";
		 	echo "<td>".$row['city']."</td>";
		 	echo "<td>".$row['mobile']."</td>";
		 	echo "<td>
		 	<form action='' method='POST'>
		 	<input type='hidden' name='rollno' value='".$row['rollno']."'>
		 	<input type='hidden' name='name' value='".$row['name']."'>
		 	<input type='hidden' name='city' value='".$row['city']."'>
		 	<input type='hidden' name='mobile' value='".$row['mobile']."'>
		 	<button type='submit' name='update' class='btn btn-danger'><i class='far fa-edit'></i>&nbsp;&nbsp;Update</button>
		 	<button type='submit' name='delete' class='btn btn-danger'><i class='far fa-trash-alt'></i>&nbsp;&nbsp;Delete</button>

		 	</form></td>";
		 	echo "</tr>";
		 }
		echo "</tbody>";
		echo "</table>";
		}
		else
		{
			echo "<br><br><br><h4 class='text-center'>No Data Found</h4>";
		}
	?>
</div>
</div>
</body>
</html>