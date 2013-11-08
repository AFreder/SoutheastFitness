<?php
class EventService
{	
	public function getAllEventSponsors($id)
	{
		$sql = 'SELECT a.*
                FROM eventsponsor a
                WHERE a.id = '.$id.'
                ORDER BY a.id ASC;';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}	
	public function deleteEventSponsor($id)
	{
		$event = EventSponsor::model()->findByPk($id);
		$event->delete(); 
	}		
}
?>