<?php
class AffiliateService
{	
	public function getAllAffiliates()
	{
		$sql = 'SELECT a.*
                FROM affiliate a                
                ORDER BY a.name ASC;';
	
		$command = Yii::app()->db->createCommand($sql);		
		$result = $command->queryAll();
	    return $result; 
	}	
	public function deleteAffiliate($id)
	{
		$model = Affiliate::model()->findByPk($id);
		$model->delete(); 
	}
	public function getAffiliate($id)
	{
		$model = Affiliate::model()->findByPk($id);
		return $model; 
	}		
}
?>