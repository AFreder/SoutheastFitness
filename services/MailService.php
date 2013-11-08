<?php
class MailService
{	
	public function sendConfirmationEmail($comp_id)
	{
	    $comp = Competitor::model()->findByAttributes(array('id'=>$comp_id));
        $event = Event::model()->findByAttributes(array('id'=>$comp->event_id));
        	
        					                   
		$tshirt = '';
		$fee = '';
		if($event->tshirt_ind == 'Y') $tshirt = '
Shirt Size: '.$comp->shirt_size;
		if($event->fee_ind == 'Y') $fee = '
Fee: $'.$event->fee_amount;								
		if(isset($comp->team_name)) $team_name = '
Team Name: '.$comp->team_name.' '.$comp->team_number;			
		if(isset($comp->division)) $division = '
Division: '.$comp->division;
								
		$message = new YiiMailMessage;
        $message->setBody('Thank you for Registering for our event!
                
Event Name: '.$event->name.'                
Name: '.$comp->first_name.' '.$comp->last_name.'
Gender: '.$comp->gender.'
Email: '.$comp->email.$fee.$tshirt.$team_name.$division.'
                
Please reply to this email if you wish to remove yourself from this event.
                
Thanks,
SoutheastFitness');
	    $message->subject = Yii::app()->name.' - Email Confirmation';
     	$message->addTo($comp->email);
        //$message->from = "info@southeastfitness.com";
        $message->from = Yii::app()->params['adminEmail'];
        Yii::app()->mail->send($message);
	}		
}
?>