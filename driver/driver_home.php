<?php include "make_ride_driver.php"; ?>


<!-- 
<script type="text/javascript">
$(document).ready(function() {
    var storageFields = ["locFrom_Driver", "locTo_Driver", "startTimeHour_driver", 
    					"startTimeMin_driver", "endTimeHour_driver", "endTimeMin_driver", 
    					"datepicker_driver", "maxRiders", "price", "locFrom_Driver_find",
    					"locTo_Driver_find", "datepicker_driver_find"];
	var makeCallAtEnd = false;

	for (var field in storageFields) {
		var item = localStorage.getItem(storageFields[field])
		if (item != null  && (typeof item !== 'undefined') && item != 'undefined') {
			$('#' + storageFields[field]).val(item);
			console.log("stored!");
			makeCallAtEnd = true;
		}
	}

    $("#all_rides").load("app/driver_scripts/get_all_rider_request.php");
    $("#datepicker_driver_find").datepicker();
    $("#offer_history_driver").load("app/driver_scripts/history_driver_page.php");
    $("#interested_riders").load("app/driver_scripts/interested_rider.php");
    $("#invite_await_response_driver").load("app/driver_scripts/invite_await_response_driver.php");
    $("#confirmed_rides_driver").load("app/driver_scripts/update_confirm_driver.php");
    $("#submit_driver").click(function()
  	{
  	    var day_in_unix = $("#datepicker_driver").datepicker("getDate").getTime()/1000;//it works
  		var start_hour_in_unix = $("#startTimeHour_driver").val();
  		var start_min_in_unix =  $("#startTimeMin_driver").val();
  		var end_hour_in_unix = $("#endTimeHour_driver").val();
  		var end_min_in_unix = $("#endTimeMin_driver").val();
  		var startTime = day_in_unix + (start_hour_in_unix)*3600 + (start_min_in_unix)*60; 
  	    var endTime = day_in_unix + (end_hour_in_unix)*3600 + (end_min_in_unix)*60; 
   		$.ajax(
      	{
            url: "app/driver_scripts/insert_driver_page.php",
            type: "POST",
        	data:
        	{
                locFrom: $("#locFrom_Driver").val().toUpperCase(),
                locTo: $("#locTo_Driver").val().toUpperCase(),
                timeFrom: startTime,
                timeTo: endTime,
                date: $("#datepicker_driver").val(),
                max: $("#maxRiders").val(),
                price: $("#price").val(),
                insert: makeCallAtEnd,
        	},
            dataType: "text",
        	success: function(dat)
        	{	
        		$("#offer_history_driver").load("app/driver_scripts/history_driver_page.php");
				
				for (var field in storageFields) {
	        			localStorage.setItem(storageFields[field], $('#' + storageFields[field]).val());
				}
        	},
    	});
	});
	
	$("#submit_driver_find").click(function()
  	{
   		$.ajax(
      	{
            url: "app/driver_scripts/match_driver.php",
            type: "GET",
        	data:
        	{
                locFrom: $("#locFrom_Driver_find").val().toUpperCase(),
                locTo: $("#locTo_Driver_find").val().toUpperCase(),
                date: $("#datepicker_driver_find").val(),
        	},
            dataType: "text",
        	success: function(dat)
        	{	
       		$("#matched_result_driver").load("app/driver_scripts/match_driver.php");
				
				for (var field in storageFields) {
	        			localStorage.setItem(storageFields[field], $('#' + storageFields[field]).val());
				}
        	},
    	});
	});
	

	
});

function sendRequest_Driver(event_id,driver_id,rider_id) {
	console.log(driver_event_id + " send req driver ");
	$.ajax(
    {
        url: "app/sendRequest.php",
	    type: "POST",
    	data:
        {
        	EventID: event_id,
        	DriverID: driver_id,
        	RiderID: rider_id,
        	WhoRequestThis: 1, // driver
        	
        },
        dataType: "text",
        success: function(dat)
        {
 			$("#invite_await_response_driver").load("app/driver_scripts/invite_await_response_driver.php");
        	alert("Request sent!");
        	console.log("sendrequest driver success");
        	console.log(dat);
        },
        failure: function(dat)
        {
        	console.log("sendrequest driver failure");
        	console.log(dat);
        }
    });
}

function deleteOffer_Driver(driver_event_id) {
	console.log(driver_event_id);
	$.ajax(
    {
        url: "app/deleteOffer.php",
	    type: "POST",
    	data:
        {
        	DriverEventID: driver_event_id,
        	
        },
        dataType: "text",
        success: function()
        {
        	$("#offer_history_driver").load("app/driver_scripts/history_driver_page.php");
        	$("#invite_await_response_driver").load("app/driver_scripts/invite_await_response_driver.php");
        	alert("deleted! ");
        	
        },
        failure: function(dat)
        {
        	console.log(dat);
        }
    });
}

function confirm(event_id,driver_id,rider_id) {
	$.ajax(
    {
        url: "app/confirm.php",
	    type: "POST",
    	data:
        {
        	DriverEventID: driver_event_id,
        	DriverID: driver_id,
        	RiderID: rider_id,
        	
        },
        dataType: "text",
        success: function(dat)
        {
        	alert("Confirm!");
        	console.log(dat);
        	$("#interested_riders").load("app/driver_scripts/interested_rider.php"); 
        	$("#confirmed_rides_driver").load("app/driver_scripts/update_confirm_driver.php");
        },
        failure: function(dat)
        {
        	console.log(dat);
        }
    });
    
    
}

</script>
</head>
<div>
</div>

<div class="home">
	<div class = "fixed-width-centered">
		<div style="clear: both;"></div>
	    <div>
			<a class="nav_button_long" type="button" onClick="window.location='make_ride_driver.php';"/>Have a car? Make a ride!</a>
			<a class="nav_button_long" type="button" onClick="window.location='make_ride_rider.php';"/>No car? Request a ride!</a>
			<a class="nav_button_short" type="button" onClick="window.location='all_rides.php';"/>All Rides</a>
			<a class="nav_button_short" type="button" onClick="window.location='my_rides.php';"/>My Rides</a>
		</div><!~~ div .nav_button ~~>
		<div style="clear: both;"></div>
		<div class="hero-unit">
			<h1>Got a car? Offer a ride!</h1>
			<div class = "general_from_to">
				<div class="input-group style="display: inline-block;">
					<span class="input-group-addon-homes"><i class="fa fa-location-arrow fa-fw"></i></span>
					<input class="form-control-homes" type='text' id = 'locFrom_Driver' placeholder= "From"/>
				</div>
				<div class="input-group style="display: inline-block;">
					<span class="input-group-addon-homes"><i class="fa fa-location-arrow fa-fw"></i></span>
					<input class="form-control-homes" type='text' id = 'locTo_Driver' placeholder = "To"/>
				</div>
				<div class="input-group" style="display: inline-block;">
					<span class="input-group-addon-homes"><i class="fa fa-calendar-o fa-fw"></i></span>
					<input class="form-control-departs datepicker_driver" type="text" id="datepicker_driver" placeholder = "Date" size="10"/>
				</div>
			</div>

			<div class = "hours" >
				<span style="position: relative; display: inline-block; margin-left: 0px;"> Departing from </span>
				<select class = "times" id='startTimeHour_driver' name="startHour" style="display: inline-block;">
					<option value="0">00</option>
					<option value="1">01</option>
					<option value="2">02</option>
					<option value="3">03</option>
					<option value="4">04</option>
					<option value="5">05</option>
					<option value="6">06</option>
					<option value="7">07</option>
					<option value="8">08</option>
					<option value="9">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
				</select>
				<span>:</span>
				<select class = "times" id='startTimeMin_driver' name="startMin" style="display: inline-block;">
					<option value="0">00</option>
					<option value="1">01</option>
					<option value="2">02</option>
					<option value="3">03</option>
					<option value="4">04</option>
					<option value="5">05</option>
					<option value="6">06</option>
					<option value="7">07</option>
					<option value="8">08</option>
					<option value="9">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					<option value="32">32</option>
					<option value="33">33</option>
					<option value="34">34</option>
					<option value="35">35</option>
					<option value="36">36</option>
					<option value="37">37</option>
					<option value="38">38</option>
					<option value="39">39</option>
					<option value="40">40</option>
					<option value="41">41</option>
					<option value="42">42</option>
					<option value="43">43</option>
					<option value="44">44</option>
					<option value="45">45</option>
					<option value="46">46</option>
					<option value="47">47</option>
					<option value="48">48</option>
					<option value="49">49</option>
					<option value="50">50</option>
					<option value="51">51</option>
					<option value="52">52</option>
					<option value="53">53</option>
					<option value="54">54</option>
					<option value="55">55</option>
					<option value="56">56</option>
					<option value="57">57</option>
					<option value="58">58</option>
					<option value="59">59</option>
				</select>
				<span style="display: inline-block; padding: 0 5px 0 10px;"> to </span>
				<select class = "times" id='endTimeHour_driver' name="endHour" style="display: inline-block;">
					<option value="0">00</option>
					<option value="1">01</option>
					<option value="2">02</option>
					<option value="3">03</option>
					<option value="4">04</option>
					<option value="5">05</option>
					<option value="6">06</option>
					<option value="7">07</option>
					<option value="8">08</option>
					<option value="9">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
				</select>
				<span>:</span>
				<select class = "times" id='endTimeMin_driver' name="endMin">
					<option value="0">00</option>
					<option value="1">01</option>
					<option value="2">02</option>
					<option value="3">03</option>
					<option value="4">04</option>
					<option value="5">05</option>
					<option value="6">06</option>
					<option value="7">07</option>
					<option value="8">08</option>
					<option value="9">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
					<option value="32">32</option>
					<option value="33">33</option>
					<option value="34">34</option>
					<option value="35">35</option>
					<option value="36">36</option>
					<option value="37">37</option>
					<option value="38">38</option>
					<option value="39">39</option>
					<option value="40">40</option>
					<option value="41">41</option>
					<option value="42">42</option>
					<option value="43">43</option>
					<option value="44">44</option>
					<option value="45">45</option>
					<option value="46">46</option>
					<option value="47">47</option>
					<option value="48">48</option>
					<option value="49">49</option>
					<option value="50">50</option>
					<option value="51">51</option>
					<option value="52">52</option>
					<option value="53">53</option>
					<option value="54">54</option>
					<option value="55">55</option>
					<option value="56">56</option>
					<option value="57">57</option>
					<option value="58">58</option>
					<option value="59">59</option>
				</select>
			</div><!~~ #div hours ~~>
<!~~ 			<div style="clear:both"></div> ~~>
			<div class ="next_line">
				<input class="max_rider" type='text' id = 'maxRiders' placeholder="Maximum # of Riders"/>
				<input class="max_rider" type='text' id = 'price' placeholder = "Price For Each Ride"/>
				<button class= "submit_button" id="submit_driver">SUBMIT OFFER</button>
			</div>
			<div style="clear:both"></div>
		</div><!~~ div .hero-unit to let drivers create ride offers ~~>

		<div style="clear:both"></div>
		
		<div class="hero-unit">
			<h1>Find a ride! </h1>
			<div class = "general_from_to">
				<div class="input-group">
					<span class="input-group-addon-homes"><i class="fa fa-location-arrow fa-fw"></i></span>
					<input class="form-control-homes" type='text' id = 'locFrom_Driver_find' placeholder= "From"/>
				</div>
				<div class="input-group">
					<span class="input-group-addon-homes"><i class="fa fa-location-arrow fa-fw"></i></span>
					<input class="form-control-homes" type='text' id = 'locTo_Driver_find' placeholder = "To"/>
				</div>
				<div class="input-group">
					<span class="input-group-addon-homes"><i class="fa fa-calendar-o fa-fw"></i></span>
					<input class="form-control-departs" id="datepicker_driver_find" placeholder = "Date"/>
				</div>
				<div style="clear:both"></div>
			</div>
			<button class= "submit_button" id="submit_driver_find">FIND</button>
		</div><!~~ div .hero-unit to let find ride offers ~~>
		<div style="clear:both"></div>
		<div id="all_rides"></div>
		<div id="update_driver"></div>
		<div id="matched_result_driver"></div>
		<div id="offer_history_driver"></div>
<!~~ 
		<div id="invite_await_response_driver"></div>
		<div id="interested_riders"></div>
		<div id="confirmed_rides_driver"></div>
 ~~>
	</div><!~~ fixed-width-centered ~~>

 -->


