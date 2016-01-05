<?php
if (!isset($_SESSION)) 
{
	session_start();
}
include("function.php");

$conn = connDB();

$allRides = $conn->query("SELECT DISTINCT departure_time,departure_location,
arrival_location, Date,Pax, DriverFound,event_id from 
RideList, Pax WHERE RideList.event_id = Pax.EventID");

if (mysqli_num_rows($allRides) > 0)
{
	echo "<table class='rwd-table'>
			  <thead>
			  <tr>
				<td class = 'table_head_sevn'>FROM</td>
				<td class = 'table_head_sevn'>TO</td>
				<td class = 'table_head_sevn'>DATE (MM/DD/YYYY)</td>
				<td class = 'table_head_sevn'>DEPARTURE TIME</td>
				<td class = 'table_head_sevn'>PAX</td>
				<td class = 'table_head_sevn'>DRIVER FOUND?</td>
				<td class = 'table_head_sevn'>MORE DETAILS</td>
			  </tr></thead>";
			
	  
	  $count =  0;
	  while ($row = mysqli_fetch_assoc($allRides))
	  {
		$count++;
		$departure_time = $row['departure_time']+3600*2;
		//$date = date ("Y-m-d", $start_time_in_unix);
		$departure_time = date("H:i", $departure_time);
		
		$driverFound = "NO";
		if ($row['DriverFound'] == 1) {
			$driverFound = "YES";
		}
		echo'<tbody id="'.$row['event_id'].'">';
		echo'<tr>';
		echo'<td class = "table_d_7 depart_loc">'. $row['departure_location'].'</td>';
		echo'<td class = "table_d_7 arrive_loc">'. $row['arrival_location'].'</td>';
		echo'<td class = "table_d_7 date">'. $row['Date'].'</td>';
		echo'<td class = "table_d_7 time">'. $departure_time.'</td>';
		echo'<td class = "table_d_7 pax">'. $row['Pax'].'</td>';
		echo'<td class = "table_d_7 driver_found">'. $driverFound.'</td>';
		echo'<td class = "table_d_7 detail"><button class="btn_cancel" onclick="moreInfo('.$row['event_id'].', 
		\'join\')">CLICK</button></td>';
		echo'</tr></tbody>';
		
	  }
		echo "</table>";
		// echo "<div>No. of results: ".$count."</div>";
} else {
	
	echo "<div class='section_line'>
		No Rides Offered</div>";
}

$conn->close();
?>


