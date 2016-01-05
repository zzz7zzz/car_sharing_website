<?php
/* Insert User Info */
if (!isset($_SESSION)) 
{
	session_start();
}

include("../function.php");
$conn = connDB();
$RiderID = $_SESSION['id'];
$RiderHistory = $conn->query("Select * from RiderRequest WHERE RiderID='$RiderID' AND Fulfilled=0 ORDER BY RiderEventID DESC");

if ($RiderHistory === FALSE)
{
	echo "<h3>You do not have requests yet.</h3>";
} else {
	if (mysqli_num_rows($RiderHistory) > 0)
	{
		echo "<div class='section_line'>
				Requests History</div>";
		echo "<table class='rwd-table'>
				  <tbody>
				  <tr>
					<td class = 'table_head'>FROM</td>
					<td class = 'table_head'>TO</td>
					<td class = 'table_head'>DATE</td>
					<td class = 'table_head'>START TIME</td>
					<td class = 'table_head'>END TIME</td>
					<td class = 'table_head'></td>
				  </tr>";
				
		  
		  $count =  0;
		  while ($row = mysqli_fetch_assoc($RiderHistory))
		  {
		    $count++;
			echo'<tr>';
			$start_time_in_unix = $row['StartTimeRange']+3600*2;
			$end_time_in_unix = $row ['EndTimeRange']+3600*2;
			$start = date("H:i", $start_time_in_unix);
			$end = date ("H:i", $end_time_in_unix);
			echo'<td class="table_d" data-th="FROM">'. $row['PickupPlace'].'</td>';
			echo'<td class="table_d" data-th="TO">'. $row['Destination'].'</td>';
			echo'<td class="table_d" data-th="DATE">'. $row['Date'].'</td>';
			echo'<td class="table_d" data-th="START TIME">'. $start.'</td>';
			echo'<td class="table_d" data-th="END TIME">'. $end.'</td>'; 
			echo'<td class="table_d"><button class="btn_cancel" onclick="deleteOffer_Rider('
			.$row['RiderEventID'].')">Cancel</button></td>';
			echo "</tr>";
			
		  }
		  	echo "</tbody></table></div>";
	        // echo "<div>No. of results: ".$count."</div>";
	} else {
		
		echo "<div class='section_line'>
				No Requests History</div>";
	}
}

?>