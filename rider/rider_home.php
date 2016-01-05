<?php if (!isset($_SESSION)) session_start(); ?>
<head>
<script type="text/javascript">
$(document).ready(function() {
	var storageFields = ["locFrom", "locTo", "startTimeHour", "startTimeMin", "endTimeHour", "endTimeMin", "datepicker", "sort-list"];
	var makeCallAtEnd = false;
	if (localStorage.getItem(storageFields[field])!=null){//aaaaaaadddddddddddddddddd
		for (var field in storageFields) {
		var item = localStorage.getItem(storageFields[field])
		if (item != null  && (typeof item !== 'undefined') && item != 'undefined') {
			$('#' + storageFields[field]).val(item);
			makeCallAtEnd = true;
		}
	}
	}

    $("#datepicker").datepicker();
    $("#rider_history").load("app/rider_scripts/history_rider_page.php");
    $("#interested_drivers").load("app/rider_scripts/interested_driver.php");
//     $("#pending_rides_rider").load("pending_rides_rider.php");
    $("#invite_await_response_rider").load("app/rider_scripts/invite_await_response_rider.php");
    $("#confirmed_rides_rider").load("app/rider_scripts/update_confirm_rider.php");
    $("#submit_rider").click(function()
  	{
  		var day_in_unix = $("#datepicker").datepicker("getDate").getTime()/1000;//it works
  		var start_hour_in_unix = $("#startTimeHour").val();
  		var start_min_in_unix =  $("#startTimeMin").val();
  		var end_hour_in_unix = $("#endTimeHour").val();
  		var end_min_in_unix = $("#endTimeMin").val();
  		var startTime = day_in_unix + (start_hour_in_unix)*3600 + (start_min_in_unix)*60; 
  	    var endTime = day_in_unix + (end_hour_in_unix)*3600 + (end_min_in_unix)*60; 
  	    var locationFrom=$("#locFrom").val();
  	    var locationTo=$("#locTo").val();
  	    var locationFromUpper=locationFrom.toUpperCase();; 
  	    var locationToUpper=locationTo.toUpperCase();;  
  	    $("#update").empty();
   		$.ajax(
      	{
            url: "app/rider_scripts/insert_match_rider_page.php",
            type: "POST",
        	data:
        	{
            	//locFrom: $("#locFrom").val(),
               // locTo: $("#locTo").val(),
                locFrom: locationFromUpper,
                locTo: locationToUpper,
                timeFrom: startTime,
                timeTo: endTime,
                date: $("#datepicker").val(),
                sort: $("#sort-list").val(),
        	},
            dataType: "text",
        	success: function(dat)
        	{	
        		// if (localStorage.getItem(storageFields[field])!=null){//addddddddddddeeddeded
	        		for (var field in storageFields) {
	        			localStorage.setItem(storageFields[field], $('#' + storageFields[field]).val());
					}
				// }
        		// localStorage.setItem("loc_from", $("#locFrom").val());
        		// localStorage.setItem("loc_to", $("#locTo").val());
        		// localStorage.setItem("start_hour_in_unix", start_hour_in_unix);
        		// localStorage.setItem("start_min_in_unix", start_min_in_unix);
        		// localStorage.setItem("end_hour_in_unix", end_hour_in_unix);
        		// localStorage.setItem("end_min_in_unix", end_min_in_unix);

        		$("#rider_history").load("app/rider_scripts/history_rider_page.php"); 
        		$("#interested_drivers").load("app/rider_scripts/interested_driver.php");
        		//$("#update").html("<span style='color:green;'>Your request is recorded! </span>");
				$("#result").html(dat);
        	}
    	});	

	}); 
		// if (localStorage.getItem(storageFields[field])!=null){
			if (makeCallAtEnd) {
				$("#submit_rider").click();
			}
		// }

});

function sendRequest_Rider(driver_event_id,driver_id,rider_event_id,rider_id) {
	$.ajax(
    {
        url: "app/sendRequest.php",
	    type: "POST",
    	data:
        {
        	DriverEventID: driver_event_id,
        	DriverID: driver_id,
        	RiderEventID: rider_event_id,
        	RiderID: rider_id,
        	WhoRequestThis: 2, // rider
        },
        dataType: "text",
        success: function(dat)
        {
// 			$("#pending_rides_rider").load("pending_rides_rider.php");
			$("#invite_await_response_rider").load("app/rider_scripts/invite_await_response_rider.php");
        	alert("Request sent!");
        	console.log(dat);
        },
        failure: function(dat)
        {
        	console.log(dat);
        }
    });
}

function deleteOffer_Rider(rider_event_id) {
	$.ajax(
    {
        url: "app/deleteOffer.php",
	    type: "POST",
    	data:
        {
        	RiderEventID: rider_event_id,
        	
        },
        dataType: "text",
        success: function(dat)
        {
        	$("#rider_history").load("app/rider_scripts/history_rider_page.php");
        	$("#invite_await_response_rider").load("app/rider_scripts/invite_await_response_rider.php");
        	alert("Deleted!");
        	console.log(dat);
        	
        },
        failure: function(dat)
        {
        	console.log(dat);
        }
    });
}

function confirm(driver_event_id,driver_id,rider_event_id,rider_id) {
	$.ajax(
    {
        url: "app/confirm.php",
	    type: "POST",
    	data:
        {
        	DriverEventID: driver_event_id,
        	DriverID: driver_id,
        	RiderEventID: rider_event_id,
        	RiderID: rider_id,
        	
        },
        dataType: "text",
        success: function(dat)
        {
        	alert("Confirm!");
        	console.log(dat);
        	$("#interested_drivers").load("app/rider_scripts/interested_driver.php");
        	$("#confirmed_rides_rider").load("app/rider_scripts/update_confirm_rider.php");
        	$("#invite_await_response_rider").load("app/rider_scripts/invite_await_response_rider.php");
        },
        failure: function(dat)
        {
        	console.log(dat);
        }
    });
}
</script>
</head>

<style type = "text/css">

</style>
<div class = "home">
	<div class = "fixed-width-centered">
		<div class="topline">		
		</div>
		<div class = "general_from_to">
			<div class="input-group">
        		<span class="input-group-addon-homes"><i class="fa fa-location-arrow fa-fw"></i></span>
        		<input class="form-control-homes" type='text' id = 'locFrom' placeholder= "From"/>
      		</div>
      		<div class="input-group">
        		<span class="input-group-addon-homes"><i class="fa fa-location-arrow fa-fw"></i></span>
        		<input class="form-control-homes" type='text' id = 'locTo' placeholder = "To"/>
      		</div>
			<div class="input-group">
        		<span class="input-group-addon-homes"><i class="fa fa-calendar-o fa-fw"></i></span>
        		<input class="form-control-departs" type="text" id="datepicker" placeholder = "Depart"/>
      		</div>
      	</div>
      	<div class="hours">
			<select class = "times" id='startTimeHour'>
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
			<select class = "times" id='startTimeMin'>
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
			<span>-</span>
			<select class = "times"  id='endTimeHour'>
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
			<select class = "times" id='endTimeMin'>
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
		</div>
		<div class = "sort">
			<select class= "types" name='SortList' id='sort-list'>
				<option value="lowprice">Lowest Price</option>
				<option value="earlytime">Earliest Time</option>
				<option value="latetime">Latest Time</option>
			</select>
		</div>
		<div class= "sort">
			<a class="search_button" id="submit_rider"><i class="fa fa-search fa-fw"></i> Search &nbsp;</a>
		</div>
		<div style ="clear: both;"></div>
		<div class = "forms">
			<div id="update"></div>
			<div id="result"></div>
			<div id="rider_history"></div>
			<div id="invite_await_response_rider"></div>
			<div id="interested_drivers"></div>
			<div id="confirmed_rides_rider"></div>
		</div>
		<div style ="clear: both;"></div>
</div>
</div>


