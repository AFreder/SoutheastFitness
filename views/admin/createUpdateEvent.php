<div id="sidebar">
	<ul>
		<li><a href="index"><i class="icon icon-home"></i> <span>Home</span></a></li>
		<li class="active"><a href="createEvent"><i class="icon icon-edit"></i> <span>Create Event</span></a></li>
		<li><a href="manageAffiliates"><i class="icon icon-th-large"></i> <span>Manage Affiliates</span></a></li>
		<li><a href="manageSponsors"><i class="icon icon-tags"></i> <span>Manage Sponsors</span></a></li>				
	</ul>		
</div>
<div id="contentUni">
<br />
<?php
$this->pageTitle='Create Event';
$this->breadcrumbs=array(
	'Login',
);
?>

<div id="breadcrumb">
	<a href="index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
	>
	<a href="#" class="current">Create Event</a>
</div>
<br />
<div class="offsetHalf well">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'event-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
	<table>
		<tr>
			<td>				
				<h6>Event Name*</h6>
				<div class="alert-error"><?php echo $form->error($model,'name'); ?></div>
				<?php echo $form->textField($model,'name'); ?>				
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<h6>Event Description*</h6>
				<div class="alert-error"><?php echo $form->error($model,'description'); ?></div>
				<?php echo $form->textArea($model,'description', array('style'=>'width:300px;height:35px')); ?>	
			</td>
		</tr>
		<tr>
			<td>
				<h6>Venue*</h6>
				<div class="alert-error"><?php echo $form->error($model,'venue'); ?></div>				
				<?php echo $form->textField($model,'venue'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<h6>Address*</h6>
				<div class="alert-error"><?php echo $form->error($model,'address'); ?></div>				
				<?php echo $form->textField($model,'address'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<h6>Unit #</h6>
				<div class="alert-error"><?php echo $form->error($model,'unit'); ?></div>				
				<?php echo $form->textField($model,'unit', array('style'=>'width:50px')); ?>
			</td>
		</tr>
		<tr>
			<td>
				<h6>City*</h6>
				<div class="alert-error"><?php echo $form->error($model,'city'); ?></div>
				<?php echo $form->textField($model,'city'); ?>				
			</td>
			<td style="padding-left: 30px">
				<h6>State*</h6>
				<div class="alert-error"><?php echo $form->error($model,'state'); ?></div>
				<?php echo $form->dropDownList($model,'state', array('' => 'Select One' 
    	         	, 'AL' => 'AL'
     				, 'AK' => 'AK'
				     , 'AZ' => 'AZ'
     				, 'AR' => 'AR'
     				, 'CA' => 'CA'
     				, 'CO' => 'CO'
     				, 'CT' => 'CT'
     				, 'DE' => 'DE'
     				, 'DC' => 'DC'
     				, 'FL' => 'FL'
     				, 'GA' => 'GA'
     				, 'HI' => 'HI'
     				, 'ID' => 'ID'
     				, 'IL' => 'IL'
     				, 'IN' => 'IN'
     				, 'IA' => 'IA'
     				, 'KS' => 'KS'
     				, 'KY' => 'KY'
     				, 'LA' => 'LA'
     				, 'ME' => 'ME'
     				, 'MD' => 'MD'
     				, 'MA' => 'MA'
     				, 'MI' => 'MI'
     				, 'MN' => 'MN'
     				, 'MS' => 'MS'
     				, 'MO' => 'MO'
     				, 'MT' => 'MT'
     				, 'NE' => 'NE'
     				, 'NV' => 'NV'
     				, 'NH' => 'NH'
     				, 'NJ' => 'NJ'
     				, 'NM' => 'NM'
     				, 'NY' => 'NY'
     				, 'NC' => 'NC'
				    , 'ND' => 'ND'
     				, 'OH' => 'OH'
     				, 'OK' => 'OK'
     				, 'OR' => 'OR'
     				, 'PA' => 'PA'
     				, 'RI' => 'RI'
     				, 'SC' => 'SC'
     				, 'SD' => 'SD'
     				, 'TN' => 'TN'
     				, 'TX' => 'TX'
     				, 'UT' => 'UT'
     				, 'VT' => 'VT'
     				, 'VA' => 'VA'
     				, 'WA' => 'WA'
     				, 'WV' => 'WV'
     				, 'WI' => 'WI'
     				, 'WY' => 'WY'				   	    
    	    ), array('style'=>'width:110px'));?>    	    
			</td>
		</tr>
		<tr>
			<td>
    	    	<h6>Start Date*</h6>    
    			<div class="alert-error"><?php echo $form->error($model,'start_date'); ?></div>
    			<?php
    				if(isset($model->start_date))
    					$model->start_date = Yii::app()->dateFormatter->format('MM/dd/yyyy', $model->start_date);
	    			Yii::import('application.extensions.CJuiDatePicker.CJuiDatePicker');
    				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	        			'model'=>$model,   // model object
        				'attribute'=>'start_date',
        				'value'=>$model->start_date,
        				'options'=>array('autoSize'=>true,
            			'dateFormat'=>'mm/dd/yy',
            			'defaultDate'=>$model->start_date,
            			'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
            			'buttonImageOnly'=>true,
            			'buttonText'=>'Select',
            			'showAnim'=>'fold',
            			'showOn'=>'button',
            			'showButtonPanel'=>true,
            			'yearRange'=>'2012',
         				'htmlOptions'=>array(
                		'readOnly'=>true
	            			),
        				),
        				'language'=>'en-AU',
    				));?>
    		</td>    		    
    		<td style="padding-left: 30px">
    			<h6>Start Time*</h6>
    			<div class="alert-error"><?php echo $form->error($model,'start_hour'); ?></div>
    			<div class="alert-error"><?php echo $form->error($model,'start_minute'); ?></div>    			
				<?php echo $form->textField($model,'start_hour', array('style'=>"width:15px; display:inline")); ?>
				:				
				<?php echo $form->textField($model,'start_minute', array('style'=>"width:15px; display:inline")); ?>
				<?php echo $form->dropDownList($model,'start_am_pm', array('AM' => 'AM', 'PM' => 'PM'), array('style'=>'width:60px'));?>
			</td>
		</tr>
		<tr>
			<td>
    	    	<h6>End Date*</h6>    
    			<div class="alert-error"><?php echo $form->error($model,'end_date'); ?></div>
    			<?php    				
					if(isset($model->end_date))
						$model->end_date = Yii::app()->dateFormatter->format('MM/dd/yyyy', $model->end_date);
	    			Yii::import('application.extensions.CJuiDatePicker.CJuiDatePicker');
    				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	        			'model'=>$model,   // model object
        				'attribute'=>'end_date',
        				'value'=>$model->end_date,
        				'options'=>array('autoSize'=>true,
            			'dateFormat'=>'mm/dd/yy',
            			'defaultDate'=>$model->end_date,
            			'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
            			'buttonImageOnly'=>true,
            			'buttonText'=>'Select',
            			'showAnim'=>'fold',
            			'showOn'=>'button',
            			'showButtonPanel'=>true,
            			'yearRange'=>'2012',
         				'htmlOptions'=>array(
                		'readOnly'=>true
	            			),
        				),
        				'language'=>'en-AU',
    				));?>
    		</td>    		    
    		<td style="padding-left: 30px">
    			<h6>End Time*</h6>
    			<div class="alert-error"><?php echo $form->error($model,'end_hour'); ?></div>
    			<div class="alert-error"><?php echo $form->error($model,'end_minute'); ?></div>    			
				<?php echo $form->textField($model,'end_hour', array('style'=>"width:15px; display:inline")); ?>
				:				
				<?php echo $form->textField($model,'end_minute', array('style'=>"width:15px; display:inline")); ?>
				<?php echo $form->dropDownList($model,'end_am_pm', array('AM' => 'AM', 'PM' => 'PM'), array('style'=>'width:60px'));?>
			</td>
		</tr>
		<tr>
			<td>
				<br/>
				<h6>Are T-Shirts Available?</h6>
				<?php echo $form->dropDownList($model,'tshirt_ind', array('N' => 'NO', 'Y' => 'YES'), array('style'=>'width:70px'));?>
			</td>
		</tr>
		<tr>
			<td>
				<br/>
				<h6>Is this a Team Event?</h6>
				<?php echo $form->dropDownList($model,'team_ind', array('N' => 'NO', 'Y' => 'YES'), array('style'=>'width:70px'));?>
			</td>
		</tr>
		<tr>
			<td>
				<br/>
				<h6>Will there be Multiple Divisions?</h6>
				<?php echo $form->dropDownList($model,'division_ind', array('N' => 'NO', 'Y' => 'YES'), array('style'=>'width:70px'));?>
			</td>
		</tr>		
		<tr>
			<td>
				<br/>
				<h6>Will there be a registration fee?</h6>
				<?php echo $form->dropDownList($model,'fee_ind', array('N' => 'NO', 'Y' => 'YES'), 
					array('style'=>'width:70px'
						  , 'onChange'=>'toggleFee()'));?>
						  
			</td>
			<td>
				<?php if($model->fee_ind == 'Y') echo '<div id="fee" style="display:block;width:150px">';
					  else echo '<div id="fee" style="display:none; width:150px">';?>
					<br />
					<h6>Fee Amount*</h6>
					<img style="width:12%" src="<?php echo Yii::app()->request->baseUrl;?>/img/Dollar_Sign.svg">
					<?php echo $form->textField($model,'fee_amount', array('style'=>'width:50px')); ?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<br />				
				<h6>Maximum # of Athletes*<br />(0 = Unlimited)</h6>
				<div class="alert-error"><?php echo $form->error($model,'max_athletes'); ?></div>
				<?php echo $form->textField($model,'max_athletes', array('style'=>'width:70px')); ?>				
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<br />
				<h6>Additional Comments</h6>
				<div class="alert-error"><?php echo $form->error($model,'comments'); ?></div>
				<?php echo $form->textArea($model,'comments', array('style'=>'width:300px;height:75px')); ?>	
			</td>
		</tr>
		<tr>
			<td>
				<br />
				<h6>Event Logo</h6>	
				<?php if($fileName != '') echo '<img style="width:50px;" src="'.Yii::app()->request->baseUrl.'/uploads/'.$fileName.'" /><br />';?>			
				<?php echo $form->fileField($model, 'fileName');?>
			</td>
		</tr>			
		<tr>
			<td>
				<br />
				<br />
				<input class="btn btn-primary" value="Submit" type="submit">
				<a class="btn" href="<?php echo Yii::app()->request->baseUrl;?>/index.php/admin/index">Cancel</a>
			</td>
		</tr>
</table>
<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
    <script>
        $('#Event_start_date').attr('readonly', true);
        $("#Event_start_date").css({"background-color": "white"});
        $('#Event_end_date').attr('readonly', true);
        $("#Event_end_date").css({"background-color": "white"});

        function toggleFee () 
        {        	
        	var ele = document.getElementById("fee");
        	var field = document.getElementById("Event_fee_amount");
        	var e = document.getElementById("Event_fee_ind");
        	if(ele.style.display == "block") 
            {
        		ele.style.display = "none";
        		field.style.width = "50px";
        	}
        	else 
            {
        	    ele.style.display = "block";
        	    field.style.width = "50px";
            }        	
        }
    </script>
    <script src="<?php echo Yii::app()->request->baseUrl;?>/js/unicorn.js"></script>    
<?php echo $dump; ?>