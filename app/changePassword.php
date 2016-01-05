<?php
session_start();

include("function.php");
$conn=connDB();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$userID = $_SESSION['id'];

$oldPassword = md5($_POST['Old_password']);
$newPassword = md5($_POST['New_password']);

$sql = "UPDATE info SET Password='$newPassword' WHERE UserID='$userID' AND Password='$oldPassword'";
$accountMatch =mysqli_query($conn, $sql);


if ($conn->query($accountMatch) === TRUE) {
	
	$conn->close();
   // echo "Account deleted successfully";
   
	 header('Location: logout.php');
} else {
	$conn->close();
   // echo "Error deleting record: " . $conn->error;
	 header('Location: ../settings.php?err=1');
}

?>

