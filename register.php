<?php

$username= $_POST['username'];
$username=$_POST['username'];
$email  = $_POST['email'];
$password = $_POST['password'];
$password1 = $_POST['password1'];


if(strcmp($password, $password1)==0)
{
if (!empty($username) || !empty($email) || !empty($password) || !empty($password1) )
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $USER ="SELECT username FROM login Where username= ? LIMIT 1";
  $PASS="INSERT INTO login(username,password)values(?,?)";
  
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (username, email ,password, password1 )values(?,?,?,?)";

//Prepare statement
     $log = $conn->prepare($USER);
     $log->bind_param("s",$username);
     $log->execute();$log->store_result();

     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
$log = $conn->prepare($PASS);
      $log->bind_param("ss", $username,$password);
      $log->execute();






      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $username,$email,$password,$password1);
      $stmt->execute();
      echo "New record inserted sucessfully";
      header("location:index.html"); 
     } 
     else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
}
else{
  echo "Passwords dosen't match";
}
?>