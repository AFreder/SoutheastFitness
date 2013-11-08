<?php

class AdminController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	

	public function actionIndex()
	{	
		if(Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php');
		$es = new EventService;
		$this->render('index', array('model'=>$es->getEvents()) );
	}

	public function actionCuEvent()
	{	
		if(Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php');
		$model = new Event;
		
		if(isset($_POST['Event']))
		{
			$model->attributes=$_POST['Event'];	
					
			if($model->validate())
			{		
				$model->fileName=CUploadedFile::getInstance($model,'fileName');		
				if($model->fileName != '')
				{										            
					$path = Yii::app()->basePath . '/../uploads/'.$model->fileName;            	
            		$model->fileName->saveAs($path);
					$model->image = $model->fileName;            	
				}
				$model->start_date = Yii::app()->dateFormatter->format('yy-MM-dd', $model->start_date);
				$model->end_date = Yii::app()->dateFormatter->format('yy-MM-dd', $model->end_date);
				$model->save();
				$this->redirect('index');
			}
		}		
		$this->render('createUpdateEvent', array('model'=>$model, 'fileName'=>$model->fileName));
	}
	public function actionUpdateEvent()
	{
		if(Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php');
		if(isset($_POST['Event']))
		{
			$es = new EventService;
			$model = $es->getEvent($_GET['id']);
			$model->attributes=$_POST['Event'];	
					
			if($model->validate())
			{		
				$model->fileName=CUploadedFile::getInstance($model,'fileName');		
				if($model->fileName != '')
				{										            
					$path = Yii::app()->basePath . '/../uploads/'.$model->fileName;					            	 
            		$model->fileName->saveAs($path);
					$model->image = $model->fileName;            	            
				}
				$model->start_date = Yii::app()->dateFormatter->format('yy-MM-dd', $model->start_date);
				$model->end_date = Yii::app()->dateFormatter->format('yy-MM-dd', $model->end_date);
				$model->save();				
				$this->redirect('index?'.$path);
			}
		}	
		else if(isset($_GET['id']))
		{
			$es = new EventService;
			$model = $es->getEvent($_GET['id']);
			if(isset($model->image))
				$filename = $model->image;
			else 
				$filename = '';		
		}
		$this->render('createUpdateEvent', array('model'=>$model, 'fileName'=>$model->image));
	}
	public function actionCreateEventReport()
	{
		if(Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php');
		$es = new EventService();
		$event = $es->getEvent($_GET['id']);
		$cs = new CompetitorService();
		$results = $cs->getCompetitorsForEvent($_GET['id']);
		
		$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
		spl_autoload_unregister(array('YiiBase','autoload'));
		
		include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');		
		$objPHPExcel = new PHPExcel();
		$styleArray = array(
				'font' => array(
					'bold' => true,
			),
		);
		// Create a new worksheet called “My Data”
		$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'Men');
		$objPHPExcel->addSheet($myWorkSheet, 0);
		$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'Women');
		$objPHPExcel->addSheet($myWorkSheet, 1);		
		for($i=0;$i<2;$i++)
		{
			$objPHPExcel->setActiveSheetIndex($i);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);		
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Gender');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
		
			if($event['tshirt_ind'] == 'Y')
			{
				$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Tshirt Size');
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			}
			if($event['team_ind'] == 'Y')
			{
				$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Team Name');
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			}
			if($event['division_ind'] == 'Y')
			{
				$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Division');
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			}
		}
		$i=2;
		$objPHPExcel->setActiveSheetIndex(0);
		// 	Add some data
		foreach($results as $row)
		{
			if($row['gender'] == 'F' && $prev_gender == 'M')
			{
				$objPHPExcel->setActiveSheetIndex(1);
				$i=2;
			}
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $row['first_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $row['last_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $row['gender']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $row['email']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $row['shirt_size']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $row['team_name'].' '.$row['team_number']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $row['division']);
			$i++;
			$prev_gender = $row['gender'];
		}					
		$objPHPExcel->setActiveSheetIndex(0);
		// Save Excel 2007 file
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);   

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $event['name'] . '.xlsx"');

		$objWriter->save('php://output');
		
		// Echo done	
		spl_autoload_register(array('YiiBase','autoload'));			
	}
	public function actionDeleteEvent()
	{	
		if(Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php');
		if(isset($_GET['id']));
		{
			$es = new EventService;
			$id = $_GET['id'];
			$es->deleteEvent($id);					
		}
		$this->redirect('index');					
	}
	public function actionCreateUpdateAffiliates()
	{
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			$model = Affiliate::model()->findByPk($id);
		}
		else
			$model = new Affiliate;
		if(isset($_POST['Affiliate']))
		{				
			$model->attributes = $_POST['Affiliate'];					
			if($model->validate())
			{						
				$model->save();				
				$this->redirect(Yii::app()->request->baseUrl.'/index.php/admin/manageAffiliates');
			}
		}
		$this->render('createUpdateAffiliates', array('model'=>$model));
	}
	public function actionManageAffiliates()
	{
		$as = new AffiliateService();
		$model = $as->getAllAffiliates();
		$this->render('manageAffiliates', array('model'=>$model));
	}
	public function actionDeleteAffiliates()
	{
		$as = new AffiliateService();
		$as->deleteAffiliate($_GET['id']);
		$this->render('manageAffiliates', array('model'=>$model));
	}	
	public function actionCreateUpdateSponsors()
	{
		$fileName = '';
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			$model = Sponsor::model()->findByPk($id);
			$model->fileName = $model->image;
			$fileName = $model->image;
		}
		else
			$model = new Sponsor;
		if(isset($_POST['Sponsor']))
		{				
			$model->attributes = $_POST['Sponsor'];				
		    if($model->validate())
			{		
				$model->fileName=CUploadedFile::getInstance($model,'fileName');
				if($model->fileName != '')												            
				{
					$path = Yii::app()->basePath . '/../uploads/'.$model->fileName;            	
           			$model->fileName->saveAs($path);
					$model->image = $model->fileName;
				}
				$model->website = str_replace('http://', '', $model->website);          						
				$model->save();				
				$this->redirect(Yii::app()->request->baseUrl.'/index.php/admin/manageSponsors');
			}			
		}
		$this->render('createUpdateSponsors', array('model'=>$model, 'fileName'=>$fileName));
	}
	public function actionManageSponsors()
	{
		$as = new SponsorService();
		$model = $as->getAllSponsors();
		$this->render('manageSponsors', array('model'=>$model));
	}
	public function actionDeleteSponsors()
	{
		$as = new SponsorService();
		$as->deleteSponsor($_GET['id']);
		$this->redirect('manageSponsors');
	}
	public function actionManageEventSponsors()
	{
		$fileName = '';
		$model = new EventSponsor;
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];						
			$event = Event::model()->findByPk($id);
			$sService = new SponsorService();
			$nonEventSponsors = $sService->getNonEventSponsors($id);
			$eventSponsors = $sService->getEventSponsors($id);			
		}		
		$this->render('manageEventSponsors', array('model'=>$model		                                            
		                                            , 'event'=>$event
		                                            , 'nonEventSponsors'=>$nonEventSponsors
		                                            , 'eventSponsors'=>$eventSponsors));
	}	
	public function actionAddEventSponsors()
	{
		if(isset($_GET['event_id']) && isset($_GET['sponsor_id']))
		{
			$model = new EventSponsor;
			$model->event_id = $_GET['event_id'];
			$model->sponsor_id = $_GET['sponsor_id'];										
		    if($model->validate())
			{						            						
				$model->save();	
				$this->redirect('manageEventSponsors?id='.$_GET['event_id']);						
			}			
		}
	}
	public function actionDeleteEventSponsors()
	{
		if(isset($_GET['event_id']) && isset($_GET['sponsor_id']))
		{
			$model = EventSponsor::model()->findByAttributes(array('event_id'=>$_GET['event_id']
			                                                     , 'sponsor_id'=>$_GET['sponsor_id']));
			$model->delete();	
			$this->redirect('manageEventSponsors?id='.$_GET['event_id']);									
		}
	}
	public function actionChangePassword()
	{
		if(Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php');
		$this->render('changePassword');
	}
	
	public function actionError()
	{
		if(Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php');
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}
	
}