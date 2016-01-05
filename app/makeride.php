<?php

if (!isset($_SESSION)) 
{
	session_start();
}	

include("function.php");

$conn=connDB();

if (!$conn->set_charset('utf8')) {
    printf("Error loading character set utf8: %s\n", $conn->error);
} 
// getdate = Sun Jan 04 2015 00:00:00 GMT-0500 (EST)
// gettime = 1420347600000;
$person_id = $_SESSION['id'];
$event_id = microtime(true); //Generate Event Id Using Unix Time
$departure_location = $conn->real_escape_string($_POST['departure_location']);
$arrival_location = $conn->real_escape_string($_POST['arrival_location']);
$date_in_unix = strtotime($_POST['date']);
$departure_hour = $conn->real_escape_string($_POST['hour']);
$departure_min = $conn->real_escape_string($_POST['min']);
// $departure_time = intval($hour.$min);
$driver_or_rider = $conn->real_escape_string($_POST['type']);
$pay_or_not = $conn->real_escape_string($_POST['pay_or_not']);
$pay_amount_from = $conn->real_escape_string($_POST['price_from']);
$pay_amount_to = $conn->real_escape_string($_POST['price_to']);
$given_name = $_SESSION['givenname']; 
$family_name = $_SESSION['familyname'];



$sql = "Insert into RideList VALUES('$person_id','$event_id',
		'$departure_location','$arrival_location','$date_in_unix','$departure_hour','$departure_min','$driver_or_rider','$pay_or_not','$pay_amount_from','$pay_amount_to','$family_name','$given_name')";
if ($conn->query($sql))
{
	$conn->close();
	header('Location: ../index.php');
}




$conn->close();
?>
