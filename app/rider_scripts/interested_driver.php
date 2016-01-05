<?php

if (!isset($_SESSION)) 
{
	session_start();
}

// for riders
if (isset($_SESSION['type']) == 2 || isset($_SESSION['type']) == 3) 
{ 
	include("../function.php");
	$conn = connDB();

	$RiderID = $_SESSION['id'];
	$sql = "Select * from PendingRides WHERE RiderID='$RiderID' AND WhoRequestThis=1";
	$InterestedDrivers = $conn->query($sql); // 2 means rider is interested. 1 means driver is interested.

	$RiderEventID = array();
	$DriverEventID = array();

	if($InterestedDrivers === FALSE) {
		echo '<h3>No interested riders sigh</h3>';
	} else  {

		$counter = 0;
		if (mysqli_num_rows($InterestedDrivers) > 0)
		{
			while ($row = mysqli_fetch_assoc($InterestedDrivers))
			{
				array_push($RiderEventID,$row['RiderEventID']);
				array_push($DriverEventID,$row['DriverEventID']);
				$counter++;
			}
		
		$conn->close();

		$conn = connDB();

		$index = 0;
		
		echo "<div class='section_line' class='span7'>
				Unconfirmed Offers</div>";
		echo "<table class='rwd-table'>
				  <tbody>
				  <tr>
					<td class= 'table_head_ten'>DRIVER NAME</td>
					<td class = 'table_head_ten'>FROM</td>
					<td class = 'table_head_ten'>TO</td>
					<td class = 'table_head_ten'>DATE</td>
					<td class = 'table_head_ten'>START TIME</td>
					<td class = 'table_head_ten'>END TIME</td>
					<td class = 'table_head_ten'>MAX # OF RIDERS</td>
					<td class = 'table_head_ten'>SEATS LEFT</td>
					<td class = 'table_head_ten'>PRICE PER PERSON</td>
					<td class = 'table_head_ten'>CONFIRM</td>
				  </tr>";

			foreach ($DriverEventID as $val)
			{
				$REID = $val;
				$GetDriverEvents = $conn->query("Select * from DriverOffers WHERE DriverEventID='$REID'");
	
				if (mysqli_num_rows($GetDriverEvents) > 0)
				{
					  $count =  0;
					  while ($row = mysqli_fetch_assoc($GetDriverEvents))
					  {
						$EtId = $RiderEventID[$index];
						$count++;
						echo "<tr>";
						echo'<td class="table_d_10" data-th="DRIVER NAME">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
						echo'<td class="table_d_10" data-th="FROM">'. $row['PickupPlace'].'</td>';
						echo'<td class="table_d_10" data-th="TO">'. $row['Destination'].'</td>';
						echo'<td class="table_d_10" data-th="Date">'. $row['Date'].'</td>';
						echo'<td class="table_d_10" data-th="START TIME">'. $start.'</td>';
						echo'<td class="table_d_10" data-th="END TIME">'. $end.'</td>';	
						echo'<td class="table_d_10" data-th="MAX # OF RIDES">'. $row['MaxNum'].'</td>';
						echo'<td class="table_d_10" data-th="SEATS LEFT">'. $spaceLeft.'</td>';
						echo'<td class="table_d_10" data-th="PRICE PER PERSON">$'. $row['PricePerRide'].'</td>';
						echo'<td data-th="Request Ride"><button class="btn_cancel" onclick="confirm('
						.$row['DriverEventID'].','.$row['DriverID'].','.$EtId.','.$RiderID.')">Confirm</button></td>';
						echo "</tr>";
		
					  }
				} 
				$index++;
			}
		
			echo "</tbody></table></div>";
			// echo "<div>No. of results: ".$index."</div>";
		} else {
			echo "<div class='section_line'>
				No Unconfirmed Offers From Driver</div>";
		}
	}

} else {
	echo "Why am I here?";
}
$conn->close();	
?>