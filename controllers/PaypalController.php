<?php

class PaypalController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	
	public function actionBuy(){
 
        // set 
        $paymentInfo['Order']['theTotal'] = 0.50;
        $paymentInfo['Order']['description'] = "Some payment description here";
        $paymentInfo['Order']['quantity'] = '1';
 
        // call paypal 
        $result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo); 
        //Detect Errors 
        if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
            if(Yii::app()->Paypal->apiLive === true){
                //Live mode basic error message
                $error = $result['L_LONGMESSAGE0'];//'We were unable to process your request. Please try again later';
            }else{
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
 
        }else { 
            // send user to paypal 
            $token = urldecode($result["TOKEN"]); 
 
            $payPalURL = Yii::app()->Paypal->paypalUrl.$token; 
            $this->redirect($payPalURL); 
        }
    }
    public function actionConfirm()
    {
        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);
 		$tran = Transaction::model()->findByAttributes(array('token'=>$token));
 		$comp = CompetitorPending::model()->findByAttributes(array('id'=>$tran->competitor_id));
 
 
        $result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
 
        $result['PAYERID'] = $payerId; 
        $result['TOKEN'] = $token; 
        $result['ORDERTOTAL'] = $tran->order_total;
 
        //Detect errors 
       if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
            if(Yii::app()->Paypal->apiLive === true){
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            }else{
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        }
        else
        {
        	$paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);        	
            //Detect errors  
            if(!Yii::app()->Paypal->isCallSucceeded($paymentResult)){
                if(Yii::app()->Paypal->apiLive === true){
                    //Live mode basic error message
                    $error = 'We were unable to process your request. Please try again later';
                }else{
                    //Sandbox output the actual error message to dive in.
                    $error = $paymentResult['L_LONGMESSAGE0'];
                }
                echo $error;
                Yii::app()->end();
            }
            else
            {
        		//payment was completed successfully            	
        		$tran->status = 'Complete';
        		$tran->save();
        		$model = new Competitor;
        		$model->attributes = $comp->attributes;
        		$model->actv_in = 'Y';
        		$model->save(false);
        		$comp->delete();
				$ms = new MailService;
				$ms->sendConfirmationEmail($model->id);                		
				$this->redirect(Yii::app()->request->baseUrl.'/index.php/site/confirmation');
            }
        }         
    }
 
    public function actionCancel()
    {
    	$token = trim($_GET['token']);
		$tran = Transaction::model()->findByAttributes(array('token'=>$token));        
        Transaction::model()->deleteByPk($tran->id);
        CompetitorPending::model()->deleteByPk($tran->competitor_id);            	

        $this->render('/site/cancel');  
    }
	
}