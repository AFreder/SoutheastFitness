<br />	  							    					
<div  style="padding-right:20px;" class="carousel-caption offset1 span10 well">
	<table>
	<tr>
		<td>
			<img style="padding-left:50px;width:377px;height:380px" src="<?php echo Yii::app()->request->baseUrl;?>/img/site_logo_circle.png">		
			<!--<iframe style="padding-left:40px;" src="http://games.crossfit.com/games-widget" width="377" height="380" frameborder="0" scrolling="no" style="border:4px solid #453536;">If you can see this, your browser doesn't understand iframes. <a href="http://games.crossfit.com"</a> to the widget.</iframe> -->			
		</td>
	    <td style="padding-left:60px" class="span4">				    						
   			<div style="float:right;">
   				<br />
   				<h1>Southeast Fitness</h1>
   				<p>We provide information on all the local throwdowns along with the ability to sign up to compete in them!
   		   		Sign up and compete with some of the best athletes in your area and test your mettle against
   		   		the fittest in the southeast!</p><br /><br />
   				<br />
   				<br />
   				<a class="btn btn-primary" href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/calendar">Event Calendar</a>
   			</div>
   		</td>
   	</tr> 
   	</table>   						    						    				    					
</div>     				  			
<?php 
	$es = new EventService;
	if(sizeof($model) > 0)
	{
		echo '<div class="offset1 span10 well1">';
		foreach($model as $event)
		{
			if($event['count'] > 0 || $event['max_athletes'] == 0)
			{
				if($event['max_athletes'] != 0) $numAvailable = $event['max_athletes'] - $event['count'].' out of '.$event['max_athletes'];
				else $numAvailable = 'Unlimited';
				$numReg = $event['count'];				
			}
			else
			{
				$numAvailable = $event['max_athletes'].' out of '.$event['max_athletes'];
				$numReg = 0;							
			}
			if($numReg < $event['max_athletes'] || $event['max_athletes'] == 0)
				$registerButton = '<td><br /><a href="'.Yii::app()->request->baseUrl.'/index.php/site/eventRegistration?id='.$event['id'].'" class="btn btn-primary btn-small">Register</a></td>';
			else
				$registerButton = '';
			if(!isset($event['image']))
				$image = Yii::app()->request->baseUrl.'/img/site_logo_circle.png';
			else
				$image = Yii::app()->request->baseUrl.'/uploads/'.$event['image'];
			echo '<table style="width:90%;" class="offsetHalf">
					<tr>
						<td>
							<div style="height:225px; width:225px;" class="well">			      							
								<img style="height:225px; width:225px;" src="'.$image.'" />
			      			</div>
			      		<td>
			      		<td>
				  			<div class="widget-box span5">
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
		        							<h6>Venue: </h6> 
		        						</td>
		        						<td style="padding-left:10px"><h7>'.
			        						$event['venue'].'
		        						</h7></td>
		        					</tr>
		        					<tr>
			        					<td>
		        							<h6>Address: </h6> 
		        						</td>
		        						<td style="padding-left:10px"><h7>'.
			        						$event['address'].' '.$event['unit'].'<br />'.$event['city'].', '.$event['state'].'<br /><a target="_blank" href="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q='.$event['address'].' '.$event['city'].' '.$event['state'].'">View Map</a>			        						
		        						</h7></td>
		        					</tr>		        		
		        					<tr>
			        					<td>
		        							<h6>Spots Available: </h6> 
		        						</td>
		        						<td style="padding-left:10px"><h7>'.
			        						$numAvailable.'
		        						</h7></td>
		        					</tr>
		        					<tr>
			        						'.$registerButton.'
			        					<td>
			        						<br />
			        		    			<a href="'.Yii::app()->request->baseUrl.'/index.php/site/eventDetails?id='.$event['id'].'" class="btn btn-warning btn-small">Event Details</a></td>
			        					</td>		        			
		        					</tr>
		        				</table>	      	
		      					<br/>		      
		      				</div>
			        	</td>
			        </tr>
				  </table>';
		}
	}	
?>
</div>
