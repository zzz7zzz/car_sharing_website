<?php

include("../function.php");

if (!isset($_SESSION)) 
{
	session_start();
}

$EtId = microtime(true); //Generate Event Id Using Unix Time
$locFrom = $_POST['locFrom'];
$locTo = $_POST['locTo'];
$timeFrom = $_POST['timeFrom'];
$timeTo = $_POST['timeTo'];
$date = $_POST['date'];
$sort = $_POST['sort'];
$riderId = $_SESSION['id'];
$familyname = $_SESSION['familyname'];
$givenname = $_SESSION['givenname'];
$sortString;

if ($sort == "lowprice") {
	$sortString = "PricePerRide ASC";
} else if ($sort == "earlytime") {
	$sortString = "PickupStartTimeRange ASC";
} else {
	$sortString = "PickupStartTimeRange DESC";
}




$conn=connDB();

$requestExist = $conn->query("Select * from RiderRequest 
	WHERE PickupPlace='$locFrom' AND Date='$date' AND Destination='$locTo' AND RiderID='$riderId'");

if ($requestExist)
{

	if (mysqli_num_rows($requestExist) > 0) {
		$requestExist->close();
		
	  echo "<div class='section_line'>
			You have made the same request before.</div>";


	}else{


    $conn = connDB();
$sql = "Insert into RiderRequest VALUES('$locFrom','$locTo',
		'$timeFrom','$timeTo','$EtId','$riderId','$date',0,'$familyname','$givenname')";
if ($conn->query($sql))
{
	$conn->close();

	$conn = connDB();
	
	
	
	$riderRequestedEvents = $conn->query("Select * from DriverOffers 
	WHERE PickupPlace='$locFrom' AND Date='$date' AND Destination='$locTo' ORDER BY $sortString");
	 

	$match = array();

	if (mysqli_num_rows($riderRequestedEvents) > 0)
	{
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
	  	  $count = 0;
	  	  
		  while ($row = mysqli_fetch_assoc($riderRequestedEvents))
		  {

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
		  
		  echo "</tbody></table></div>";
	} else {
		echo "<h3>No search results available. Better luck next time!=P</h3>";
	}
	
}
else
{
	echo "<h3>No search results available. Better luck next time!=P</h3>";
}	



$conn->close();

}
}else{
	 $conn = connDB();
$sql = "Insert into RiderRequest VALUES('$locFrom','$locTo',
		'$timeFrom','$timeTo','$EtId','$riderId','$date',0,'$familyname','$givenname')";
if ($conn->query($sql))
{
	$conn->close();

	$conn = connDB();
	
	
	
	$riderRequestedEvents = $conn->query("Select * from DriverOffers 
	WHERE PickupPlace='$locFrom' AND Date='$date' AND Destination='$locTo' ORDER BY $sortString");
	 

	$match = array();

	if (mysqli_num_rows($riderRequestedEvents) > 0)
	{
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
	  	  $count = 0;
	  	  
		  while ($row = mysqli_fetch_assoc($riderRequestedEvents))
		  {

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
		  
		  echo "</tbody></table></div>";
	} else {
		echo "<h3>No search results available. Better luck next time!=P</h3>";
	}
	
}
else
{
	echo "<h3>No search results available. Better luck next time!=P</h3>";
}	



$conn->close();
}

$conn->close();

?>
