<?php
$username= $_POST['username'];
$password = $_POST['password'];
if (!empty($username)  || !empty($password)  )
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test";
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}else{
	$SELECT ="SELECT password FROM login Where username = '$username' " ;
	$stmt = $conn->prepare($SELECT);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	$data=$stmt_result->fetch_assoc();}

	if($data['password'] == $password)
	{
		header("location:home.html");
	}else{
		echo "your password is wrong";
	}
}



?>