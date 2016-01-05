<?php
if (!isset($_SESSION)) 
{
	session_start();
}

$EventID = $_POST['EventID'];
$ID = $_SESSION['id'];

include "function.php";
$conn = connDB();

$sql = "DELETE from RideList WHERE event_id='$EventID' AND person_id='$ID'";

if ($conn->query($sql) === TRUE) {

} else {
	echo "Error deleting record in PR: " . $conn->error;
}
$conn->close();

$conn = connDB();
$sql = "DELETE from PeopleInRide WHERE EventID='$EventID' AND PersonID ='$ID'";

if ($conn->query($sql) === TRUE) {

} else {
	echo "Error deleting record in AR: " . $conn->error;
}
$conn->close();

$conn = connDB();
$sql = "UPDATE Pax SET Pax=Pax-1 WHERE EventID='$EventID'";

if ($conn->query($sql) === TRUE) {

} else {
	echo "Error deleting record: " . $conn->error;
}
$conn->close();

$conn = connDB();
$sql = "DELETE from Pax WHERE Pax = 0";

if ($conn->query($sql) === TRUE) {

} else {
	echo "Error deleting record in PR: " . $conn->error;
}
$conn->close();

?>
