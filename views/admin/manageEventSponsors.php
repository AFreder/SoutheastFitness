<div id="sidebar">
	<ul>
		<li><a href="index"><i class="icon icon-home"></i> <span>Home</span></a></li>
		<li><a href=""><i class="icon icon-edit"></i> <span>Create Event</span></a></li>	
		<li><a href="manageAffiliates"><i class="icon icon-th-large"></i> <span>Manage Affiliates</span></a></li>
		<li class="active"><a href="manageSponsors"><i class="icon icon-tags"></i> <span>Manage Sponsors</span></a></li>			
	</ul>		
</div>
<div id="contentUni">
<br />
<div id="breadcrumb">
	<a href="index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
	>
	<a href="#" class="current">Manage Sponsors for Event</a>
</div>
	<br />
	<br />	
<?php 	
	if(sizeof($model) > 0)
	{
		echo '<br /><br /><h4>Sponsors Available to Add</h4>';
		$i=0;			
		foreach($nonEventSponsors as $sponsor)
		{	
			if($i==4)
			{
				echo '<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
				$i=0;
			}		
			echo '<div class="span2">
					<img style="height:150px; width:150px;" src="'.Yii::app()->request->baseUrl.'/uploads/'.$sponsor['image'].'" />					
				  	<br /><br />
				  	<a href="addEventSponsors?event_id='.$event['id'].'&sponsor_id='.$sponsor['id'].'" class="btn btn-primary">Add Sponsor</a>
				  </div>';
			$i++;		
		}
		echo '<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		     <h4 class="offsetHalf;">Event Sponsors</h4>';
		$i=0;
		foreach($eventSponsors as $sponsor)
		{
			if($i==4)
			{
				echo '<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
				$i=0;
			}
			echo '<div class="span2">
			      	<img style="height:150px; width:150px;" src="'.Yii::app()->request->baseUrl.'/uploads/'.$sponsor['image'].'" />
			      	<br /><br />
			      	<a href="deleteEventSponsors?event_id='.$event['id'].'&sponsor_id='.$sponsor['id'].'" class="btn btn-primary">Remove Sponsor</a>
			      </div>';
			$i++;		
		}	
	}
	else echo '<br /><br /><h6 class="offset1">Event Not Found!</h6>';	
?>
<br />
</div>
<script type="text/javascript">

    function deleteSponsorEvent () 
    {
    	return confirm("Are you sure you wish to delete this Sponsor?\n\n"+						
    					"WARNING: This action cannot be undone.");
    }
</script>