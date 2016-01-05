<?php

if (!isset($_SESSION)) 
{
	session_start();
}

include("../function.php");
$conn=connDB();

$DriverID = $_SESSION['id'];

$sql = "SELECT * FROM PendingRides LEFT JOIN DriverOffers ON ".
		"DriverOffers.DriverEventID = PendingRides.DriverEventID".
		" WHERE PendingRides.DriverID='$DriverID' AND PendingRides.WhoRequestThis=1 ORDER BY PendingRides.DriverEventID DESC";

$results = $conn->query($sql);

if($results){ // there are results. Select returns object. Other common queries return true.
	if (mysqli_num_rows($results) > 0)
	{
		echo "<div class='section_line'>
				Invitations awaiting Riders' Response</div>
				<table class='rwd-table'>
				  <tbody>
				  <tr>
					<td class = 'table_head_nin'>FROM</td>
					<td class = 'table_head_nin'>TO</th>
					<td class = 'table_head_nin'>START TIME</td>
					<td class = 'table_head_nin'>END TIME</td>
					<td class = 'table_head_nin'>DATE</td>
					<td class = 'table_head_nin'>MAX # OF RIDERS</td>
					<td class = 'table_head_nin'>SPACE LEFT</td>
					<td class = 'table_head_nin'>PRICE PER RIDE</td>
					<td class = 'table_head_nin'>CANCEL</td>
				  </tr>";
	  	  $count = 0;
	  	  
		  while ($row = mysqli_fetch_assoc($results))
		  {

				$count++;
				$spaceLeft = $row['MaxNum'] - $row['NoOfConfirmedRiders'];
				$start_time_in_unix = $row['PickupStartTimeRange']+3600*2;
				$end_time_in_unix = $row ['PickupEndTimeRange']+3600*2;
				$start = date("H:i", $start_time_in_unix);
				$end = date ("H:i", $end_time_in_unix);
				echo "<tr>";
				//echo'<td data-th="No.">'. $count.'</td>';
				//echo'<td class = "table_d_9">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
				echo'<td class = "table_d_9" data-th="FROM">'. $row['PickupPlace'].'</td>';
				echo'<td class = "table_d_9" data-th="TO">'. $row['Destination'].'</td>';
				echo'<td class = "table_d_9" data-th="START TIME">'. $start.'</td>';
				echo'<td class = "table_d_9" data-th="END TIME">'. $end.'</td>';
				echo'<td class = "table_d_9" data-th="DATE">'. $row['Date'].'</td>';
				echo'<td class = "table_d_9" data-th="MAX # OF RIDERS">'. $row['MaxNum'].'</td>';
				echo'<td class = "table_d_9" data-th="SPACE LEFT">'. $spaceLeft.'</td>';
				echo'<td class = "table_d_9" data-th="PRICE PER RIDE">'. $row['PricePerRide'].'</td>';
				echo'<td class = "table_d_9" data-th="CANCEL"><button class="btn_cancel" onclick="deleteOffer('
				.$row['DriverEventID'].')">CANCEL</button></td>';
				echo "</tr>";
		  }
		  
		  echo "</tbody></table></div>";
		//   echo "<div>No. of results: ".$count."</div>";
	} else {
		echo "<div class='section_line'>
			No Unconfirmed Invitations</div>";
	}
} else {
	echo "<div class='section_line'>
			No Unconfirmed Invitations</div>";
}
$conn->close();

?>