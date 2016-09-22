<?php

class SiteController extends Controller
{
	public $layout='column1';
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('login','index'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update','filtr',
                    'datenschutzerklaerung','impressum','agb','logout'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    public function actionAgb()
    {
          $this->render('agb-simplyhop');
    }
    public function actionDatenschutzerklaerung()
    {
        $this->render('datenschutzsimplyhop');
    }
    public function actionImpressum()
    {
        $this->render('impressum');
    }
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
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{

	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        $this->layout='main_dev';
//print_R();
      //  Yii::app()->user->id = 2;
       /// print_R(Yii::app()->user->gender); exit;

//https://github.com/ziolek/yii-eauth-nk/blob/master/README_RU.md

      //  Yii::app()->eauth->fetchAttributes();
        $service = Yii::app()->request->getQuery('service');

        if (isset($service)) {
            $authIdentity = Yii::app()->eauth->getIdentity($service);
            $authIdentity->redirectUrl = Yii::app()->user->returnUrl;
            //$authIdentity->redirectUrl = "/site/filtr";
            $authIdentity->cancelUrl = $this->createAbsoluteUrl('site/login');

            if ($authIdentity->authenticate()) {
              //  print_R($authIdentity);exit;
                $identity = new EAuthUserIdentity($authIdentity);


//print_R($authIdentity); exit;
                // успешная авторизация
                if ($identity->authenticate()) {

                    //print_R(Yii::app()->user); exit;
//print_R($identity);
                  //  echo $authIdentity->redirectUrl; exit;

                    Yii::app()->user->login($identity);

                    // специальное перенаправления для корректного закрытия всплывающего окна
                    $authIdentity->redirectUrl = "/site/filtr";
                    $authIdentity->redirect();
                }
                else {
                    // закрытие всплывающего окна и перенаправление на cancelUrl
                    $authIdentity->cancel();
                }
            }

            // авторизация не удалась, перенаправляем на страницу входа
            $this->redirect(array('site/login'));
        }






        /////////////////

		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

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
			if($model->validate() && $model->login()) {
               // $this->redirect(Yii::app()->user->returnUrl);
                $this->redirect("/site/filtr");
            }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	public function actionIndex()
	{

       $this->layout='main_dev';

        if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
            throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

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
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
	}
	public function actionFiltr()
	{

        if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
            throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");


        $this->render('filtr');
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
