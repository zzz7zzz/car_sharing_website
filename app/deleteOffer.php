<?php
if (!isset($_SESSION)) 
{
	session_start();
}

if (isset($_POST['DriverEventID'])) 
{
	$DriverEventID = $_POST['DriverEventID'];
	$DriverID = $_SESSION['id'];

	include "function.php";
	$conn = connDB();

	$sql = "DELETE from PendingRides WHERE EventID='$DriverEventID'";

	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record in PR: " . $conn->error;
	}
	$conn->close();

	$conn = connDB();
	$sql = "DELETE from ConfirmedRides WHERE EventID='$DriverEventID'";

	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record in AR: " . $conn->error;
	}
	$conn->close();

	$conn = connDB();
	$sql = "DELETE from DriverOffers WHERE DriverEventID='$DriverEventID'";

	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}
	$conn->close();

	// Trying to add stuff to RejectedRides Table
	// $conn = connDB();
	// $sql = "Select * from RiderRequest WHERE DriverEventID='$DriverEventID'";
	// $result = $conn->query($sql);
	// 
	// $RiderID = array();
	// $RiderEventID = array();
	// if (mysqli_num_rows($result) > 0)
	// {
	// 	while ($row = mysqli_fetch_array($sql))
	// 	{
	// 		 array_push($RiderID,$row['RiderID']);
	// 		 array_push($RiderEventID,$row['RiderEventID']);
	// 	}
	// }
	// $conn->close();
	// 
	// $conn = connDB();
	// $index = 0;
	// foreach ($RiderID as $stuff)
	// {
	// 	$sql = "Insert into RejectedRides VALUES('".$RiderEventID[$index]."','$DriverEventID','".$RiderID[$index]."','".$DriverID."')";
	// 	echo $sql;
	// 	$conn->query($sql);
	// 	$index++;
	// }  
	// 
	// $conn->close();


	// Not logically perfect. Should check accepted rides to store array of RiderEventID.
	$conn = connDB();
	$sql = "UPDATE RiderRequest SET Fulfilled=Fulfilled-1 WHERE RiderEventID='$DriverEventID'";

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}

	$conn->close();
	
} else if (isset($_POST['RiderEventID'])) {
	$RiderEventID = $_POST['RiderEventID'];
	$RiderID = $_SESSION['id'];

	include "function.php";
	$conn = connDB();

	$sql = "DELETE from PendingRides WHERE EventID='$RiderEventID'";

	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record in PR: " . $conn->error;
	}
	$conn->close();
	
	$conn = connDB();
	$sql = "DELETE from ConfirmedRides WHERE EventID='$RiderEventID'";

	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record in AR: " . $conn->error;
	}
	$conn->close();
	
	$conn = connDB();
	$sql = "DELETE from RiderRequest WHERE RiderEventID='$RiderEventID'";

	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}
	$conn->close();

} else {
	echo "<div>Not supposed to reach here!</div>";
}
?>
