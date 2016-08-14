<?php

class UserController extends Controller
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','create', 'delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

        $sort = new CSort;
        $sort->defaultOrder = 'id DESC';
        $sort->attributes = array( );

        $dataProviderReviews = new CActiveDataProvider('Reviews',
            array(
                'pagination'=>array(
                    'pageSize'=>5,
                ),
                'sort' => $sort,
            )
        );

        $dataProviderReviews->criteria->join ='LEFT JOIN tbl_user ON tbl_user.id = t.user_vouter';

        $dataProviderReviews->criteria->condition = " user_receiver = '".$id."'";

       //$dataProviderReviews->getTotalItemCount();
        $this->render('view',array(
            'model'=>$this->loadModel($id),
            'dataProviderReviews'=>$dataProviderReviews,
        ));



	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $dataProvider=new CActiveDataProvider('Reviews');




        return false;
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
            'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);


        if(!empty($_GET['delf'])){
            $uudeldir = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . Yii::app()->user->id . "/upic";
            array_map('unlink', glob($uudeldir."/*.*"));
           // rmdir($uudeldir);
            $this->redirect(array('update','id'=>$model->id));
        }
        if(!empty($_GET['adel'])){
            $uudeldir = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . Yii::app()->user->id . "/apic";
            array_map('unlink', glob($uudeldir."/*.*"));
           // rmdir($uudeldir);
            $this->redirect(array('update','id'=>$model->id));
        }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        //echo Yii::app()->user->name;
		if(isset($_POST['User'])){
            if(!empty($_FILES['auto_photo']['name'])) {
                $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . Yii::app()->user->id . "/apic";
                $uploadfile = $uploaddir . "/main-" . basename($_FILES['auto_photo']['name']);
                $file_tumb = $uploaddir . "/thumb_100.jpg";
                if (!is_dir($uploaddir)) {
                    if (!mkdir($uploaddir, 0777, true)) {
                        die('Не удалось создать директории...');
                    }
                }

                if (move_uploaded_file($_FILES['auto_photo']['tmp_name'], $uploadfile)) {
                    // echo "Файл корректен и был успешно загружен.\n";
                    try {
                        $image = new EasyImage($uploadfile);
                        $image->scaleAndCrop(128, 80);
                        $image->save($file_tumb);
                    } catch (Exception $e) {
                        echo 'Выброшено исключение2: ', $e->getMessage(), "\n";
                    }
                    
                } else {
                    // echo "Возможная атака с помощью файловой загрузки!\n";
                }


            }
            if(!empty($_FILES['user_pic']['name'])) {
                $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . Yii::app()->user->id . "/upic";
                $uploadfile = $uploaddir . "/main-" . basename($_FILES['user_pic']['name']);
                $file_tumb = $uploaddir . "/thumb_100.jpg";
                if (!is_dir($uploaddir)) {
                    if (!mkdir($uploaddir, 0777, true)) {
                        die('Не удалось создать директории...');
                    }
                }
                // echo 11111111;
                if (move_uploaded_file($_FILES['user_pic']['tmp_name'], $uploadfile)) {
                    // echo "Файл корректен и был успешно загружен.\n";

                    $tmp_sizes = getimagesize ($uploadfile);
                    //print_r($tmp_sizes); exit();
                    list($width, $height) = getimagesize($uploadfile);

                    //http://www.yiiframework.com/extension/easyimage/
                    try {
                        $image = new EasyImage($uploadfile);
                        $image->resize(150, 150);
                        $image->save($file_tumb);
                    } catch (Exception $e) {
                        echo 'Выброшено исключение3: ', $e->getMessage(), "\n";
                    }
                    try {
                        $file_tumb = $uploaddir . "/thumb_crop_50.jpg";
                        $image = new EasyImage($uploadfile);
                        $image->scaleAndCrop(50, 50);
                        $image->save($file_tumb);
                    } catch (Exception $e) {
                        echo 'Выброшено исключение4: ', $e->getMessage(), "\n";
                    }
                    try {

                        $file_tumb = $uploaddir . "/thumb_resize_50.jpg";
                        $image = new EasyImage($uploadfile);
                        if($width > $height){
                            $image->resize(2000, 60);
                        }else{
                            $image->resize(60, 2000);
                        }


                        $image->save($file_tumb);
                    } catch (Exception $e) {
                        echo 'Выброшено исключение4: ', $e->getMessage(), "\n";
                    }
                    try {
                        $file_tumb = $uploaddir . "/thumb_crop_250.jpg";
                        $image = new EasyImage($uploadfile);
                        $image->scaleAndCrop(250, 250);
                        $image->save($file_tumb);
                    } catch (Exception $e) {
                        echo 'Выброшено исключение4: ', $e->getMessage(), "\n";
                    }
                    try {
                        $file_tumb = $uploaddir . "/thumb_crop_160.jpg";
                        $image = new EasyImage($uploadfile);
                        $image->scaleAndCrop(160, 160);
                        $image->save($file_tumb);
                    } catch (Exception $e) {
                        echo 'Выброшено исключение5: ', $e->getMessage(), "\n";
                    }
                } else {
                    // echo "Возможная атака с помощью файловой загрузки!\n";
                }
                //print_r($tmp_sizes); exit();
            }
           //echo 11111113331;
            //print_r($_FILES);
//print_R($_POST['User']);
			$model->attributes=$_POST['User'];
			if($model->save()) {
                $this->redirect(array('view','id'=>$model->id));
            }
		}


        /*************/
        $sort = new CSort;
        $sort->defaultOrder = 'id DESC';
        $sort->attributes = array( );

        $dataProviderReviews = new CActiveDataProvider('Reviews',
            array(
                'pagination'=>array(
                    'pageSize'=>5,
                ),
                'sort' => $sort,
            )
        );

        $dataProviderReviews->criteria->join ='LEFT JOIN tbl_user ON tbl_user.id = t.user_vouter';
       // $dataProviderReviews->criteria->select = "t.*, tbl_user.vorname, tbl_user.nachname  ";
        $dataProviderReviews->criteria->condition = " user_receiver = '".$model->id."'";

        $dataProviderReviews->getTotalItemCount();
		$this->render('update',array(
			'model'=>$model,
            'dataProviderReviews'=>$dataProviderReviews,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        return false;
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
