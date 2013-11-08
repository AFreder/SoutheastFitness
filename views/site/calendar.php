<link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->request->baseUrl; ?>/css/eventCalendar/fullcalendar.css' />
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/css/eventCalendar/fullcalendar.js'></script>

<br />	  							    					
<div  class="offset1 span10 well">
	<div id="breadcrumb">
		<a href="index"><i class="icon-home"></i> Southeast Fitness</a>
		>
		<a href="#" class="current">Event Calendar</a>		
	</div>
	<br />
	<div id='calendar'></div>	
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#calendar').fullCalendar({
		header: 
		{
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		events: 
		[
			<?php		
				foreach($events as $event)
				{
					if($event['start_am_pm'] == 'PM' && $event['start_hour'] != '12')
						$start_time = ' '.($event['start_hour']+12).':'.$event['start_minute'].':00';
					else
						$start_time = ' '.$event['start_hour'].':'.$event['start_minute'].':00';
					if($event['end_am_pm'] == 'PM' && $event['end_hour'] != '12')
						$end_time = ' '.($event['end_hour']+12).':'.$event['end_minute'].':00';
					else
						$end_time = ' '.$event['end_hour'].':'.$event['end_minute'].':00';
						
					echo '	{
								title : \''.$event['name'].'\',
								start : \''.$event['start_date'].$start_time.'\',
								end : \''.$event['end_date'].$end_time.'\',
								allDay : false, 
								url : \''.Yii::app()->request->baseUrl.'/index.php/site/eventDetails?id='.$event['id'].'\' 
							},';
				} 
			
			?>
		],
	 	eventClick: function(event) 
	 	{
	        if (event.url) 
		    {
	            window.open(event.url);
	            return false;
	        }
	 	} 	
    })

});
</script>