	
	<?php
	$medicos_string = "";
	foreach($medicos as $m)
		$medicos_string.= "'{$m[nombre]} {$m[apellido_paterno]} {$m[apellido_materno]}', ";
	$medicos_string = substr($medicos_string,0,(strlen($medicos_string)-2) );
	
	$citas_string = "";
	$contador = 1;
	foreach($citas as $c)
	{
		//print_r($c);
		$fecha1 = strtotime($c[fecha_inicio]);
			$fecha1 = date('Y, m, d, H, i, s', $fecha1);
		$fecha2 = strtotime($c[fecha_fin]);
			$fecha2 = date('Y, m, d, H, i, s', $fecha2);
		$citas_string.= 
			"{
				\"id\":{$contador}, 
				\"start\" : new Date({$fecha1}),
				\"end\" : new Date({$fecha2}),
				\"title\": \"{$c[observaciones]}\", 
				userId: 0
			}, ";
		//$contador++;
	}
	$citas_string = substr($citas_string,0,(strlen($citas_string)-2) );
	
	?>
	<link rel='stylesheet' type='text/css' href='http://themouette.github.io/jquery-week-calendar/libs/css/smoothness/jquery-ui-1.8.11.custom.css' />

	<link rel="stylesheet" type="text/css" href="http://themouette.github.io/jquery-week-calendar/jquery.weekcalendar.css" />
	<link rel="stylesheet" type="text/css" href="http://themouette.github.io/jquery-week-calendar/skins/default.css" />
	<link rel="stylesheet" type="text/css" href="http://themouette.github.io/jquery-week-calendar/skins/gcalendar.css" />
	<style type="text/css">
		body {
			font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
			margin: 0;
		}
		
		h1 {
      margin:0 0 2em;
			padding: 0.5em;
			font-size: 1.3em;
		} 
		
		p.description {
			font-size: 0.8em;
			padding: 1em;
			position: absolute;
			top: 1.2em;
			margin-right: 400px;
		}
		
		#calendar_selection {
			font-size: 0.7em;
			position: absolute;
			top: 1em; 
			right: 1em;
			padding: 1em;
			background: #ffc;
			border: 1px solid #dda;
			width: 270px;
		}
		
		#message {
			font-size: 0.7em;
			position: absolute;
			top: 1em; 
			right: 320px;
			padding: 1em;
			background: #ddf;
			border: 1px solid #aad;
			width: 270px;
		}
	</style>
	
	   <!--
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js'></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js'></script>
    -->

   <script type='text/javascript' src='http://themouette.github.io/jquery-week-calendar/libs/jquery-1.4.4.min.js'></script>
   <script type='text/javascript' src='http://themouette.github.io/jquery-week-calendar/libs/jquery-ui-1.8.11.custom.min.js'></script>
   <script type='text/javascript' src='http://themouette.github.io/jquery-week-calendar/libs/jquery-ui-i18n.js'></script>

	<script type="text/javascript" src="http://themouette.github.io/jquery-week-calendar/libs/date.js"></script>
	<script type="text/javascript" src="http://themouette.github.io/jquery-week-calendar/jquery.weekcalendar.js"></script>
	<script type="text/javascript">
  (function($) {
		var d = new Date();
		d.setDate(d.getDate() - d.getDay());
		var year = d.getFullYear();
		var month = d.getMonth();
		var day = d.getDate();
	
		var eventData1 = {
			options: {
				timeslotsPerHour: 3,
				timeslotHeight: 20,
				defaultFreeBusy: {free: true}
			},
			
			events: [<?=$citas_string?>]
			/*
			events : [
				{"id":1, "start": new Date(year, month, day+0, 12), "end": new Date(year, month, day+0, 13, 30), "title": "Lunch with Mike", userId: 0},
				{"id":2, "start": new Date(year, month, day+0, 14), "end": new Date(year, month, day+0, 14, 45), "title": "Dev Meeting", userId: 1},
				{"id":3, "start": new Date(year, month, day+1, 18), "end": new Date(year, month, day+1, 18, 45), "title": "Hair cut", userId: 1},
				{"id":4, "start": new Date(year, month, day+2, 08), "end": new Date(year, month, day+2, 09, 30), "title": "Team breakfast", userId: 0},
				{"id":5, "start": new Date(year, month, day+1, 14), "end": new Date(year, month, day+1, 15, 00), "title": "Product showcase", userId: 1}
			],
			freebusys: [
				{"start": new Date(year, month, day+0, 00), "end": new Date(year, month, day+3, 00, 00), "free": false, userId: [0,1,2,3]},
				{"start": new Date(year, month, day+0, 08), "end": new Date(year, month, day+0, 12, 00), "free": true, userId: [0,1,2,3]},
				{"start": new Date(year, month, day+1, 08), "end": new Date(year, month, day+1, 12, 00), "free": true, userId: [0,1,2,3]},
				{"start": new Date(year, month, day+2, 08), "end": new Date(year, month, day+2, 12, 00), "free": true, userId: [0,1,2,3]},
				{"start": new Date(year, month, day+1, 14), "end": new Date(year, month, day+1, 18, 00), "free": true, userId: [0,1,2,3]},
				{"start": new Date(year, month, day+2, 08), "end": new Date(year, month, day+2, 12, 00), "free": true, userId: [0,3]},
				{"start": new Date(year, month, day+2, 14), "end": new Date(year, month, day+2, 18, 00), "free": true, userId: 1}
			]
			*/
		};
	
		d = new Date();
		d.setDate(d.getDate() -(d.getDay() - 3));
		year = d.getFullYear();
		month = d.getMonth();
		day = d.getDate();
	
		var eventData2 = {
			options: {
				timeslotsPerHour: 3,
				timeslotHeight: 30,
				defaultFreeBusy: {free: false}
			},
			events : [
				{"id":1, "start": new Date(year, month, day+0, 12), "end": new Date(year, month, day+0, 13, 00), "title": "Lunch with Sarah", userId: 1},
				{"id":2, "start": new Date(year, month, day+0, 14), "end": new Date(year, month, day+0, 14, 40), "title": "Team Meeting", userId: 0},
				{"id":3, "start": new Date(year, month, day+1, 18), "end": new Date(year, month, day+1, 18, 40), "title": "Meet with Joe", userId: 1},
				{"id":4, "start": new Date(year, month, day-1, 08), "end": new Date(year, month, day-1, 09, 20), "title": "Coffee with Alison", userId: 1},
				{"id":5, "start": new Date(year, month, day+1, 14), "end": new Date(year, month, day+1, 15, 00), "title": "Product showcase", userId: 0}
			],
			freebusys: [
				{"start": new Date(year, month, day-1, 08), "end": new Date(year, month, day-1, 18, 00), "free": true, userId: [0,1,2,3]},
				{"start": new Date(year, month, day+0, 08), "end": new Date(year, month, day+0, 18, 00), "free": true, userId: [0,1,2,3]},
				{"start": new Date(year, month, day+1, 08), "end": new Date(year, month, day+1, 18, 00), "free": true, userId: [0,3]},
				{"start": new Date(year, month, day+2, 14), "end": new Date(year, month, day+2, 18, 00), "free": true, userId: 1}
			]
		};
	
		function updateMessage() {
			var dataSource = $('#data_source').val();
			$('#message').fadeOut(function() {
				if(dataSource === "1") {
					$('#message').text("Displaying event data set 1 with timeslots per hour of 4 and timeslot height of 20px. Moreover, the calendar is free by default.");
				} else if(dataSource === "2") {
					$('#message').text("Displaying event data set 2 with timeslots per hour of 3 and timeslot height of 30px. Moreover, the calendar is busy by default.");
				} else {
					$('#message').text("Displaying no events.");
				}
				$(this).fadeIn();
			});
		}
		
		$(document).ready(function() {
	
			var $calendar = $('#calendar').weekCalendar({
				timeslotsPerHour: 4,
				scrollToHourMillis : 0,
				height: function($calendar){
					return $(window).height() - $('h1').outerHeight(true);
				},
				eventRender : function(calEvent, $event) {
					if(calEvent.end.getTime() < new Date().getTime()) {
						$event.css("backgroundColor", "#aaa");
						$event.find(".wc-time").css({backgroundColor: "#999", border:"1px solid #888"});
					}
				},
				eventNew : function(calEvent, $event, FreeBusyManager, calendar) {
					var isFree = true;
					$.each(FreeBusyManager.getFreeBusys(calEvent.start, calEvent.end), function(){
						if(
							this.getStart().getTime() != calEvent.end.getTime()
							&& this.getEnd().getTime() != calEvent.start.getTime()
							&& !this.getOption('free')
						){
							isFree = false; return false;
						}
					});
					if(!isFree) {
						alert('looks like you tried to add an event on busy part !');
						$(calendar).weekCalendar('removeEvent',calEvent.id);
						return false;
					}
					calEvent.id = calEvent.userId +'_'+ calEvent.start.getTime();
					alert("You've added a new event. You would capture this event, add the logic for creating a new event with your own fields, data and whatever backend persistence you require.");
					$(calendar).weekCalendar('updateFreeBusy', {userId: calEvent.userId, start: calEvent.start, end: calEvent.end, free:false});
				},
				data: function(start, end, callback) {
					var dataSource = $('#data_source').val();
					if(dataSource === "1") {
						callback(eventData1);
					} else if(dataSource === "2") {
						callback(eventData2);
					} else {
						callback({options: {defaultFreeBusy:{free:true}}, events: []});
					}
	            },
				users: ['user 1', 'user 2', 'long username', 'user 4'],
				showAsSeparateUser: true,
				displayOddEven: true,
				displayFreeBusys: true,
				daysToShow: 7,
				switchDisplay: {'1 day': 1, '3 next days': 3, 'work week': 5, 'full week': 7},
        headerSeparator: ' ',
        useShortDayNames: true,
        // I18N
        firstDayOfWeek: $.datepicker.regional['fr'].firstDay,
        shortDays: $.datepicker.regional['fr'].dayNamesShort,
        longDays: $.datepicker.regional['fr'].dayNames,
        shortMonths: $.datepicker.regional['fr'].monthNamesShort,
        longMonths: $.datepicker.regional['fr'].monthNames,
        dateFormat: "d F y"
			});
	
			$('#data_source').change(function() {
				$calendar.weekCalendar("refresh");
				updateMessage();
			});
			
			updateMessage();
		});
  })(jQuery);
	</script>
</head>
<body>
	<h1>Week Calendar Demo</h1>
	<p class="description">This calendar demonstrates the differents new options that allow user management and freebusy display / computation.</p>
	<div id="message" class="ui-corner-all"></div>
	<div id="calendar_selection" class="ui-corner-all">
		<strong>Event Data Source: </strong>
		<select id="data_source">
			<option value="">Select Event Data</option>
			<option value="1">Event Data 1</option>
			<option value="2">Event data 2</option>
		</select>
	</div>
	<div id="calendar"></div>
