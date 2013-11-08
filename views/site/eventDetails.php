<?php
$this->pageTitle='Event Details';
$es = new EventService;
?>
<br />
<div class="offset2 well span8">
<div id="breadcrumb">
	<a href="index"><i class="icon-home"></i> Southeast Fitness</a>
	>
	<a href="index"><?php echo $model->name;?></a>
	>
	<a href="#" class="current">Event Details</a>
</div>
<br />
<div class="well2">
	<table>
		<tr>
			<td>
				<div style="height:225px; width:225px;" class="well">			      							
					<img style="height:225px; width:225px;" src="<?php 
						if(!isset($model->image))
							$image = Yii::app()->request->baseUrl.'/img/site_logo_circle.png';
						else
							$image = Yii::app()->request->baseUrl.'/uploads/'.$model->image;
							echo $image;?>" />
				</div>
			<td>
		</tr>
		<tr>
			<td class="span3">				
				<h5>Event Name</h5>				
				<h7><?php echo $model->name;?></h7>				
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<h5>Event Description</h5>				
				<h7><?php echo $model->description; ?></h7>	
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<h5>Venue</h5>				
				<h7><?php echo $model->venue; ?></h7>	
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top" colspan="2">
				<h5>Location</h5>							
				<h7><?php echo $model->address. ' '.$model->unit; ?><br />
				<?php echo $model->city.', '.$model->state; ?></h7>							
				<br />
				<br />
				<iframe class="span7" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $model->address.' '.$model->city.' '.$model->state;?>&amp;output=embed"></iframe>
			</td>
		</tr>
		<tr>
			<td>
    	    	<h5>Start Time:</h5>    
    			<h7><?php echo $es->formatMonthDate($model->start_date).'
		        				at '.$model->start_hour.':'.$model->start_minute.' '.$model->start_am_pm;?></h7>    			
    		</td>
    		<td>
    	    	<h5>End Time:</h5>    
    			<h7><?php echo $es->formatMonthDate($model->end_date).'
		        				at '.$model->end_hour.':'.$model->end_minute.' '.$model->end_am_pm;?></h7>    			
    		</td>		    
		</tr>
		<tr>
			<td>
				<h5 class="">Are T-Shirts Available?</h5>
				<h7><?php if($model->tshirt_ind == 'N') echo 'No'; else echo 'Yes'; ?></h7>
			</td>
		</tr>
		<tr>
			<td>
				<h5 class="">Registration fee:</h5>
				<h7><?php if($model->fee_ind == 'N') echo 'Free'; else echo '$'.$model->fee_amount;?></h7>						  
			</td>
		</tr>
		<tr>
			<td>			
				<h5>Spots Available: </h5>				
				<h7><?php 								
					if(sizeof($numberRegistered) > 0 || $model->max_athletes == 0)
					{
						foreach($numberRegistered as $nr) 
						{						
							if($model->max_athletes != 0) $numAvailable = $model->max_athletes - $nr['count'].' out of '.$model->max_athletes;
							else $numAvailable = 'Unlimited';
							$numReg = $nr['count'];					
						}
						if($model->max_athletes == 0)
							$numAvailable = 'Unlimited'; 
						
					}
					else
					{	
						$numAvailable = $model->max_athletes.' out of '.$model->max_athletes;
						$numReg = 0;
					}
				    echo $numAvailable; ?></h7>				
			</td>
		</tr>
		<?php 
			if($model->comments != '') 
			{
				echo '<tr>
						<td>
							<h5 class="">Additional Comments:</h5> 
							<h7>'.$model->comments.'</h7>						  
						</td>
					  </tr>';
			}
			if(sizeof($sponsors) > 0)
			{
				echo '<tr>
						<td colspan="2">
							<h5>Event Sponsors</h5>';
				foreach($sponsors as $sponsor)
				{
					echo '<div style="padding-top:10px" class="span1half">';
					if($sponsor['website'] != '')
					{
						echo '<a href="http://'.$sponsor['website'].'" target="_blank">
								<img style="height:125px; width:125px;" src="'.Yii::app()->request->baseUrl.'/uploads/'.$sponsor['image'].'" />
					      	  </a>';							
					}
					else
						echo '<img style="height:125px; width:125px;" src="'.Yii::app()->request->baseUrl.'/uploads/'.$sponsor['image'].'" />';
					      		
					echo '</div>';					
				}
				echo '</td></tr>';
			}	
		?>
		<tr>
			<td>
				<br />
				<br />
				<?php if($numReg < $model->max_athletes || $model->max_athletes == 0) echo '<a href="'.Yii::app()->request->baseUrl.'/index.php/site/eventRegistration?id='.$model->id.'" class="btn btn-primary btn-small">Register</a>';?>
			</td>
		</tr>			
</table>
</div><!-- form -->
</div>
</div>
