<?php
class CompetitorService
{	
	public function getCompetitorsForEvent($id)
	{
		$sql = 'SELECT * 
		        FROM competitor 
		        WHERE event_id = '.$id.'
		        and   actv_in = "Y"
		        order by gender DESC, id ASC;';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}
	public function getNumMalesForEvent($id)
	{
		$sql = 'SELECT count(*) as count 
		        FROM competitor 
		        WHERE event_id = '.$id.'
		        and   gender = "M"
		        and   actv_in = "Y";';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}
	public function getNumFemalesForEvent($id)
	{
		$sql = 'SELECT count(*) as count 
		        FROM competitor 
		        WHERE event_id = '.$id.'
		        and   gender = "F"
		        and   actv_in = "Y";';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}
    public function getNumTeamCompetitorsRegistered($id)
	{
		$sql = 'SELECT a.team as team, COUNT(*) as count
                FROM (SELECT CONCAT(team_name, " ", division, " ", team_number ) AS team
                      FROM competitor
                      WHERE event_id = '.$id.'
                      and   actv_in = "Y") a                      		        
		        GROUP BY a.team;';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}
}