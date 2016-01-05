<?php
if (!isset($_SESSION)) 
{
	session_start();
}
include("function.php");

$conn = connDB();

$EventID = $_POST['EventID'];
$JoinORCancel = $_POST['JoinOrCancel'];

$whoElse = $conn->query("SELECT * from 
RideList WHERE RideList.event_id = '$EventID'");

if (mysqli_num_rows($whoElse) > 0)
{
	if ($JoinORCancel == "join") {
		  $rider = "rider";
		  $driver = "driver";
		  
		  echo'<tbody class="'.$EventID.' info">';
		  echo'<tr><td><strong>People in ride</strong></td>';
		  echo'<td><button class="btn_join" onclick="join('.$EventID.',\''.$rider.'\')">JOIN AS RIDER</button></td>';
		  echo'<td><button class="btn_join" onclick="join('.$EventID.',\''.$driver.'\')">JOIN AS DRIVER</button></td>';
		  echo'</tr>';
		  //$driverFound = "NO";
		  $count =  0;
		  while ($row = mysqli_fetch_assoc($whoElse))
		  {
			$count++;
			if ($row['driver_or_rider'] == 'driver') {
				//$driverFound = "YES";
				echo'<tr><td class="name">'.$row['given_name'].' '.$row['family_name'].' (driver)</td>';
				echo'<td class="pay">Fee: $'.$row['pay_amount'].'</td></tr>';
			} else {
				echo'<tr><td class="name">'.$row['given_name'].' '.$row['family_name'].'</td></tr>';
			}
		  }
		  echo'</tbody>';
	} else {
	      echo'<tbody class="'.$EventID.' info">';
		  echo'<tr><td><strong>People in ride</strong></td>';
		  echo'<td><button class="btn_join" onclick="cancel('.$EventID.','.$_SESSION['id'].')">CANCEL</button></td>';
		  echo'</tr>';
		  //$driverFound = "NO";
		  $count =  0;
		  while ($row = mysqli_fetch_assoc($whoElse))
		  {
			$count++;
			if ($row['driver_or_rider'] == 'driver') {
				//$driverFound = "YES";
				echo'<tr><td class="name">'.$row['given_name'].' '.$row['family_name'].' (driver)</td>';
				echo'<td class="pay">Fee: $'.$row['pay_amount'].'</td></tr>';
			} else {
				echo'<tr><td class="name">'.$row['given_name'].' '.$row['family_name'].'</td></tr>';
			}
		  }
		  echo'</tbody>';
	}
		
} else {
	
	echo "Error: <br\>" . $conn->error;
}

$conn->close();
?>


