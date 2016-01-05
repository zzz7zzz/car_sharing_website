<?php
session_start();

include "function.php";
$conn=connDB();

$RiderEventID = $_POST['EventID'];
$RiderID = $_POST['RiderID'];
$DriverID = $_POST['DriverID'];

$results = $conn->query("INSERT into ConfirmedRides VALUES('$EventID','$RiderID','$DriverID')");

if ($results === TRUE)
{ 
	echo "inserted";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

$conn = connDB();
$sql = "UPDATE RiderRequest SET Fulfilled=1 WHERE RiderEventID='$RiderEventID'";

if ($conn->query($sql) === TRUE) {
	echo "Record updated successfully";
} else {
	echo "Error updating record: " . $conn->error;
}

$conn->close();

$conn = connDB();
$sql = "DELETE from PendingRides WHERE DriverEventID='$DriverEventID' AND RiderEventID='$RiderEventID' LIMIT 1";

if ($conn->query($sql) === TRUE) {
	echo "Record deleted successfully";
	echo $DriverEventID."   ".$RiderEventID;
} else {
	echo "Error deleting record in PR in confirm.php: " . $conn->error;
}
$conn->close();

$conn = connDB();
$sql = "UPDATE * FROM ConfirmedRides LEFT JOIN DriverOffers ON ".
		"DriverOffers.DriverEventID = ConfirmedRides.EventID".
		" WHERE ConfirmedRides.DriverID='$DriverID'";

if (!$sql) 
{
	echo "Error updating driver record in confirm.php: " . $conn->error;
} else {
	if($results)
	{
		if (mysqli_num_rows($results) > 0)
		{
			echo "<div id='table_admin' class='span7'>
					<h3>Confirmed Rides from Riders</h3>
					<table class='rwd-table'>
					  <tbody>
					  <tr>
						<th>No.</th>
						<th>Name</th>
						<th>Pick-Up Place</th>
						<th>Destination</th>
						<th>Pickup Time Range (Start)</th>
						<th>Pickup Time Range (End)</th>
						<th>Date</th>
					  </tr>";
			  $count = 0;
		  
			  while ($row = mysqli_fetch_assoc($results))
			  {
					$count++;
					echo'<tr>';
					echo'<td data-th="No.">'. $count .'</td>';
					echo'<td data-th="Name">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
					echo'<td data-th="Pick-Up Place">'. $row['PickupPlace'].'</td>';
					echo'<td data-th="Destination">'. $row['Destination'].'</td>';
					echo'<td data-th="Pickup Time Range (Start)">'. $row['StartTimeRange'].'</td>';
					echo'<td data-th="Pickup Time Range (End)">'. $row['EndTimeRange'].'</td>';
					echo'<td data-th="Date">'. $row['Date'].'</td>';
					echo'</tr>';
			  }
		  
			  echo "</tbody></table></div>";
			  echo "<div>No. of results: ".$count."</div>";
		} else {
			echo "<h3>No confirmed Rides</h3>";
		}
	} else {
		echo "Error updating record in DriverOffer in confirm.php: " . $conn->error;
	}


}
$conn->close();
?>

