<?php
//$routsFrom = RoutsSearch::model()->findAll();
// группируем и получаем список улиц и фильтруем по городу
$routsFrom =   RoutsSearch::model()->with(array(
    'travel'=>array(
        'condition'=> "  form_stadt=:form_stadt ",
        //'condition'=> " t.name_from =:name_from AND form_stadt=:form_stadt ",
        'params'=> array( ':form_stadt'=> $city ),
        // 'params'=> array(":name_from"=>$from, ':form_stadt'=> $city ),
        'group'=>'name_from'
    ),
))->findAll();
$routsFromList = array();
$routsFromListStr = "";
foreach($routsFrom as $k=>$v){
    if($v->name_from == $from){
        continue;
    }

    if(!empty($routsFromListStr)){
        $routsFromListStr = $routsFromListStr."|";
    }
    $routsFromList[] = $v->name_from;
    $routsFromListStr = $routsFromListStr . $v->name_from.",".$city;
}
//print_R($routsFromList);
//////////////////////////////////////////////////////////
$routsTo =   RoutsSearch::model()->with(array(
    'travel'=>array(
        'condition'=> "  form_stadt=:form_stadt ",
        'params'=> array( ':form_stadt'=> $city ),
        'group'=>'name_to'
    ),
))->findAll();
$routsToList = array();
$routsToListStr = "";
foreach($routsTo as $k=>$v){
    $routsToList[] = $v->name_to;

    if($v->name_to == $to){
        continue;
    }

    if(!empty($routsToListStr)){
        $routsToListStr = $routsToListStr."|";
    }
    $routsToList[] = $v->name_from;
    $routsToListStr = $routsToListStr . $v->name_to.",".$city;
}
// print_R($routsToList);

/*
$p = "https://maps.googleapis.com/maps/api/distancematrix/json?".
    "origins=Hildesheim,Hannover".
    "&destinations=".
    "Hildesheimer,Hannover|".
    "Straße,Hannover|".
    "Peine,Hannover|".
    "Peine+Bahnhof,Hannover|".
    "Peiting,Hannover|".
    "Peitinger,Hannover|".
    "Weg,Hannover|".
    "StuttgartMitte,Hannover|".
    "Mittelstraße,Hannover|".
    "Wunstorf,Hannover|".
    "Wunstorf+ZOB,Hannover|".
    "Stuttgart,Hannover".
    "&mode=bicycling&language=de&key=".Yii::app()->params->googleApiKey;*/

/////////////////////////////////////////////////////////////
$p = "https://maps.googleapis.com/maps/api/distancematrix/json?".
    "origins=".$from.",".$city.
    "&destinations=".$routsFromListStr.
    "&mode=driving&language=de&key=".Yii::app()->params->googleApiKey;
$p =str_replace(" ","+",$p);
//echo $p;

$curlSession = curl_init();
curl_setopt($curlSession, CURLOPT_URL, $p);
curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

$r = curl_exec($curlSession);
$jsonData = json_decode($r);
//
curl_close($curlSession);
if($_GET['dvp']=="y"){ echo $p; print_r($jsonData); }
$radius = 5*1000;
$jsonData->destination_addresses;
$routsFromListOUT=array();
if(!empty($jsonData->rows)){
foreach($jsonData->rows as $k=>$v){
   //print_r($v);
            if(!empty($v->elements)){
                foreach ($v->elements as $kkk=>$vvv) {
                    if($vvv->status == "OK"){
                        //echo $vvv->distance->value."-";
                        if(isset($vvv->distance->value) && $vvv->distance->value<= $radius){
                            $routsFromListOUT[] = $routsFromList[$kkk];
                        }
                    }
                }
            }
}
}
 //////////////////////////////////////////////////////////////
$p = "https://maps.googleapis.com/maps/api/distancematrix/json?".
    "origins=".$to.",".$city.
    "&destinations=".$routsToListStr.
    "&mode=driving&language=de&key=".Yii::app()->params->googleApiKey;
$p =str_replace(" ","+",$p);
//echo $p;

$curlSession = curl_init();
curl_setopt($curlSession, CURLOPT_URL, $p);
curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

$r = curl_exec($curlSession);
$jsonData = json_decode($r);
//
curl_close($curlSession);
if($_GET['dvp']=="y"){ echo $p; print_r($jsonData); }
$radius = 5*1000;
$jsonData->destination_addresses;
$routsToListOUT=array();
if(!empty($jsonData->rows)) {
    foreach ($jsonData->rows as $k => $v) {
       // print_r($v);
        if (!empty($v->elements)) {
            foreach ($v->elements as $kkk => $vvv) {
                if ($vvv->status == "OK") {
                    //echo $vvv->distance->value."-";
                    if (isset($vvv->distance->value) && $vvv->distance->value <= $radius) {
                        $routsToListOUT[] = $routsToList[$kkk];
                    }
                }
            }
        }
    }
}


//print_R($routsFromListOUT);
//print_R($routsToListOUT);
///////////////////////////////////////////////

//exit;
/* $services_gisgraphy=array();

 for ($i = 1; $i <= 2; $i++) {
     $str = "http://services.gisgraphy.com/geoloc/search?lat=52.369309&lng=9.707371" .
         "&radius=5000&format=json&from=1&to=30";

     $curlSession = curl_init();
     curl_setopt($curlSession, CURLOPT_URL, $str);
     curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
     curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

     $r = curl_exec($curlSession);
     $jsonData = json_decode($r);

     curl_close($curlSession);
     //echo $jsonData->numFound;

     if ($jsonData->numFound < 1) {
         //break;
     }

     // print_r($jsonData->result );
     if(is_array($jsonData->result)) {
         foreach ($jsonData->result as $kk => $vv) {
             print_r($vv);
         }
     }else{
         //print_r($r);
     }
     //sleep(5);
 }
 exit;*/