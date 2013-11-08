<?php
$this->pageTitle='Event Registration';
$es = new EventService;
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
<br />
<div class="offset2 well span8">
<div id="breadcrumb">
	<a href="index"><i class="icon-home"></i> Southeast Fitness</a>
	>
	<a href="index"><?php echo $event->name;?></a>
	>
	<a href="#" class="current">Event Registration</a>
</div>
<br />
<div class="well2">
	<table >
		<tr>
			<td style="padding-left:20px" class="span3">				
				<h5>Event Name</h5>				
				<h7><?php echo $event->name;?></h7>				
			</td>
		</tr>
		<tr>
			<td style="padding-left:20px"  colspan="2">
				<h5>Event Description</h5>				
				<h7><?php echo $event->description; ?></h7>	
			</td>
		</tr>
		<tr>
			<td style="padding-left:20px; vertical-align:top">
				<h5>Location</h5>							
				<h7><?php echo $event->venue;?><br />
				<?php echo $event->address; ?><br />
				<?php echo $event->city.', '.$event->state; ?></h7>
			</td>
		</tr>
		<tr>
			<td style="padding-left:20px" >
    	    	<h5>Start Time:</h5>    
    			<h7><?php echo $es->formatMonthDate($event->start_date).'
		        				at '.$event->start_hour.':'.$event->start_minute.' '.$event->start_am_pm;?></h7>    			
    		</td>
    		<td style="border-left:0px">
    	    	<h5>End Time:</h5>    
    			<h7><?php echo $es->formatMonthDate($event->end_date).'
		        				at '.$event->end_hour.':'.$event->end_minute.' '.$event->end_am_pm;?></h7>
    		</td>		    
		</tr>
		<tr>
			<td style="padding-left:20px" >
				<h5 class="">Registration fee:</h5>
				<h7><?php if($event->fee_ind == 'N') echo 'Free'; else echo '$'.$event->fee_amount;?></h7>
			</td>
		</tr>
		<?php 
			if(sizeof($sponsors) > 0)
			{
				echo '<tr>
						<td style="padding-left:20px" colspan="2">
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
	</table>
</div>
	<hr class="span7" />
	<table>	
		<tr>
			<td colspan="2">
				<div class="alert-error"><?php echo $regError; ?></div>
			</td>
		</tr>			
		<tr>
			<td><h5>First Name*</h5></td>
			<td style="padding-left:25px"><h5>Last Name*</h5></td>
		</tr>
		<tr>
			<td>
				<div class="alert-error"><?php echo $form->error($model,'first_name'); ?></div>				
				<?php echo $form->textField($model,'first_name'); ?>				
			</td>
			<td style="padding-left:25px">
				<div class="alert-error"><?php echo $form->error($model,'last_name'); ?></div>				
				<?php echo $form->textField($model,'last_name'); ?>				
			</td>
		</tr>
		<tr>
			<td><h5>Gender*</h5></td>			
		</tr>
		<tr>
			<td>
				<div class="alert-error"><?php echo $form->error($model,'gender'); ?></div>				
				<?php echo $form->radioButtonList($model,'gender',array('M'=>'Male','F'=>'Female'),array('separator'=>'', 'labelOptions'=>array('style'=>'padding-right:20px;display:inline')));?>																							
			</td>
		</tr>
		<tr>
			<td><br /><h5>Email*</h5></td>			
		</tr>
		<tr>
			<td>
				<div class="alert-error"><?php echo $form->error($model,'email'); ?></div>				
				<?php echo $form->textField($model,'email'); ?>				
			</td>
		</tr>
		<tr>
			<td><h5>Confirm Email*</h5></td>			
		</tr>
		<tr>
			<td>
				<div class="alert-error"><?php echo $form->error($model,'verifyEmail'); ?></div>				
				<?php echo $form->textField($model,'verifyEmail'); ?>				
			</td>
		</tr>	
		<?php 
			if($event->tshirt_ind == 'Y')
			{
				echo '<tr>
						<td><br /><h5>Shirt Size*</h5></td>			
					  </tr>
					  <tr>
						<td>
							<div class="alert-error">'.$form->error($model,'shirt_size').'</div>				
							'.$form->dropDownList($model,'shirt_size', array(''=>'Select One'
																			 , 'S'=>'Small'
																			 , 'M'=>'Medium'
																			 , 'L'=>'Large'
																			 , 'XL'=>'Extra Large'
																			 , 'XXL'=>'2X Large')).'																									
						</td>
					  </tr>';
			}			
		?>
		<?php 
			if($event->division_ind == 'Y')
			{
				echo '<tr>
						<td><br /><h5>Division*</h5></td>			
					  </tr>
					  <tr>
						<td>
							<div class="alert-error">'.$form->error($model,'division').'</div>				
							'.$form->dropDownList($model,'division', array(''=>'Select One'
																			 , 'RX'=>'RX'
																			 , 'Scaled'=>'Scaled')).'																									
						</td>
					  </tr>';
			}			
		?>
		<?php 
			if($event->team_ind == 'Y')
			{
				echo '<tr>
						<td><br /><h5>Affiliate Name*</h5></td>	
						<td><br /><h5>Team Number*</h5></td>		
					  </tr>
					  <tr>
						<td>
							<div class="alert-error">'.$form->error($model,'team_name').'</div>				
							'.$form->dropDownList($model,'team_name', CHtml::listData($affiliate,'name','name'), array('empty'=>'Select One') ).'																									
						</td>
						<td>
							<div class="alert-error">'.$form->error($model,'team_number').'</div>				
							'.$form->dropDownList($model,'team_number', array(''=>'Select One'
				 															  , '1'=>'1'
				 															  , '2'=>'2'
				 															  , '3'=>'3'
				 															  , '4'=>'4')).'
						</td>
					  </tr>';
			}			
		?>
		<tr>
			<td><h5>Verify Code*</h5></td>			
		</tr>
		<tr>		
			<td colspan="2">							
				<div class="alert-error"><?php echo $form->error($model,'verifyCode'); ?></div>
   				<?php echo $form->textField($model,'verifyCode'); ?>
   				<?php $this->widget('CCaptcha', array('buttonLabel'=>' refresh')); ?>
   			</td>
   		</tr>   
		<tr>
			<td>
				<br />
				<br />
				<br />
				<input id="Competitor_event_id" name="Competitor[event_id]" type="hidden" value="<?php echo $event->id; ?>" />
				<input class="btn btn-primary" value="Submit" type="submit">
				<a class="btn" href="<?php echo Yii::app()->request->baseUrl;?>/index.php">Cancel</a>
			</td>
		</tr>
</table>
</div><!-- form -->
<?php $this->endWidget(); ?>
</div>
