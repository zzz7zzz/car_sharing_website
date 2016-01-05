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

$EtId = microtime(true); //Generate Event Id Using Unix Time
$locFrom = $conn->real_escape_string($_POST['locFrom']);
$locTo = $conn->real_escape_string($_POST['locTo']);
$timeFrom = $_POST['timeFrom'];
$type = "rider";
$date = $_POST['date'];
$price = "NA";
$PersonID = $_SESSION['id'];
$familyname = $_SESSION['familyname'];
$givenname = $_SESSION['givenname'];

$update_ridelist_sql = "Insert into RideList VALUES('','$PersonID','$EtId','$locFrom','$locTo','$date',
		'$timeFrom','$type','$price','$givenname','$familyname')";
$update_pax_sql = "Insert into Pax VALUES('$EtId',1,0)";
$update_peopleInRide_sql = "Insert into PeopleInRide VALUES('$EtId','$PersonID')";

if ($conn->query($update_ridelist_sql) && $conn->query($update_pax_sql) && $conn->query($update_peopleInRide_sql))
{
	$conn->close();
	
	
} else {
	echo "Error: " . $sql . "<br\>" . $conn->error;
}

?>
