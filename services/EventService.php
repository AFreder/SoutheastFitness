<?php
class EventService
{	
	public function getEvents()
	{
		$sql = 'SELECT a.*, coalesce(b.count,0) as count
                FROM event a
                LEFT OUTER JOIN (SELECT event_id, count(event_id) as count                
                                 FROM competitor b
                                 where actv_in = "Y"
                                 GROUP BY event_id) b
                ON a.id = b.event_id 
                WHERE a.start_date >= CURRENT_DATE
                ORDER BY a.start_date ASC;';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}
	public function getAllEvents()
	{
		$sql = 'SELECT * 
		        FROM event 		        
		        order by start_date ASC;';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}
	public function getNumberRegistered()
	{
		$sql = 'SELECT count(a.id) as count, a.id
		        FROM event a
		             , competitor b 
		        WHERE a.id = b.event_id
		        and   start_date > CURRENT_DATE
		        and   b.actv_in = "Y"
		        group by a.id 
		        order by a.start_date ASC;';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}
	public function getNumberRegisteredById($id)
	{
		$sql = 'SELECT count(a.id) as count, a.id
		        FROM event a
		             , competitor b 
		        WHERE a.id = '.$id.'
		        and   a.id = b.event_id
		        and   b.actv_in = "Y"
		        group by a.id 
		        order by a.start_date ASC;';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}
	public function deleteEvent($id)
	{
		$event = Event::model()->findByPk($id);
		$event->delete(); 
	}
	public function getEvent($id)
	{
		$event = Event::model()->findByPk($id);
		return $event; 
	}
	public function formatDisplayDate($date)
	{
		return Yii::app()->dateFormatter->format('MM/dd/yyyy', $date);
	}
	public function formatMonthDate($date)
	{
		return Yii::app()->dateFormatter->format('MMMM dd, yyyy', $date);
	}
	public function formatDatabaseDate($date)
	{
		return Yii::app()->dateFormatter->format('MM/dd/yyyy', $date);
	}		
}
?>