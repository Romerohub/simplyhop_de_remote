<?
error_reporting(E_ALL);
ini_set(' display_errors', '1');

//https://console.developers.google.com/apis/api/directions_backend?project=_
// поиск мест по названию и данные по ним
//https://www.google.com.ua/url?sa=t&rct=j&q=&esrc=s&source=web&cd=4&cad=rja&uact=8&ved=0ahUKEwjXnbGdoqrOAhUGQJoKHa_PC8YQFgg3MAM&url=https%3A%2F%2Fdevelopers.google.com%2Fplaces%2Fweb-service%2Fsearch%3Fhl%3Dru&usg=AFQjCNFPdgqTmavwJhcq4GUAp2M-1kC6uA&sig2=0lf82rEdkl0K6de_o2EcNg
//ближайшие места
//https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=52.369309,9.707371&radius=500&key=AIzaSyBiEx2SiglfERkZch_N74J4lDCyu00pdh0

//http://services.gisgraphy.com/ajaxgeolocsearch!search.html?lat=52.365769&lng=9.6787829&radius=5000&placetype=city&&distance=true
//https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=52.369309,9.707371&radius=500&key=AIzaSyBiEx2SiglfERkZch_N74J4lDCyu00pdh0
//http://developer.tomtom.com/io-docs - можно получить номера улиц походу
//http://www.geonames.org/maps/osm-reverse-geocoder.html#findNearbyStreetsOSM - а это, платное

//https://www.freemaptools.com/frequently-asked-questions.htm  -- сервис но если что можно будет вытянуть

//расстояния до точек, множественное
//https://developers.google.com/maps/documentation/distance-matrix/intro

$key = "AIzaSyBiEx2SiglfERkZch_N74J4lDCyu00pdh0";
$lang = "de";
$country = "country:DE";
//print_R($_POST);
$res_out = array();
$res_out["list"]= array();

$IS_TEST = true;
$IS_TEST = false;

//про места
//https://developers.google.com/places/place-id?hl=ru
////https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJrTLr-GyuEmsRBfy61i59si0&key=YOUR_API_KEY
if(!empty($_POST['place_data']) && isset($_POST['place_data_name'])){
    $place_data_name = $_POST['place_data_name'];
    $place_data_name = urlencode($place_data_name);
   $str = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=".
       $place_data_name."&key=".$key;
//echo $str;

    $curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, $str);
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

    $jsonData = json_decode(curl_exec($curlSession));
    curl_close($curlSession);
    //print_R($jsonData->results[0]->formatted_address);

    if(!empty($jsonData->results[0]->formatted_address)){
        $tmp = explode(",",$jsonData->results[0]->formatted_address);
        if(!empty($tmp[0])){
            echo $tmp[0];
        }
    }

exit;
}else if(!empty($_POST['city'] ) && $_POST['city'] == "y"){
   // echo "city";

    $name = str_replace(" ","+",$_POST['name']);

    //подсказка по нескольким буквам
    //города
    $str = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=".$name
        ."&types=(cities)&language=".$lang.
        "&components=".$country.
        "&key=".$key;
    //https://developers.google.com/places/web-service/autocomplete

    //echo $str;  exit;

    if($IS_TEST){
        echo json_encode(array("list"=>array(
            array('desc'=>111,"place_id"=>"333"),
            array('desc'=>2222,"place_id"=>"5555533"),

        )));
        exit;
    }


   // echo $str;
   // exit;

    $curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, $str);
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

    $jsonData = json_decode(curl_exec($curlSession));
    curl_close($curlSession);
//print_r($jsonData->predictions);
    foreach($jsonData->predictions as $v){
        $tmp["desc"] = $v->description;
        $t = explode(",", $tmp["desc"] );
        if(!empty($t[0])){
            $tmp["desc"] = $t[0];
        }

        $tmp["place_id"] = $v->place_id;

        $res_out["list"][] = $tmp;
    }


}else if(!empty($_POST['organization'] ) && (int)$_POST['organization'] == 1){
    $name = str_replace(" ","+",$_POST['name']);
    if(!empty($_POST['city_name'])){
          $name = $name.",".str_replace(" ","+",$_POST['city_name']);
    }
    $str = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=".$name.
        "&types=establishment&language=".$lang."&key=".$key
        //."&location=".$_POST['lat'].",".$_POST["lng"]."&radius=3000"
        ."&components=".$country;

    //https://developers.google.com/places/web-service/autocomplete
   // echo $str;
    // exit;

    $curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, $str);
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

    $jsonData = json_decode(curl_exec($curlSession));
    curl_close($curlSession);
   // print_R($jsonData);
    foreach($jsonData->predictions as $v){
        $tmp["desc"] = $v->description;
        $t = explode(",", $tmp["desc"] );
        if(!empty($t[0])){
            $tmp["desc"] = $t[0];
        }
        $tmp["place_id"] = $v->place_id;

        $is_present = false;
        foreach($res_out["list"] as $kk=>$vv){
            if(
                $vv['desc'] == $tmp["desc"]){
                $is_present = true;
            }

        }
        if($is_present){
            continue;
        }
        $res_out["list"][] = $tmp;
    }

}else if(!empty($_POST['street'] ) && $_POST['street'] == "y"){
    //echo "street";

    $name = str_replace(" ","+",$_POST['name']);

    if($IS_TEST){
        echo json_encode(array("list"=>array("test2", "test3")));
        exit;
    }
    if(!empty($_POST['city_name'])){
       // $name =  str_replace(" ","+",$_POST['city_name']).",".$name;
    }
    $lnglat = "";
    if(!empty($_POST["latlng"])){
        $lnglat ="&location=".$_POST["latlng"]."&radius=5000";
    }

    //подсказка по нескольким буквам
    //адреса

    $str = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=".$name.
        //"&types=geocode".
        "&types=address".
        "&language=".$lang."&key=".$key
        .$lnglat
       //."&location=".$_POST['lat'].",".$_POST["lng"]."&radius=3000"
        ."&components=".$country;

    //https://developers.google.com/places/web-service/autocomplete
    //echo $str;
   // exit;

    $curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, $str);
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

    $jsonData = json_decode(curl_exec($curlSession));
    curl_close($curlSession);

  //  print_R($jsonData->predictions);
    foreach($jsonData->predictions as $v){
        $tmp["desc"] = $v->description;
        $t = explode(",", $tmp["desc"] );
        if(!empty($t[0])){
            $tmp["desc"] = $t[0];
        }
        $tmp["place_id"] = $v->place_id;

        $is_present = false;
        foreach($res_out["list"] as $kk=>$vv){
            if(
            $vv['desc'] == $tmp["desc"]){
                $is_present = true;
            }

        }
        if($is_present){
            continue;
        }
        $res_out["list"][] = $tmp;
    }

}

echo json_encode($res_out);




exit;



//расстояние
//https://developers.google.com/maps/documentation/distance-matrix/intro
$str = "https://maps.googleapis.com/maps/api/distancematrix/json?".
    "origins=Vancouver+BC|Seattle&destinations=San+Francisco|Victoria+BC&mode=bicycling&language=fr-FR".
    "&key=".$key;


echo $str;
//echo file_get_contents($str);

//координаты по улице
//https://developers.google.com/maps/documentation/geocoding/intro?hl=ru
$str = "https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=".$key;
echo $str;

//подсказка по нескольким буквам
//https://developers.google.com/places/web-service/autocomplete?hl=ru#place_autocomplete_requests
//адреса
$str = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=Vict&types=geocode&language=fr&key=".$key;
//города
$str = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=Vict&types=(cities)&language=pt_BR&key=".$key;
//https://developers.google.com/places/web-service/autocomplete

$curlSession = curl_init();
curl_setopt($curlSession, CURLOPT_URL, $str);
curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

$jsonData = json_decode(curl_exec($curlSession));
curl_close($curlSession);

print_R($jsonData);

echo 1;