<?php

if (!isset($_SESSION)) 
{
	session_start();
}	

include("../function.php");

$conn=connDB();

$allRides = $conn->query("Select * from RideList");

if (mysqli_num_rows($allRides) > 0) {
	echo "<div class='section_line' class='span7'>
		All Rides</div>";
		echo "<table class='rwd-table'>
			<tbody>
			<tr>
				<td class = 'table_head_sevn'>NO</td>.
				<td class = 'table_head_sevn'>FROM</td>
				<td class = 'table_head_sevn'>TO</td>
				<td class = 'table_head_sevn'>DATE</td>
				<td class = 'table_head_sevn'>DEPARTURE TIME</td>
				<td class = 'table_head_sevn'>DRIVER FOUND?/td>
				<td class = 'table_head_sevn'>MORE DETAILS</td>
			</tr>";
	 while ($row = mysqli_fetch_assoc($allRides))
	  {
		$count++;
		$start_time_in_unix = $row['StartTimeRange']+3600*2;
		//$date = date ("Y-m-d", $start_time_in_unix);
		$start = date("H:i", $start_time_in_unix);
		echo'<tr>';
		echo'<td class = "table_d_9">'. $count .'</td>';
		echo'<td class = "table_d_9">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
		echo'<td class = "table_d_9">'. $row['PickupPlace'].'</td>';
		echo'<td class = "table_d_9">'. $row['Destination'].'</td>';
		echo'<td class = "table_d_9">'. $start.'</td>';
		echo'<td class = "table_d_9">'. $end.'</td>';
		echo'<td class = "table_d_9">'. $row['Date'].'</td>';
		echo'<td class = "table_d_9"><button class="btn_cancel" onclick="sendRequest_Driver('
		.$EtId.','.$DriverID.','.$row['RiderEventID'].','.$row['RiderID'].')">INVITE</button></td>';
		echo'</tr>';
		
	  }
		echo "</tbody></table></div>";
}





$conn->close();
?>
