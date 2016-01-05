<?php

if (!isset($_SESSION)) 
{
	session_start();
}

include("../function.php");
$conn=connDB();

$RiderID = $_SESSION['id'];

$sql = "SELECT * FROM PendingRides LEFT JOIN RiderRequest ON ".
		"RiderRequest.RiderEventID = PendingRides.RiderEventID".
		" WHERE PendingRides.RiderID='$RiderID' AND PendingRides.WhoRequestThis=2 ORDER BY PendingRides.DriverEventID DESC";

$results = $conn->query($sql);

if($results){ // there are results
	if (mysqli_num_rows($results) > 0)
	{
		echo "<div class='section_line'>
				Invitations awaiting Drivers' Response</div>
				<table class='rwd-table'>
				  <tbody>
				  <tr>
					<td class = 'table_head_nin'>NAME</td>
					<td class = 'table_head_nin'>FROM</td>
					<td class = 'table_head_nin'>TO</td>
					<td class = 'table_head_nin'>START TIME</td>
					<td class = 'table_head_nin'>END TIME</td>
					<td class = 'table_head_nin'>DATE</td>
					<td class = 'table_head_nin'>CANCEL</td>
				  </tr>";
	  	  $count = 0;
	  	  
		  while ($row = mysqli_fetch_assoc($results))
		  {
		    $count++;
		    $start_time_in_unix = $row['StartTimeRange']+3600*2;
			$end_time_in_unix = $row ['EndTimeRange']+3600*2;
			$start = date("H:i", $start_time_in_unix);
			$end = date ("H:i", $end_time_in_unix);
			echo'<tr>';
			echo'<td class = "table_d_9" td data-th="Name">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
			echo'<td class = "table_d_9" td data-th="Pick-Up Place">'. $row['PickupPlace'].'</td>';
			echo'<td class = "table_d_9" td data-th="Destination">'. $row['Destination'].'</td>';
			echo'<td class = "table_d_9" td data-th="Pickup Time Range (Start)">'. $start.'</td>';
			echo'<td class = "table_d_9" td data-th="Pickup Time Range (End)">'. $end.'</td>';
			echo'<td class = "table_d_9" td data-th="Date">'. $row['Date'].'</td>';
            echo'<td class = "table_d_9" td data-th="Invite"><button class="btn_cancel" onclick="deleteOffer('
			.$row['RiderEventID'].')">CANCEL</button></td>';
			echo'</tr>';
			
		  }
		  
		  echo "</tbody></table></div>";
		  // echo "<div>No. of results: ".$count."</div>";
	} else {
		echo "<div class='section_line'>
			No Unconfirmed Invitations</div>";;
	}
} else {
	echo "<div class='section_line'>
			No Unconfirmed Invitations</div>";;
}
$conn->close();

?>