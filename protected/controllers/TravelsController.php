<?php

class TravelsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';
    public $layout='//layouts/column1';
    //public $layout='//layouts/main';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            //'postOnly + delete', // we only allow deletion via POST request
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                // 'actions'=>array(),
                'actions'=>array('index','view', 'travelerlist', 'driverlist','reviewslist' ),
                //'users'=>array('*'),
                'users'=>array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update','delete'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    public function actionReviewslist()
    {
        $rout = 0;
        if(!empty($_GET['rout']) && (int)$_GET['rout']){
            $rout = (int)$_GET['rout'];
        }else{

            return;
        }

        $sort = new CSort;
        $sort->defaultOrder = 'id DESC';
        $sort->attributes = array(        );
        //как перевозчик
        /* $dataProvider=new CActiveDataProvider('Travels',
             array(
                 'pagination'=>array(
                     'pageSize'=>10,
                 ),
                 'sort' => $sort,
             )
         );
          $dataProvider->criteria->condition =

             " id IN (SELECT travel_id FROM tbl_request as tr "
             ."WHERE travel_id= '" .$rout ."' "
             .")";*/

        /*
         $dataProvider=new CActiveDataProvider('Travels',
                    array(
                        'pagination'=>array(
                            'pageSize'=>10,
                        ),
                        //'sort' => $sort,
                    )
                );
                $dataProvider->criteria->join = ' LEFT JOIN tbl_request ON tbl_request.travel_id = t.id ';
                 //$dataProvider->criteria->select = 't.*, tbl_request.user_request_id ';
                    $dataProvider->criteria->with = array("travelId") ;
                $dataProvider->criteria->condition = " travel_id= '" .$rout ."' ";
                $dataProvider->criteria->together=true;
        $dataProvider->criteria->distinct = false;*/


        $dataProvider=new CActiveDataProvider('Request',
            array(
                'pagination'=>array(
                    'pageSize'=>10,
                ),
                // 'sort' => $sort,
            )
        );

        $dataProvider->criteria->join = ' LEFT JOIN tbl_travels ON tbl_travels.id = t.travel_id ';
        $dataProvider->criteria->select = 't.user_request_id, t.travel_id, tbl_travels.* ';
        $dataProvider->criteria->with = array("travelId") ;
        $dataProvider->criteria->condition = " travel_id= '" .$rout ."' ";
        $dataProvider->criteria->together=true;
        $dataProvider->criteria->distinct = false;

        $this->render('driver_list',array(
            'driver'=>false,
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionDriverlist(){
        $sort = new CSort;
        $sort->defaultOrder = 'id DESC';
        $sort->attributes = array(        );
        //как перевозчик
        $dataProvider=new CActiveDataProvider('Travels',
            array(
                'pagination'=>array(
                    'pageSize'=>10,
                ),
                'sort' => $sort,
            )
        );

        //$dataProvider->criteria->addInCondition('id', array(51));

        $dataProvider->criteria->condition = "travel_owner_id = ".Yii::app()->user->id;
        $this->render('driver_list',array(
            'driver'=>true,
            'dataProvider'=>$dataProvider,
        ));
    }
    public function actionTravelerlist(){
        //как пассажир

        $sort = new CSort;
        $sort->defaultOrder = 'id DESC';
        $sort->attributes = array(  );

        $dataProvider=new CActiveDataProvider('Travels',
            array(
                'pagination'=>array(
                    'pageSize'=>10,
                ),
                'sort' => $sort,
            ));

        //$dataProvider->criteria->addInCondition('id', array(51));

        $dataProvider->criteria->condition =

            " id IN (SELECT travel_id FROM tbl_request as tr "
            ."WHERE user_request_id= '" .Yii::app()->user->id ."' "
            .")";


        $this->render('driver_list',array(
            "traveller"=>true,
            'dataProvider'=>$dataProvider,
        ));
    }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        //print_R($_SESSION);
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Travels;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $old_data = array();
        if(!empty($_GET['rout'])){
           // $m = $this->loadModel((int)$_GET['rout']);
            $m = Travels::model()->findByPk((int)$_GET['rout']);
            if($m===null){

            }else{
                $old_data=$m->attributes;
                $model=Travels::model()->findByPk($old_data["id"]);
            }
        }

        if(isset($_POST['Travels']))
        {
            //print_R($_POST['Travels']);
            $data = $_POST['Travels'];
            if(!empty($data['form_umweg'])){
                //  $data['form_umweg'] = preg_replace("/![0-9]/is", "", $data['form_umweg']);
                $data['form_umweg'] = (int)$data['form_umweg'];
            }else{
                $data['form_umweg'] = 0;
            }

            if(!empty($_POST['Raucher'])){
                $data["form_raucher"] = $_POST['Raucher'];
            }
            if(!empty($_POST['form_max_2'])){
                $data["form_max_2"] = 1;
            }else{
                $data["form_max_2"] = 0;
            }

            $data['datum_start_time'] = str_replace(":",".",$data['datum_start_time']);

            if($data['datum_start_time'] > 23.59){
                $data['datum_start_time'] = 0;
            }
            $data['date_start_timestamp'] =  strtotime($data['datum_start']." ".$data['datum_start_time']);
            //echo date("d-m-Y H:i", $t);

            //
            $data["date_add"] = time();

            $model->attributes= $data;

            $search_list = array();

            if(!empty($old_data["id"])){
              //  $model->update();

            }else{
               // $model->save();
            }

            if($model->save()){
                $search_list[] = $data["form_start"];
                if(!empty($_POST['extra']) && is_array($_POST['extra'])){

                    foreach($_POST['extra'] as $k=>$v){
                        if(empty($v)){
                            continue;
                        }
                        $model_p=new Points;
                        $model_p->attributes = array("name"=>$v, "travel_id"=>$model->id, "full_name"=>$v);
                        $model_p->save();
                        $search_list[] = $v;
                    }
                }
                $search_list[] = $data["form_ziel"];
                if(!empty($search_list)){

                    //print_r($search_list);
                    $search_list_result = array();

                    /*foreach($search_list as $k=>$v){
                        $point["name_from"] = $v;
                        if(isset($search_list[$k+1])){
                            $point["name_to"] = $search_list[$k+1];
                            $point ["travel_id"] = $model->id;
                            $search_list_result[] = $point;
                        }
                    }*/
                    foreach($search_list as $k=>$v){
                        $point["name_from"] = $v;
                        $point["full_name_from"] = $v;
                        foreach($search_list as $kk=>$vv){
                            if($k < $kk){
                                // if(isset($search_list[$kk+1])){
                                $point["name_to"] = $vv;
                                $point["full_name_to"] = $vv;
                                $point ["travel_id"] = $model->id;
                                $search_list_result[] = $point;
                                //  }
                            }
                        }
                    }

                    // print_R($search_list_result);

                    if(!empty($old_data["id"])){
                        RoutsSearch::model()->deleteAll("travel_id=".$old_data["id"]);
                    }

                    foreach($search_list_result as $kk=>$vv){
                        $model_r=new RoutsSearch();
                        $model_r->attributes = $vv;
                        $model_r->save();
                    }
                }

                /******* ESTIMATE TIME**********/

                $p = "https://maps.googleapis.com/maps/api/distancematrix/json?".
                    "origins=".str_replace(" ","+",$data["form_start"]).
                    ",".str_replace(" ","+",$data["form_stadt"]).
                    "&destinations=".str_replace(" ","+",$data["form_ziel"]).",".str_replace(" ","+",$data["form_stadt"]).
                    "&mode=driving&language=de&key=".Yii::app()->params->googleApiKey;

                $curlSession = curl_init();
                curl_setopt($curlSession, CURLOPT_URL, $p);
                curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
                curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

                $r = curl_exec($curlSession);
                $jsonData = json_decode($r);
                // print_R($jsonData);
                $estimate_time = 0;

                curl_close($curlSession);
                foreach($jsonData->rows as $k=>$v){
                    //print_r($v);
                    if(!empty($v->elements)){
                        foreach ($v->elements as $kkk=>$vvv) {
                            if($vvv->status == "OK"){
                                //echo $vvv->distance->value."-";
                                if(isset($vvv->distance->value) ){
                                    $estimate_time = $vvv->duration->value;
                                    //echo $estimate_time;
                                }
                            }
                        }
                    }
                }

                $model2=Travels::model()->findByPk($model->id);
                $data2 = $model2->attributes;
//print_R($data2);
                $data2["estimate_time"] = $estimate_time;
                $model2->attributes= $data2;
                if($model2->save()){
                    //echo 333;
                }
                /******* END ESTIMATE TIME**********/

                // print_r($_POST);
                //exit;

                $this->redirect(array('view','id'=>$model->id));
            }
            //print_r($model);
        }

        $this->render('create',array(
            'model'=>$model,
            'old_data'=>$old_data
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        return false;
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Travels']))
        {
            $model->attributes=$_POST['Travels'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {

        RoutsSearch::model()->deleteAll("travel_id=".(int)$id);

        $this->loadModel($id)->delete();
        $this->redirect("/travels/driverlist/");
        return;
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        //  "/travels/?city=Hannover&from=Ronnenberg&to=Sehnde&date=27.08.2016&time=11.11"
        // /travels/index?city=Hannover&from=Lehrte&to=Laatzen&date=27.08.2016&time=11.11
        //?city=Hannover&from=Lehrte&to=Ronnenberg&date=27.08.2016&time=11.11
        /*
                $_GET['city']         $_GET['from']        $_GET['to']        $_GET['date']        $_GET['time']
        */
        $sql1 = " ";
        if(!empty($_GET['date'])){
            $datum_start = $_GET['date'];
            $sql1 =" datum_start = '".$datum_start."' AND ";
        }
        if(isset($_GET['date'])){
            $_SESSION["filtr"]["date"] = $_GET['date'];
        }
        $sql2 = "";
        if(!empty($_GET['time'])){
            $datum_start_time = $_GET['time'];
            //(latitude BETWEEN 41.439998626708984 AND 41.939998626708984 )
            // echo $_GET['time']-1;
            // $sql2=" datum_start_time = '".$datum_start_time."' AND ";
            $sql2=" (datum_start_time BETWEEN ".($datum_start_time-1)." AND ".($datum_start_time+1)." ) AND ";
        }
        if(isset($_GET['time'])){
            $_SESSION["filtr"]["time"] = $_GET['time'];
        }
        // if(!empty($_GET['from']) && !empty($_GET['to']) && !empty($_GET['city'])){
        if(!empty($_GET['city'])){
            $city = $_GET['city'];
        }
        if(isset($_GET['city'])){
            $_SESSION["filtr"]["city"] = $_GET['city'];
        }
        if(!empty($_GET['from']) && !empty($_GET['to']) ){
            $from = $_GET['from'];
            $to = $_GET['to'];
            $sql3 = "WHERE `name_from` ='".$from."' AND `name_to`='".$to."'";
        }
        if(isset($_GET['from'])){
            $_SESSION["filtr"]["from"] = $_GET['from'];
        }
        if(isset($_GET['to'])){
            $_SESSION["filtr"]["to"] = $_GET['to'];
        }

        /****** START FILTR *******/
        include($_SERVER['DOCUMENT_ROOT']."/protected/views/parts/count_filtr.php");

        $sql4 = "";
        if(!empty($routsFromListOUT)){
            $tmp_str ="";
            foreach($routsFromListOUT as $k=>$v){
                if(!empty($tmp_str) && !empty($v)){
                    $tmp_str = $tmp_str.",";
                }
                $tmp_str = $tmp_str."'".$v."'";
            }
            $tmp_str = "'".$from."',".$tmp_str;
            $sql4 = " `name_from` IN(".$tmp_str.")";
        }else{
            $sql4 =" `name_from` ='".$from."' ";
        }
        // echo $sql4;
/////////////////
        if(!empty($routsToListOUT)){
            $tmp_str ="";
            foreach($routsToListOUT as $k=>$v){
                if(!empty($tmp_str) && !empty($v)){
                    $tmp_str = $tmp_str.",";
                }
                $tmp_str = $tmp_str."'".$v."'";
            }
            $tmp_str = "'".$to."',".$tmp_str;
            if(!empty($sql4)){ $sql4 = $sql4." AND ";}
            $sql4 .= " `name_to` IN(".$tmp_str.")";
        }else{
            //echo $sql4;
            if(!empty($sql4)){ $sql4 = $sql4." AND ";}
            //echo "=".$sql4;
            $sql4 .=" `name_to` ='".$to."' ";
            // echo $sql4;
        }
/////////////////////
        if(!empty($sql4)){
            $sql3 = "WHERE ".$sql4;
            //  echo  "WHERE ".$sql4;
        }
        /********  END FILTR *********/


        $sort = new CSort;
        $sort->defaultOrder = 'id DESC';
        $sort->attributes = array(  );

        //$sql= "SELECT * FROM Travels WHERE id IN (SELECT travel_id FROM tbl_routs_search as trs
        //WHERE name_from =".$from." AND name_to=".$to." GROUP BY trs_travel_id)";


        $dataProvider=new CActiveDataProvider('Travels',
            array(
                'pagination'=>array(
                    'pageSize'=>10,
                ),
                'sort' => $sort,
            ));

        //$dataProvider->criteria->addInCondition('id', array(51));
        if($_GET['dvp']=="y") { echo $sql3;}
        // $sql3=   " WHERE  `name_to` IN('Westendstraße 3','Hohenzollernstraße 1','Volgersweg 1') ";

        if(empty( $_GET['from']) && empty($_GET['to'])){
//echo $city;
            $dataProvider->criteria->condition =
                " date_start_timestamp > '".time()."' AND  `form_stadt`='".$city."'  ".
                " ";
        }else{
            $dataProvider->criteria->condition =
                $sql1.
                $sql2.
                " date_start_timestamp > '".time()."' AND  `form_stadt`='".$city."' AND ".
                " id IN (SELECT travel_id FROM tbl_routs_search as trs ".
                $sql3.
                " GROUP BY trs.travel_id"
                .")";
        }




        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));

    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Travels('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Travels']))
            $model->attributes=$_GET['Travels'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Travels the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Travels::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Travels $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='travels-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
