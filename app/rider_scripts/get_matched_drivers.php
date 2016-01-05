<?php

include("../function.php");

$EtId = microtime(true);
$riderId = $_SESSION['id'];

if (!isset($_SESSION)) session_start();
$conn = connDB();

$riderId = $_SESSION['id'];
$result = $conn->query("select PickupPlace, Destination from RiderRequest where RiderID='$riderId'");

echo "<div class='section_line' class='span7'>
		Matched Results</div>";
echo "<table class='rwd-table'>
		  <tbody>
		  <tr>
		  	<td class = 'table_head_ten'>DRIVER NAME</td>
		  	<td class = 'table_head_ten'>FROM</td>
			<td class = 'table_head_ten'>TO</td>
			<td class = 'table_head_ten'>DATE</td>
			<td class = 'table_head_ten'>START TIME</td>
			<td class = 'table_head_ten'>END TIME</td>
			<td class = 'table_head_ten'>MAX # OF RIDERS</td>
			<td class = 'table_head_ten'>SEATS LEFT</td>
			<td class = 'table_head_ten'>PRICE PER PERSON</td>
			<td class = 'table_head_ten'>REQUEST RIDES</td>
		  </tr>";

while ($prerow = mysqli_fetch_assoc($result)) {
	$pickup = $prerow['PickupPlace'];
	$dropoff = $prerow['Destination'];

	$riderRequestedEvents = $conn->query("select * from DriverOffers WHERE PickupPlace='$pickup' AND Destination='$dropoff'");
	while ($row = mysqli_fetch_assoc($riderRequestedEvents)) {
		$spaceLeft = $row['MaxNum'] - $row['NoOfConfirmedRiders'];
		  	if ($spaceLeft > 0)
		  	{
				$count++;
				// $starttime=$row['PickupStartTimeRange'];
				// $endtime= $row['PickupEndTimeRange'];
				$start_time_in_unix = $row['PickupStartTimeRange']+3600*2;
				$end_time_in_unix = $row ['PickupEndTimeRange']+3600*2;
				$date = date ("Y-m-d", $start_time_in_unix);
				$start = date("H:i", $start_time_in_unix);
				$end = date ("H:i", $end_time_in_unix);
				echo "<tr>";
				// echo'<td data-th="No.">'. $count.'</td>';
				echo'<td class="table_d_10" data-th="DRIVER NAME">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
				echo'<td class="table_d_10" data-th="FROM">'. $row['PickupPlace'].'</td>';
				echo'<td class="table_d_10" data-th="TO">'. $row['Destination'].'</td>';
				echo'<td class="table_d_10" data-th="Date">'. $row['Date'].'</td>';
				echo'<td class="table_d_10" data-th="START TIME">'. $start.'</td>';
				echo'<td class="table_d_10" data-th="END TIME">'. $end.'</td>';	
				echo'<td class="table_d_10" data-th="MAX # OF RIDES">'. $row['MaxNum'].'</td>';
				echo'<td class="table_d_10" data-th="SEATS LEFT">'. $spaceLeft.'</td>';
				echo'<td class="table_d_10" data-th="PRICE PER PERSON">$'. $row['PricePerRide'].'</td>';
				echo'<td class="table_d_10" data-th="Request"><button class="btn_cancel" onclick="sendRequest_Rider('
				.$row['DriverEventID'].','.$row['DriverID'].','.$EtId.','.$riderId.')">Request</button></td>';
				echo "</tr>";
	  	  	}
	}
}

echo "</tbody></table></div>";
