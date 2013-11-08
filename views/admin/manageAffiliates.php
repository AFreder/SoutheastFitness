<div id="sidebar">
	<ul>
		<li><a href="index"><i class="icon icon-home"></i> <span>Home</span></a></li>
		<li><a href="cuEvent"><i class="icon icon-edit"></i> <span>Create Event</span></a></li>	
		<li class="active"><a href="manageAffiliates"><i class="icon icon-th-large"></i> <span>Manage Affiliates</span></a></li>
		<li ><a href="manageSponsors"><i class="icon icon-tags"></i> <span>Manage Sponsors</span></a></li>			
	</ul>		
</div>
<div id="contentUni">
<br />
<div id="breadcrumb">
	<a href="index" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
	>
	<a href="#" class="current">Manage Affiliates</a>	
</div>
<br />
<br />
<a class="btn btn-primary offsetHalf" href="<?php echo Yii::app()->request->baseUrl;?>/index.php/admin/createUpdateAffiliates">Create Affiliate</a>
<?php 	
	$es = new EventService;
	if(sizeof($model) > 0)
	{
		foreach($model as $affiliate)
		{
			echo '<br /><br />
				  <table style="width:90%" class="offsetHalf">
					<tr>						
			      		<td>
				  			<div class="widget-box span6">
								<div class="widget-title">						
									<div class="offsetHalf">							
										<h3>'.$affiliate['name'].'</h3>
									</div>
								</div>
		      					<br/>
		        				<table class="offsetHalf">
			        				<tr>
		        						<td style="width:25%">
			        						<h6>Address: </h6> 
		        						</td>
		        						<td style="padding-left:10px"><h7>'.
			        						$affiliate['address'].'<br />'.
			        						$affiliate['city'].', '.$affiliate['state'].'		        							
		        						</h7></td>
		        					</tr>		        							        				        					
		        					<tr>
			        					<td><br /><a href="createUpdateAffiliates?id='.$affiliate['id'].'" class="btn btn-primary btn-small">Update</a></td>
		        						<td><br /><a onclick="return deleteAffiliate()" href="deleteAffiliates?id='.$affiliate['id'].'" class="btn btn-danger btn-small">Delete</a></td>		        						
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

    function deleteAffiliate () 
    {
    	return confirm("Are you sure you wish to delete this Affiliate?\n\n"+						
    					"WARNING: This action cannot be undone.");
    }
</script>
<?php echo Yii::app()->basePath; ?>