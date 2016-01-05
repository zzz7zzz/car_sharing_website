<?php
if (!isset($_SESSION)) 
{
	session_start();
}
include("function.php");

$conn = connDB();

$userID = $_SESSION['id'];

$myRide = $conn->query("Select * from RideList, Pax WHERE RideList.person_id = '$userID'
						AND RideList.event_id = Pax.EventID");

if (mysqli_num_rows($myRide) > 0)
{
	echo "<table class='rwd-table'>
			  <tbody>
			  <tr>
				<td class = 'table_head_sevn'>FROM</td>
				<td class = 'table_head_sevn'>TO</td>
				<td class = 'table_head_sevn'>DATE (MM/DD/YYYY)</td>
				<td class = 'table_head_sevn'>DEPARTURE TIME</td>
				<td class = 'table_head_sevn'>PAX</td>
				<td class = 'table_head_sevn'>DRIVER FOUND?</td>
				<td class = 'table_head_sevn'>MORE DETAILS</td>
			  </tr>";
			
	  
	  $count =  0;
	  while ($row = mysqli_fetch_assoc($myRide))
	  {
		$count++;
		$departure_time = $row['departure_time']+3600*2;
		$end_time_in_unix = $row ['EndTimeRange']+3600*2;
		//$date = date ("Y-m-d", $start_time_in_unix);
		$departure_time = date("H:i", $departure_time);
		
		$driverFound = "NO";
		if ($row['DriverFound'] == 1) {
			$driverFound = "YES";
		}
		echo'<tbody id="'.$row['event_id'].'">';
		echo'<tr>';
		echo'<td class = "table_d_7">'. $row['departure_location'].'</td>';
		echo'<td class = "table_d_7">'. $row['arrival_location'].'</td>';
		echo'<td class = "table_d_7">'. $row['Date'].'</td>';
		echo'<td class = "table_d_7">'. $departure_time.'</td>';
		echo'<td class = "table_d_7">'. $row['Pax'].'</td>';
		echo'<td class = "table_d_7">'. $driverFound.'</td>';
		echo'<td class = "table_d_7"><button class="btn_cancel" onclick="moreInfo('.$row['event_id'].')">CLICK</button></td>';
		echo'</tr></tbody>';
		
	  }
		echo "</tbody></table></div>";
		// echo "<div>No. of results: ".$count."</div>";
} else {
	
	echo "<div class='section_line'>
		No Rides Offered</div>";
}

$conn->close();
?>


