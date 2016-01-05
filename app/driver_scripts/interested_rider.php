<?php

if (!isset($_SESSION)) 
{
	session_start();
}

// for drivers
if (isset($_SESSION['type']) == 1 || isset($_SESSION['type']) == 3) 
{
	include("../function.php");
	$conn = connDB();

	$DriverID = $_SESSION['id'];
	$InterestedRiders = $conn->query("Select * from PendingRides WHERE DriverID='$DriverID' AND WhoRequestThis=2"); // 2 means rider is interested. 1 means driver is interested.

	$RiderEventID = array();
	$DriverEventID = array();

	if(!$InterestedRiders) {
		echo "<div class='section_line' class='span7'>
					No Matched or Unconfirmed Offers</div>";
	} else  {


		if (mysqli_num_rows($InterestedRiders) > 0)
		{
			while ($row = mysqli_fetch_assoc($InterestedRiders))
			{
				array_push($RiderEventID,$row['RiderEventID']);
				array_push($DriverEventID,$row['DriverEventID']);
			}
		
			$conn->close();
		
			echo "<div class='section_line' class='span7'>
					Matched and Unconfirmed Offers</div>";
					echo "<table class='rwd-table'>
						<tbody>
						<tr>
							<td class = 'table_head_sevn'>RIDER NAME</td>
							<td class = 'table_head_sevn'>FROM</td>
							<td class = 'table_head_sevn'>TO</td>
							<td class = 'table_head_sevn'>DATE</td>
							<td class = 'table_head_sevn'>START TIME</td>
							<td class = 'table_head_sevn'>END TIME</td>
							<td class = 'table_head_sevn'>CONFIRM</td>
						</tr>";
			$index = 0;
			$conn = connDB();
			foreach ($RiderEventID as $val)
			{
	// 			$conn = connDB();
				$REID = $val;
				$GetRiderEvents = $conn->query("Select * from RiderRequest WHERE RiderEventID='$REID'");
	
				if (mysqli_num_rows($GetRiderEvents) > 0)
				{
					  $count =  0;
					  while ($row = mysqli_fetch_assoc($GetRiderEvents))
					  {
						$EtId = $DriverEventID[$index];
						$count++;
						$num = $index + 1;
						$start_time_in_unix = $row['StartTimeRange']+3600*2;
						$end_time_in_unix = $row ['EndTimeRange']+3600*2;
						$start = date("H:i", $start_time_in_unix);
						$end = date ("H:i", $end_time_in_unix);
						echo'<tr>';
						// echo'<td class="table_d_7" data-th="No.">'. $num .'</td>';
						echo'<td class="table_d_7" data-th="RIDER NAME">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
						echo'<td class="table_d_7" data-th="FROM">'. $row['PickupPlace'].'</td>';
						echo'<td class="table_d_7" data-th="TO">'. $row['Destination'].'</td>';
						echo'<td class="table_d_7" data-th="DATE">'. $row['Date'].'</td>';
						echo'<td class="table_d_7" data-th="START TIME">'. $start.'</td>';
						echo'<td class="table_d_7" data-th="END TIME">'. $end .'</td>';
						echo'<td class="table_d_7" data-th="CONFIRM"><button class="btn_cancel" onclick="confirm('
						.$EtId.','.$DriverID.','.$row['RiderEventID'].','.$row['RiderID'].')">Confirm</button></td>';
						echo'</tr>';
		
					  }
				} else {
					echo "error at interested rider.";
				}
				$index++;
	// 			$conn->close();
			}
			echo "</tbody></table></div>";
			// echo "<div>No. of results: ".$index."</div>";
		} else {
			echo "<div class='section_line' class='span7'>
					No Matched or Unconfirmed Offers</div>";
		}
	}
} else {
	echo "Why am I here?";
}
$conn->close();	
?>