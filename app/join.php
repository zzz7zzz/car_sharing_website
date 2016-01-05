<?php

if (!isset($_SESSION)) 
{
	session_start();
}	

include("function.php");

$conn=connDB();

$event_id = $_POST['EventID'];
$person_id = $_SESSION['id'];
$given_name = strtoupper($_SESSION['givenname']); 
$family_name = strtoupper($_SESSION['familyname']);

$departure_location;
$arrival_location;
$date_in_unix;
$departure_time;
$driver_or_rider = $_POST['DriverOrRider'];
$pay_amount = "TBA";

$duplicate_exist = $conn->query("SELECT * FROM RideList WHERE event_id = '$event_id' AND person_id = '$person_id'"); 

if (mysqli_num_rows($duplicate_exist) > 0) {
	header('Location: ../all_rides.php');
}

$select_from_RideList = $conn->query("SELECT * FROM RideList WHERE event_id = '$event_id' LIMIT 1"); 

if (mysqli_num_rows($select_from_RideList) > 0) {

	while ($row = mysqli_fetch_assoc($select_from_RideList)) {
		$departure_location = $row['departure_location'];
		$arrival_location = $row['arrival_location'];
		$date_in_unix = $row['Date'];
		$departure_time = $row['departure_time'];
	}

	$insert_in_RideList = "INSERT IGNORE into RideList VALUES('','$person_id','$event_id',
		'$departure_location','$arrival_location','$date_in_unix',
		'$departure_time','$driver_or_rider','$pay_amount','$given_name','$family_name')";

	if ($conn->query($insert_in_RideList)) {
	
	} else {
		echo "Error: " . $insert_in_RideList . "<br\>" . $conn->error;
		$conn->close();
	}

	$insert_in_Pax;
	if ($driver_or_rider == 'driver') {
	  $insert_in_Pax = "UPDATE Pax SET Pax=Pax+1, DriverFound=1 WHERE EventID = '$event_id'";
	} else {
	  $insert_in_Pax = "UPDATE Pax SET Pax=Pax+1 WHERE EventID = '$event_id'";
	}
	
	if ($conn->query($insert_in_Pax)) {
	
	} else {
		echo "Error: " . $insert_in_Pax . "<br\>" . $conn->error;
		$conn->close();
	}

	$insert_in_PeopleInRide = "INSERT IGNORE into PeopleInRide VALUES('$event_id','$person_id')";
	
	if ($conn->query($insert_in_PeopleInRide)) {
	
	} else {
		echo "Error: " . $insert_in_PeopleInRide . "<br\>" . $conn->error;
		$conn->close();
	}
	
	if ($driver_or_rider == 'driver') {
			//$driverFound = "YES";
			echo'<tr><td class="name">'.$given_name.' '.$family_name.' (driver)</td>';
			echo'<td class="pay">Fee: $'.$pay_amount.'</td></tr>';
		} else {
			echo'<tr><td class="name">'.$given_name.' '.$family_name.'</td></tr>';
		}
}
$conn->close();
?>