<?php
	if (!isset($_SESSION))
	{
    	session_start();
	}
?>

<!DOCTYPE html>
<html>
<head>
<?php require "static/module/_includes.php"; ?>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#all_rides").load("app/viewAllRides.php");
});

function moreInfo(event_id, join_or_cancel) {
	console.log("hi!");
	$.ajax({
		url:"app/viewInfo.php",
		type: "POST",
    	data:
        {
        	EventID: event_id,
        	JoinOrCancel: join_or_cancel,
        },
        dataType: "text",
        success: function(dat)
        {
        	console.log("boom!");
        	$('#'+event_id).after(dat);
		}
	});
}

function join(event_id, driver_or_rider) {
	$.ajax({
		url:"app/join.php",
		type: "POST",
    	data:
        {
        	EventID: event_id,
        	DriverOrRider: driver_or_rider,
        },
        dataType: "text",
        success: function(dat)
        {
        	console.log(dat);
        	$('.'+event_id+'.info').append(dat);
        	// change join button to undo
		}
	});
}


</script>
</head>
<body>
<?php
	include "static/module/_header.php"; ?>
<div class = "fixed-width-centered">
	<div style="clear: both;"></div>
	<div>
		<a class="nav_button_long" type="button" onClick="window.location='make_ride_driver.php';"/>Have a car? Offer a ride!</a>
		<a class="nav_button_long" type="button" onClick="window.location='make_ride_rider.php';"/>No car? Request a ride!</a>
		<a class="nav_button_short" type="button" onClick="window.location='all_rides.php';"/>All Rides</a>
		<a class="nav_button_short" type="button" onClick="window.location='my_rides.php';"/>My Rides</a>
	</div><!-- div .nav_button -->
	<div style="clear: both;"></div>
	<h1>All Ride Offers and Requests</h1>
	<div id="all_rides"></div>	
<?php	
	include "static/module/_footer.php";

?>
</body>
</html>