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
	
	$("#my_rides").load("app/viewMyRide.php");
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

function cancel(event_id) {
	$.ajax({
		url:"app/cancel.php",
		type: "POST",
    	data:
        {
        	EventID: event_id,
        },
        dataType: "text",
        success: function(dat)
        {
        	console.log(dat);
        	$("#my_rides").load("app/viewMyRide.php");
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
	<h1>My Rides</h1>
	<div id="my_rides"></div>	
<?php	
	include "static/module/_footer.php";

?>
</body>
</html>