<?php

class RequestController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';
    public $layout='//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('list','confirm','index'),
                'users'=>array('@'),
            ),

            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
	public function actionIndex()
	{ //просто отправка email request_user_id=1&travel_id=57&freie=1&gep=1

        //http://www.yiiframework.com/extension/email/

        /*$email = Yii::app()->email;
        $email->to = 'mybiznetmail@gmail.com';
        $email->subject = 'Confirm request';
        // $email->message = '

        //  ';
       //   $email->layout = 'mail_test';
        $email->message = 'Confirm link <a href="">Confirm</a>';
        $email->send();*/

        if(
            !empty($_POST['request_user_id'])
            && !empty($_POST['travel_id'])
            && !empty($_POST['freie'])
            && (int)$_POST['request_user_id']
            && (int)$_POST['travel_id']
            && (int)$_POST['freie']
        ){

            $model2=Travels::model()->findByPk((int)$_POST['travel_id']);
            $data2 = $model2->attributes;

           // print_r($data2);
            if(!empty($data2["id"])){
                $link = "/request/confirm?request_user_id=".(int)$_POST['request_user_id']
                    ."&travel_id=".(int)$_POST['travel_id']
                    ."&freie=".(int)$_POST['freie'];


                if(!empty($_POST['gep'])){
                    $link = $link ."&gep=".(int)$_POST['gep'];
                }

                $model3=User::model()->findByPk((int)$data2["travel_owner_id"]);
                $data3 = $model3->attributes;

                $mail = new YiiMailer();
                $mail->setView('contact');
                $mail->setData(array('message' => 'Message to send',
                     'description' => 'Contact form'));
                $mail->setFrom('mybiznetmail@gmail.com', 'John Doe');
                $mail->setTo($data3["email"]);
                $mail->setSubject('Cofirm request');
                if ($mail->send()) {
                    echo "ok";
                   // Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                } else {
                    echo "no";
                   // Yii::app()->user->setFlash('error','Error while sending email: '.$mail->getError());
                }
            }else{
                echo "no_2";
            }
        }



        return false;
	}

    public function actionConfirm()
    { //подтверждение заявки
        //   /request/confirm?request_user_id=&travel_id=

        if(
            !empty($_GET['request_user_id'])
            && !empty($_GET['travel_id'])
            && !empty($_GET['freie'])
            && (int)$_GET['travel_id']
            && (int)$_GET['request_user_id']
            && (int)$_GET['freie']
        ){

            $model2=Travels::model()->findByPk((int)$_GET['travel_id']);
            $data2 = $model2->attributes;

            if( Yii::app()->user->id == $model2->travel_owner_id){
                /// тут уж код отправки заявки

                $model=new Request();

                Request::model()->deleteAll( 'user_request_id=:user_request_id AND
                travel_id=:travel_id'
                    , array(':user_request_id'=>(int)$_GET['request_user_id'], ":travel_id"=>$data2["id"]));
                $gep = 0;
                if(!empty($_GET['gep'])){
                   // echo $_GET['gep'];
                   $gep= (int)$_GET['gep'];
                }
               //echo $gep;
                $model->attributes=array(
                    "user_request_id"=>(int)$_GET['request_user_id'],
                        'travel_id'=>$data2["id"],
                        'freie'=>(int)$_GET['freie'],
                        'gep'=>$gep,
                );
               // $model->attributes["gep"]= 22;

               // print_R($_GET);
                //print_R($model->attributes);

                    if($model->save()){
                        $this->render('view',array(
                            'model'=>$model,
                        ));
                        return false;
                    }
            }
        }
        $this->render('view_error',array(
            'model'=>$model,
        ));
        //return false;

    }
    public function actionList()
	{


        $l = "/request/confirm?request_user_id=&travel_id=";
        $l = "/request/confirm?request_user_id=&travel_id=";

        $l = "/request/confirm?request_user_id=2&travel_id=57&freie=1&gep=1";
        echo '<a href="'.$l.'">'.$l.'</a>';

        return false;

	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}