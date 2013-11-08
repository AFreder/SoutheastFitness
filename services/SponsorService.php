<?php
class SponsorService
{	
	public function getAllSponsors()
	{
		$sql = 'SELECT a.*
                FROM sponsor a                
                ORDER BY a.name ASC;';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}	
	public function getNonEventSponsors($id)
	{
		$sql = 'SELECT a.*
                FROM sponsor a
                WHERE a.id not in (select distinct sponsor_id 
                                   from eventsponsor
                                   where event_id = '.$id.')
                ORDER BY a.id ASC;';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}
	public function getEventSponsors($id)
	{
		$sql = 'SELECT a.*
                FROM sponsor a
                WHERE a.id in (select distinct sponsor_id 
                                   from eventsponsor
                                   where event_id = '.$id.')
                ORDER BY a.id ASC;';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}	
	public function deleteSponsor($id)
	{
		$model = Sponsor::model()->findByPk($id);
		$model->delete(); 
	}
	public function getSponsor($id)
	{
		$model = Sponsor::model()->findByPk($id);
		return $model; 
	}		
}
?>