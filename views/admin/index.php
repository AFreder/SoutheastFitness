<div id="sidebar">
	<ul>
		<li class="active"><a href="index"><i class="icon icon-home"></i> <span>Home</span></a></li>
		<li><a href="cuEvent"><i class="icon icon-edit"></i> <span>Create Event</span></a></li>				
		<li><a href="manageAffiliates"><i class="icon icon-th-large"></i> <span>Manage Affiliates</span></a></li>
		<li><a href="manageSponsors"><i class="icon icon-tags"></i> <span>Manage Sponsors</span></a></li>
	</ul>		
</div>
<div id="contentUni">
<br />
<div id="breadcrumb">
	<a href="index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
	>
	<a href="#" class="current">Dashboard</a>
</div>
<?php 	
	$es = new EventService;
	if(sizeof($model) > 0)
	{
		foreach($model as $event)
		{
			$cs = new CompetitorService();
			$numFemales = $cs->getNumFemalesForEvent($event['id']);
			$numMales = $cs->getNumMalesForEvent($event['id']);
			if(!isset($event['image']))
				$image = Yii::app()->request->baseUrl.'/img/site_logo_circle.png';
			else
				$image = Yii::app()->request->baseUrl.'/uploads/'.$event['image'];
			echo '<br /><br />
				  <table style="width:90%" class="offsetHalf">
					<tr>
						<td style="height:232px; width:232px;">
							<div class="widget-box">			      							
								<img style="height:232px; width:232px;" src="'.$image.'" />
			      			</div>
			      		<td>
			      		<td>
				  			<div class="widget-box span6">
								<div class="widget-title">						
									<div class="offsetHalf">							
										<h3>'.$event['name'].'</h3>
									</div>
								</div>
		      					<br/>
		        				<table class="offsetHalf">
			        				<tr>
		        						<td style="width:25%">
			        						<h6>When: </h6> 
		        						</td>
		        						<td style="padding-left:10px"><h7>'.
			        						$es->formatMonthDate($event['start_date']).'
		        							at '.$event['start_hour'].':'.$event['start_minute'].' '.$event['start_am_pm'].'
		        						</h7></td>
		        					</tr>		        							        		
		        					<tr>
			        					<td>
		        							<h6># Signed Up: </h6> 
		        						</td>
		        						<td style="padding-left:10px"><h7>Men: '.
			        						$numMales[0]['count'].'<div style="display:inline-block; padding-left:20px">Women: '. $numFemales[0]['count'].'</div>
		        						</h7></td>
		        					</tr>
		        					<tr>
			        					<td><br /><a href="UpdateEvent?id='.$event['id'].'" class="btn btn-primary btn-small">Update</a></td>
		        						<td><br /><a onclick="return deleteEvent()" href="deleteEvent?id='.$event['id'].'" class="btn btn-danger btn-small">Delete</a></td>
		        						<td><br /><a href="CreateEventReport?id='.$event['id'].'" class="btn btn-success btn-small">Create Report</a></td>
		        						<td><br /><a href="manageEventSponsors?id='.$event['id'].'" class="btn btn-warning btn-small">Manage Sponsors</a></td>
		        					</tr>
		        				</table>	      	
		      					<br/>		      
		      				</div>
			        	</td>
			        </tr>
				  </table>';
		}
	}
	else echo '<br /><br /><h6 class="offset1">No Upcoming Events Found</h6>';	
?>
<br />
</div>
<script type="text/javascript">

    function deleteEvent () 
    {
    	return confirm("Are you sure you wish to delete this event?\n\n"+
						"You will lose all information associated with this event.\n\n"+
    					"WARNING: This action cannot be undone.");
    }
</script>
<?php echo Yii::app()->basePath; ?>