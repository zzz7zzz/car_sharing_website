<?php
if (!isset($_SESSION)) 
{
	session_start();
}

include("../function.php");
$conn=connDB();

$DriverID = $_SESSION['id'];

$sql = "SELECT * FROM ConfirmedRides LEFT JOIN RiderRequest ON ".
		"RiderRequest.RiderEventID = ConfirmedRides.RiderEventID".
		" WHERE ConfirmedRides.DriverID='$DriverID'";
		

$results = $conn->query($sql);

if($results)
{
	if (mysqli_num_rows($results) > 0)
	{
		echo "<div class='section_line' class='span7'>
				Confirmed Rides</div>";
		echo "<table class='rwd-table'>
				<tbody>
				<tr>
					<td class = 'table_head_sixx'>RIDER NAME</td>
				  	<td class = 'table_head_sixx'>FROM</td>
					<td class = 'table_head_sixx'>TO</td>
					<td class = 'table_head_sixx'>DATE</td>
					<td class = 'table_head_sixx'>START TIME</td>
					<td class = 'table_head_sixx'>END TIME</td>
				  </tr>";
	  	  $count = 0;
	  	  
		  while ($row = mysqli_fetch_assoc($results))
		  {
		  		if ($row['PickupPlace'] === NULL)
		  		{
		  			continue;
		  		} else {
					$count++;
					echo'<tr>';
					$start_time_in_unix = $row['StartTimeRange']+3600*2;
					$end_time_in_unix = $row ['EndTimeRange']+3600*2;
					$start = date("H:i", $start_time_in_unix);
					$end = date ("H:i", $end_time_in_unix);
					echo'<td class="table_d_6" data-th="RIDER NAME">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
					echo'<td class="table_d_6" data-th="FROM">'. $row['PickupPlace'].'</td>';
					echo'<td class="table_d_6" data-th="TO">'. $row['Destination'].'</td>';
					echo'<td class="table_d_6" data-th="DATE">'. $row['Date'].'</td>';
					echo'<td class="table_d_6" data-th="START TIME">'. $start.'</td>';
					echo'<td class="table_d_6" data-th="END TIME">'. $end.'</td>';
					echo'</tr>';
				}
		  }
		  
		  echo "</tbody></table></div>";
		  // echo "<div>No. of results: ".$count."</div>";
	} else {
		echo "<div class='section_line' class='span7'>
				No Confirmed Rides</div>";
	}
} else {
	echo "Error updating record in DriverOffer in confirm.php: " . $conn->error;
}

$conn->close();
?>