<?php

class Mix_f {
    public static $day_names = array(

    1=> 'Montag',
    2=>'Dienstag',
    3=>'Mittwoch',
    4=>'Donnerstag',
    5=>'Freitag',
    6=>'Samstag',
    7=>'Sonntag',

    );

    public static $month_names = array(
    1=>'Januar',	2=>'Februar',	3=>'Marz',	4=>'April',	5=>'Mai',	6=>'Juni',	7=>'Juli'	,
    8=>'August',	9=>'September',	10=>'Oktober',	11=>'November', 12=>'Dezember'
    );


    static function show_date_week($data){
        $day_names = array(
            1=> 'Montag',
            2=>'Dienstag',
            3=>'Mittwoch',
            4=>'Donnerstag',
            5=>'Freitag',
            6=>'Samstag',
            7=>'Sonntag',
        );
        $month_names = array(
            1=>'Januar',	2=>'Februar',	3=>'Marz',	4=>'April',	5=>'Mai',	6=>'Juni',	7=>'Juli'	,
            8=>'August',	9=>'September',	10=>'Oktober',	11=>'November', 12=>'Dezember'
        );
        // echo  date( "Y-m-d H:i", strtotime( $data->datum_start .$data->datum_start_time ) );
       // $day_week= date( "N", strtotime( $data->datum_start .$data->datum_start_time ) );
         $day_week= date( "N", strtotime( $data->datum_start  ) );
         $day_month= date( "j", strtotime( $data->datum_start  ) );
          $month= date( "n", strtotime( $data->datum_start  ) );
      echo  $day_names[$day_week].", den ".$day_month.". ".$month_names[$month]." - ".$data->datum_start_time." Uhr";
    }
    static function show_date_week_stamp($data){
       // echo $data;
        $day_names = array(
            1=> 'Montag',
            2=>'Dienstag',
            3=>'Mittwoch',
            4=>'Donnerstag',
            5=>'Freitag',
            6=>'Samstag',
            7=>'Sonntag',
        );
        $month_names = array(
            1=>'Januar',	2=>'Februar',	3=>'Marz',	4=>'April',	5=>'Mai',	6=>'Juni',	7=>'Juli'	,
            8=>'August',	9=>'September',	10=>'Oktober',	11=>'November', 12=>'Dezember'
        );
        // echo  date( "Y-m-d H:i", strtotime( $data->datum_start .$data->datum_start_time ) );
        // $day_week= date( "N", strtotime( $data->datum_start .$data->datum_start_time ) );
        $day_week= date( "N", $data );
        $day_month= date( "j", $data );
        $month= date( "n", $data );
        echo  $day_names[$day_week]." ".$day_month.". ".$month_names[$month]." - ".date( "H:i", $data )." Uhr";
    }

    public function show_user_pic($user_id, $size = 0){
       // print_R($data);
        $u=User::model()->findByPk($user_id);
        $u->geschlecht; // 2- жен
        if($size == "pr_auto_edit"){
            $img1 = "/upload/". $user_id."/apic/thumb_100.jpg";
            $img = $_SERVER['DOCUMENT_ROOT'].$img1;
            if(file_exists($img)){
                return 'background: url('.$img1.') no-repeat center top';
                // return $img;
            }else{
                return  'background: url(/css/img/icons_dev2.png) no-repeat -9px -2141px';
            }
        }
        if($size == "pr_auto_view"){
            $img1 = "/upload/". $user_id."/apic/thumb_100.jpg";
            $img = $_SERVER['DOCUMENT_ROOT'].$img1;
            if(file_exists($img)){
                return 'background: url('.$img1.') no-repeat center top';
                // return $img;
            }else{
                return  'background: url(/css/img/icons_dev2.png) no-repeat -9px -1617px';
            }
        }


        if($size == "pr_edit"){
            $img1 = "/upload/". $user_id."/upic/thumb_100.jpg";
           $img = $_SERVER['DOCUMENT_ROOT'].$img1;
            if(file_exists($img)){
                return 'background: url('.$img1.') no-repeat center top';
               // return $img;
            }else{
               return  'background: url(/css/img/icons_dev2.png) no-repeat -9px -1894px;';
            }
        }
        // в списке поездок
        if($size == "list_view"){
            $img1 = "/upload/". $user_id."/upic/thumb_100.jpg";
            $img = $_SERVER['DOCUMENT_ROOT'].$img1;
            if(file_exists($img)){
                return 'background: url('.$img1.') no-repeat center top; background-size: 102%;';
                // return $img;
            }else{
                if($u->geschlecht == 1){
                    return  'background: url(/css/img/icons_dev2.png) no-repeat -9px -1243px';
                }elseif($u->geschlecht == 2){
                    return  'background: url(/css/img/icons_dev2.png) no-repeat -17px -1385px';
                }
                return  'background: url(/css/img/icons_dev2.png) no-repeat -9px -1894px;';
            }
        }
        if($size == "view_small"){
            $img1 = "/upload/". $user_id."/upic/thumb_resize_50.jpg";
            $img = $_SERVER['DOCUMENT_ROOT'].$img1;
            if(file_exists($img)){
                return 'background: url('.$img1.') no-repeat center top; ';
                // return $img;
            }else{
                if($u->geschlecht == 1){
                    return  'background: url(/css/img/default_man.png) no-repeat 0px 0px;   background-size: 99%;';
                   // return  'background: url(/css/img/icons_dev2.png) no-repeat -24px -1248px';
                }elseif($u->geschlecht == 2){
                    return  'background: url(/css/img/default_woman.png) no-repeat 0px 0px;   background-size: 99%;';
                   // return  'background: url(/css/img/icons_dev2.png) no-repeat -30px -1393px';
                }
                return  'background: url(/css/img/default_50.png) no-repeat center center;';
            }
        }
        if($size == "view_small_40"){
            $img1 = "/upload/". $user_id."/upic/thumb_resize_40.jpg";
            $img = $_SERVER['DOCUMENT_ROOT'].$img1;
            if(file_exists($img)){
                return 'background: url('.$img1.') no-repeat center top';
                // return $img;
            }else{
                if($u->geschlecht == 1){
                    return  'background: url(/css/img/default_man.png) no-repeat 0px 0px;   background-size: 99%;';
                   // return  'background: url(/css/img/icons_dev2.png) no-repeat -24px -1248px';
                }elseif($u->geschlecht == 2){
                    return  'background: url(/css/img/default_woman.png) no-repeat 0px 0px;   background-size: 99%;';
                   // return  'background: url(/css/img/icons_dev2.png) no-repeat -30px -1393px';
                }
                return  'background: url(/css/img/default_50.png) no-repeat center center;';
            }
        }


        if($size == "header_pic"){

             $img1 = "/upload/". $user_id."/upic/thumb_crop_50.jpg";
            $img = $_SERVER['DOCUMENT_ROOT'].$img1;
            if(file_exists($img)){
                return $img1;
            }else{
                if($u->geschlecht == 1){
                    return  "/css/img/default_man.png";
                }else{
                    return  "/css/img/default_woman.png";
                }
                return  "/css/img/default_50.png";
            }

            return false;

        }
        if($size == "250"){
            echo "/upload/". $user_id."/upic/thumb_crop_250.jpg";
            return false;
        }
        if($size == "160"){
            $img1 = "/upload/". $user_id."/upic/thumb_crop_160.jpg";
            $img = $_SERVER['DOCUMENT_ROOT'].$img1;
            if(file_exists($img)){
                return 'background: url('.$img1.') no-repeat center top';
                // return $img;
            }else{
                return  'background: url(/css/img/icons_dev2.png) no-repeat 10px -1865px;';
            }

            return false;
        }
        echo "/upload/". $user_id."/upic/thumb_100.jpg";

    }

    public function show_total($data , $res_places, $res_gep=0 ){

        $tmp_total = 0;
        $tmp_total2 = 0;
//echo $data->id;
        $resource_cnt = Request::model()->findAll(array(
                // 'select'=>' id, SUM(freie) as amt',
                'condition'=>'travel_id=:travel_id'            ,
                'params'=>array( ":travel_id"=>$data->id)
            )
        );
        foreach($resource_cnt as $k=>$v){
            //echo $v->freie;
            $tmp_total = $tmp_total + $v->freie;
            $tmp_total2 = $tmp_total2 + $v->gep;
        }
       // echo $tmp_total;
        $res_places = $res_places - $tmp_total;
        if($res_places < 1){
            $res_places = 0;
        }
        $res_gep = $res_gep - $tmp_total2;
        if($res_gep < 1){
            $res_gep = 0;
        }
        return array("res_places"=>$res_places, "gep"=>$res_gep);
    }


    public function show_age11($data){
//echo $data;
       //echo  $data = str_replace(".","/",$data);

        $d = explode(".", $data);
//print_R($d);
        $data = $d[2]."-".$d[1]."-".$d[0];
        echo "-";

        $dob=$data;
        $diff = (date('Y') - date('Y',strtotime($dob)));
        echo $diff;

       // echo date_diff(date_create($data), date_create('today'))->y;

        echo "-29 Jahre";

    }

    function show_age($birthday){
       // print_r($birthday);
        list($day, $month, $year) = explode(".", $birthday);

       $year_diff  = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff   = date("d") - $day;
        if ($day_diff < 0 && $month_diff==0) $year_diff--;
        if ($day_diff < 0 && $month_diff < 0) $year_diff--;

        return $year_diff ." Jahre";
    }



    function count_review($u_id, $v=1){

        $total = 0;
        $s = 0;
        $Reviews=Reviews::model()->findAll('user_receiver=:user_receiver', array(':user_receiver'=>$u_id));
        foreach($Reviews as $kkk=>$vvv){
            $total = $total+1;
            $s = $s+ $vvv->vote;
        }
        if($total==0){
            $r = 0;
        }else{
            $r = $s/$total;
        }

        if($v== 1) {
            ?>
            <span class="data_3"><?= round($r, 1) ?></span>
            <span class="data_4">- <?= $total; ?> Bewertungen</span>
        <?
        }else if($v=2) {
            ?><span><?= round($r, 1) ?> - <?= $total; ?> Bewertungen</span><?
        }
    }

    function show_stars( $r=0){

        ?><div class="stars"><?
        for ($i = 1; $i <= 5; $i++) {
            $class= "";
            if($i <= $r){
              $class= "star";
            }
            ?>
            <span class="<?= $class?>"></span>
        <?
        }
        ?></div>
    <div style="clear:both;"></div><?

    }
}