<div id="sidebar">
	<ul>
		<li><a href="index"><i class="icon icon-home"></i> <span>Home</span></a></li>
		<li><a href="cuEvent"><i class="icon icon-edit"></i> <span>Create Event</span></a></li>
		<li class="active"><a href="manageAffiliates"><i class="icon icon-th-large"></i> <span>Manage Affiliates</span></a></li>
		<li><a href="manageSponsors"><i class="icon icon-tags"></i> <span>Manage Sponsors</span></a></li>								
	</ul>		
</div>
<div id="contentUni">
<br />
<?php
$this->pageTitle='Create/Update Affiliate';
$this->breadcrumbs=array(
	'Login',
);
?>

<div id="breadcrumb">
	<a href="index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
	>
	<a href="#" class="current">Create/Update Affiliate</a>
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
				<h6>Affiliate Name*</h6>
				<div class="alert-error"><?php echo $form->error($model,'name'); ?></div>
				<?php echo $form->textField($model,'name'); ?>				
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
				<h6>Zip Code</h6>
				<div class="alert-error"><?php echo $form->error($model,'zip'); ?></div>				
				<?php echo $form->textField($model,'zip', array('style'=>'width:50px')); ?>
			</td>
		</tr>
		<tr>
			<td>
				<br />
				<br />
				<input class="btn btn-primary" value="Submit" type="submit">
				<a class="btn" href="<?php echo Yii::app()->request->baseUrl;?>/index.php/admin/manageAffiliates">Cancel</a>
			</td>
		</tr>		
</table>
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/unicorn.js"></script>    