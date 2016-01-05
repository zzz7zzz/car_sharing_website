<?php
/* Insert User Info */
if (!isset($_SESSION)) 
{
	session_start();
}

include("../function.php");
$conn = connDB();
$driverID = $_SESSION['id'];

$OfferHistory = $conn->query("Select * from DriverOffers WHERE DriverID='$driverID' ORDER BY DriverEventID DESC");

if (!$OfferHistory)
{
	echo "<h3>You do not have any offers with empty seats available.</h3>";
} else { 
	if (mysqli_num_rows($OfferHistory) > 0)
	{
		echo "<div class='section_line'>
				Your Offers With Seats Left</div>";
		echo "<table class='rwd-table'>
				  <tbody>
				  <tr>
					<td class = 'table_head_nin'>FROM</td>
					<td class = 'table_head_nin'>TO</td>
					<td class = 'table_head_nin'>DATE</td>
					<td class = 'table_head_nin'>START TIME</td>
					<td class = 'table_head_nin'>END TIME</td>
					<td class = 'table_head_nin'>MAX # OF RIDERS</td>
					<td class = 'table_head_nin'>SEATS LEFT</td>
					<td class = 'table_head_nin'>PRICE PER PERSON</td>
					<td class = 'table_head_nin'>CANCEL OFFER</td>
				  </tr>";
	  
		  $count =  0;
		  while ($row = mysqli_fetch_assoc($OfferHistory))
		  {
			$spaceLeft = $row['MaxNum'] - $row['NoOfConfirmedRiders'];
			if ($spaceLeft > 0) 
			{
				$count++;
                $seatsLeft = $row['MaxNum']-$row['NoOfConfirmedRiders'];
                $start_time_in_unix = $row['PickupStartTimeRange']+3600*2;
				$end_time_in_unix = $row ['PickupEndTimeRange']+3600*2;
				//$date = date ("Y-m-d", $start_time_in_unix);
				$start = date("H:i", $start_time_in_unix);
				$end = date ("H:i", $end_time_in_unix);
				echo "<tr>";
				//echo'<td class="table_d_9" data-th="No.">'. $count.'</td>';
				//echo'<td class="table_d_9" data-th="Name">'. $row['GivenName'].' '.$row['FamilyName'].'</td>';
				echo'<td class="table_d_9" data-th="FROM">'. $row['PickupPlace'].'</td>';
				echo'<td class="table_d_9" data-th="TO">'. $row['Destination'].'</td>';
				echo'<td class="table_d_9" data-th="DATE">'. $row['Date'].'</td>';
				echo'<td class="table_d_9" data-th="START TIME">'. $start.'</td>';
				echo'<td class="table_d_9" data-th="END TIME">'. $end.'</td>';
				echo'<td class="table_d_9" data-th="MAX # OF RIDERS">'. $row['MaxNum'].'</td>';
				echo'<td class="table_d_9" data-th="SEATS LEFT">'. $seatsLeft.'</td>';
				echo'<td class="table_d_9" data-th="PRICE PER PERSON">$'. $row['PricePerRide'].'</td>';
				echo'<td class="table_d_9" data-th="CANCEL OFFER"><button class="btn_cancel" onclick="deleteOffer_Driver('
				.$row['DriverEventID'].')">CANCEL</button></td>';
				echo "</tr>";
			}
		
		  }
			echo "</tbody></table></div>";
			// echo "<div>No. of results: ".$count."</div>";
	} else {
	
		echo "<div class='section_line'>
				No Offers History</div>";
	}
}
$conn->close();
?>
