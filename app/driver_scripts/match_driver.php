<?php
if (!isset($_SESSION)) 
{
	session_start();
}
include("../function.php");

$locFrom = $conn->real_escape_string($_POST['locFrom']);
$locTo = $conn->real_escape_string($_POST['locTo']);
$date = $_POST['date'];

$conn = connDB();

$DriverRequestedEvents = $conn->query("Select * from RiderRequest 
WHERE PickupPlace='$locFrom' AND Date='$date' AND Destination='$locTo'");

if (mysqli_num_rows($DriverRequestedEvents) > 0)
{
	echo "<div class='section_line'>
			Matched Rides</div>";
	echo "<table class='rwd-table'>
			  <tbody>
			  <tr>
				<td class = 'table_head_sevn'>NAME</td>
				<td class = 'table_head_sevn'>FROM</td>
				<td class = 'table_head_sevn'>TO</td>
				<td class = 'table_head_sevn'>START TIME</td>
				<td class = 'table_head_sevn'>END TIME</td>
				<td class = 'table_head_sevn'>DATE</td>
				<td class = 'table_head_sevn'>INVITE</td>
			  </tr>";
			
	  
	  $count =  0;
	  while ($row = mysqli_fetch_assoc($DriverRequestedEvents))
	  {
		$count++;
		$start_time_in_unix = $row['StartTimeRange']+3600*2;
		$end_time_in_unix = $row ['EndTimeRange']+3600*2;
		//$date = date ("Y-m-d", $start_time_in_unix);
		$start = date("H:i", $start_time_in_unix);
		$end = date ("H:i", $end_time_in_unix);
		echo'<tr>';
		// echo'<td class = "table_d_9">'. $count .'</td>';
		echo'<td class = "table_d_7">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
		echo'<td class = "table_d_7">'. $row['PickupPlace'].'</td>';
		echo'<td class = "table_d_7">'. $row['Destination'].'</td>';
		echo'<td class = "table_d_7">'. $start.'</td>';
		echo'<td class = "table_d_7">'. $end.'</td>';
		echo'<td class = "table_d_7">'. $row['Date'].'</td>';
		echo'<td class = "table_d_7"><button class="btn_cancel" onclick="sendRequest_Driver('
		.$EtId.','.$DriverId.','.$row['RiderEventID'].','.$row['RiderID'].')">INVITE</button></td>';
		echo'</tr>';
		
	  }
		echo "</tbody></table></div>";
		// echo "<div>No. of results: ".$count."</div>";
} else {
	
	echo "<div class='section_line'>
		No Matched Rides</div>";
}

$conn->close();
?>


