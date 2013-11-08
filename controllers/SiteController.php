<?php

class SiteController extends Controller
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
		if(!Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php/admin/index');
		$es = new EventService;
		$this->render('index', array('model'=>$es->getEvents()) );
	}
	public function actionEventRegistration()
	{
		if(!Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php/admin/index');
		$model = new Competitor;		
		$es = new EventService;
		$event = $es->getEvent($_GET['id']);
		$sponsorService = new SponsorService();		
		$sponsors = $sponsorService->getEventSponsors($_GET['id']);
		if($event->team_ind == 'Y')
		{
			$as = new AffiliateService();
			$affiliate = $as->getAllAffiliates();
		}
		else 	
			$affiliate = new Affiliate;
		if(isset($_POST['Competitor']))
		{
			$model->attributes=$_POST['Competitor'];
			$model->verifyEmail=$_POST['Competitor']['verifyEmail'];
			$model->event_id=$_POST['Competitor']['event_id'];
			if($model->validate())
			{				
				// Validate Number of Athletes registered for a Team
				if($event->team_ind == 'Y')
				{
					$cs = new CompetitorService();
					$teams = $cs->getNumTeamCompetitorsRegistered($event->id);
					$team_count = 0;
					foreach($teams as $team) 
						if($team['team'] == $model->team_name.' '.$model->division.' '.$model->team_number)
							$team_count = $team['count'];
				}
				/* Verfiy that event is not full before sending
				 * confirmation email and saving the Registrant. */
				if(($nr[0]['count'] < $event->max_athletes || $event->max_athletes == 0) && $team_count < 6)                	
                {
                	$nr = $es->getNumberRegisteredById($event->id);
                	$regError = '';                	                	
					//Begin Paypal Process
                	if($event->fee_ind == 'Y')
					{
						$compPending = new CompetitorPending;						
						$model->actv_in = 'N';
						$compPending->attributes = $model->attributes;
						$compPending->save(false);
						$tran = new Transaction;
						$tran->competitor_id = $compPending->id;						

						// set 
        				$paymentInfo['Order']['theTotal'] = $event->fee_amount;
    				    $paymentInfo['Order']['description'] = $event->name;
        				$paymentInfo['Order']['quantity'] = '1';
 
				        // call paypal 
        				$result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo); 
				        //Detect Errors 
        				if(!Yii::app()->Paypal->isCallSucceeded($result))
        				{ 
            				if(Yii::app()->Paypal->apiLive === true)
            				{
			                	//Live mode basic error message
                				$error = $result['L_LONGMESSAGE0'];//'We were unable to process your request. Please try again later';
            				}
            				else
            				{
			                	//Sandbox output the actual error message to dive in.
                				$error = $result['L_LONGMESSAGE0'];
            				}
            				echo $error;
            				Yii::app()->end();
 
				        }
				        else 
				        { 
			            	// send user to paypal 
			           		$token = urldecode($result["TOKEN"]);
			           		$tran->token = $token;
			           		$tran->order_total = $event->fee_amount;
			           		$tran->status = 'Pending';
			           		$tran->save(); 
			            	$payPalURL = Yii::app()->Paypal->paypalUrl.$token; 
			            	$this->redirect($payPalURL); 
        				}
					}
					else 
					{
						$model->save();
						$ms = new MailService();
						$ms->sendConfirmationEmail($model->id);
						$this->redirect(Yii::app()->request->baseUrl.'/index.php/site/confirmation');
					}

                }
                else if($team_count == 6)
                	$regError = "I'm sorry, but this event already has the maximum number of participants for this team.";
                else
                	$regError = "I'm sorry, but this event already has the maximum number of participants.";
			}
		}			
		$this->render('eventRegistration', array('model'=>$model
		                                         , 'sponsors'=>$sponsors
		                                         , 'event'=>$event
		                                         , 'affiliate'=>$affiliate
		                                         , 'regError'=>$regError));
	}
	public function actionConfirmation()
	{
		if(!Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php/admin/index');
		$this->render('confirmation');
	}
	public function actionEventDetails()
	{
		if(!Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php/admin/index');
		$es = new EventService;
		$sponsorService = new SponsorService();
		$sponsors = $sponsorService->getEventSponsors($_GET['id']);
		$this->render('eventDetails', array('model'=>$es->getEvent($_GET['id'])
		                                    , 'sponsors'=>$sponsors
		                                    , 'numberRegistered'=>$es->getNumberRegisteredById($_GET['id'])));
	}
	public function actionContact()
	{
		if(!Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php/admin/index');		  
		$this->render('contact');
	}
	public function actionCalendar()
	{
		if(!Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php/admin/index');
		$es = new EventService();
		$events = $es->getAllEvents();
		$this->render('calendar', array('events'=>$events));
	}
	public function actionError()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
	}		
}