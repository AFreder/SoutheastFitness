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
<div id="breadcrumb">
	<a href="index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
	>
	<a href="#" class="current">Manage Sponsors</a>
</div>
	<br />
	<br />
	<a class="btn btn-primary offsetHalf" href="<?php echo Yii::app()->request->baseUrl;?>/index.php/admin/createUpdateSponsors">Create Sponsor</a>
<?php 	
	if(sizeof($model) > 0)
	{
		foreach($model as $sponsor)
		{
			echo '<br /><br />
				  <table style="width:90%" class="offsetHalf">
					<tr>						
			      		<td>
				  			<div class="widget-box span6">
								<div class="widget-title">						
									<div class="offsetHalf">							
										<h3>'.$sponsor['name'].'</h3>
									</div>
								</div>
		      					<br/>
		        				<table class="offsetHalf">		        				        							        				        				
		        					<tr>
		        						<td colspan="2" style="height:232px; width:232px;">
											<div class="widget-box">			      							
												<img style="height:232px; width:232px;" src="'.Yii::app()->request->baseUrl.'/uploads/'.$sponsor['image'].'" />
			      							</div>
			      						<td>
		        					</tr>
		        					<tr>
			        					<td><br /><a href="createUpdateSponsors?id='.$sponsor['id'].'" class="btn btn-primary btn-small">Update</a></td>
		        						<td><br /><a onclick="return deleteSponsor()" href="deleteSponsors?id='.$sponsor['id'].'" class="btn btn-danger btn-small">Delete</a></td>		        						
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

    function deleteSponsor () 
    {
    	return confirm("Are you sure you wish to delete this Sponsor?\n\n"+						
    					"WARNING: This action cannot be undone.");
    }
</script>