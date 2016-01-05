<?php

session_start();

include "function.php";
$conn=connDB();

$RiderID = $_POST['RiderID'];
// $RiderEventID = $_POST['RiderEventID'];
$EventIT = $_POST['EventID'];
$DriverID = $_POST['DriverID'];
// $DriverEventID = $_POST['DriverEventID'];
$WhoRequestThis = $_POST['WhoRequestThis'];

$results = $conn->query("Select * from PendingRides WHERE EventID='$EventID'");

// if($results === TRUE){ // there are results


	if(mysqli_num_rows($results) > 0){
		echo "Duplicate";
		$conn->close();
	}else{
		$conn->close();

		$conn=connDB();
		$results = $conn->query("INSERT into PendingRides VALUES ('$EventID'
					,'$RiderID','$DriverID','$WhoRequestThis')");

		if($results === FALSE){
			echo 'Error : ('. $mysqli->errno .') '. $mysqli->error;
			echo "hi ya 1";
		} else {

		$conn->close();
	
		}
	}
// } else {
// 	$conn->close();
// 
// 	$conn=connDB();
// 	$results = $conn->query("INSERT into PendingRides VALUES ('$RiderEventID', '$DriverEventID'
// 				,'$RiderID','$DriverID','$WhoRequestThis')");
// 
// 	if($results === FALSE){
// 		echo 'Error : ('. $mysqli->errno .') '. $mysqli->error;
// 		echo "hi ya 2";
// 		$conn->close();
// 	} else {
// 
// 		$conn->close();
// 	
// 	}
// }
?>

