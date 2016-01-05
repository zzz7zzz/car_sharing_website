<?php
session_start();

include("function.php");
$conn=connDB();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// echo "hi"; 
$userID = $_SESSION['id'];
// echo "userID";
// echo $userID;
$checkPassword = md5($_POST['checkAcctPassword']);


$accountMatch =mysqli_query($conn, "SELECT * FROM info WHERE UserID='$userID' LIMIT 1");

if ($accountMatch)
{
	if (mysqli_num_rows($accountMatch) > 0)
	{
		while ($row = mysqli_fetch_assoc($accountMatch))                                       //check if hashpw match old pwd
        {
        	if ($row['Password'] == $checkPassword)
        	{
        		$sql = "DELETE FROM info WHERE UserID='$userID'";
        		
        		if ($conn->query($sql) === TRUE) {
        			
        			$conn->close();
				   // echo "Account deleted successfully";
				   
					 header('Location: logout.php');
				} else {
					$conn->close();
				   // echo "Error deleting record: " . $conn->error;
					 header('Location: ../settings.php?err=2');
				}
	
        	} else {
        		header('Location: ../settings.php?err=2');
        	}
        }
	}
}
?>

