<?php

class UserController extends Controller
{
	public function actions()
	{
 		return array(
   			//captcha action renders the CAPTCHA image displayed on the user registration page
   			'captcha'=>array(
     		'class'=>'CCaptchaAction',
 			//'buttonLabel'=>'refresh', 		 		
     		'backColor'=>0xFFFFFF,
   			),
 		);
	}
	
    public function actionLogin()
    {
    	if(!Yii::app()->user->isGuest)
		  $this->redirect(Yii::app()->request->baseUrl.'/index.php/admin/index');
		  
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->request->baseUrl.'/index.php/admin/index');
        }
	        // display the login form
	        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
    	$session=new CHttpSession;
  		$session->open();
  		$session->destroy();
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}