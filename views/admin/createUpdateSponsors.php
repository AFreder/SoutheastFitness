<div id="sidebar">
	<ul>
		<li><a href="index"><i class="icon icon-home"></i> <span>Home</span></a></li>
		<li><a href="cuEvent"><i class="icon icon-edit"></i> <span>Create Event</span></a></li>
		<li><a href="manageAffiliates"><i class="icon icon-th-large"></i> <span>Manage Affiliates</span></a></li>	
		<li class="active"><a href="manageSponsors"><i class="icon icon-tags"></i> <span>Manage Sponsors</span></a></li>					
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
	<a href="#" class="current">Create/Update Sponsor</a>
</div>
<br />
<div class="offsetHalf well">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sponsor-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
	<table>
		<tr>
			<td>				
				<h6>Sponsor Name*</h6>
				<div class="alert-error"><?php echo $form->error($model,'name'); ?></div>
				<?php echo $form->textField($model,'name'); ?>				
			</td>
		</tr>
		<tr>
			<td>				
				<h6>Sponsor Website*</h6>
				<div class="alert-error"><?php echo $form->error($model,'name'); ?></div>
				<?php echo 'http://'.$form->textField($model,'website'); ?>				
			</td>
		</tr>
		<tr>
			<td>
				<br />
				<h6>Sponsor Logo</h6>
				<div class="alert-error"><?php echo $form->error($model,'fileName'); ?></div>	
				<?php if($fileName != '') echo '<img style="width:50px;" src="'.Yii::app()->request->baseUrl.'/uploads/'.$fileName.'" /><br />';?>			
				<?php echo $form->fileField($model, 'fileName');?>
			</td>
		</tr>
		<tr>
			<td>
				<br />
				<br />
				<input class="btn btn-primary" value="Submit" type="submit">
				<a class="btn" href="<?php echo Yii::app()->request->baseUrl;?>/index.php/admin/manageSponsors">Cancel</a>
			</td>
		</tr>		
</table>
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl;?>/js/unicorn.js"></script>    