<? include( $_SERVER['DOCUMENT_ROOT']."/datas.php");
//Yii::app()->request->urlReferrer = "/site/login";
error_reporting(E_ALL);
ini_set(' display_errors', '1');

//echo Yii::app()->user->id."2";
$model5= User::model()->findByPk( Yii::app()->user->id);
if(!empty($model5)){
	$data5 = $model5->attributes;
//print_R($data5);
    if(!empty($data5)) {
        $data5["last_visit"] = date("d.m.Y");
        $data5["last_visit_time"] = date("H:i");
        $model5->attributes = $data5;
        if ($model5->save()) {
        }
    }
}else{
   // $this->redirect("/");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />


    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.js"></script>


    <link rel="stylesheet" href="/css/bootstrap-3.3.2-dist/css/bootstrap.min.css">



    <link rel="stylesheet" href="/css/dev_css/my.css">
    <link rel="stylesheet" href="/css/dev_css/list.css">
    <link rel="stylesheet" href="/css/dev_css/form_style.css">
    <link rel="stylesheet" href="/css/dev_css/item.css">
    <link rel="stylesheet" href="/css/dev_css/filtr.css">
    <link rel="stylesheet" href="/css/dev_css/profile.css">
    <link rel="stylesheet" href="/css/dev_css/profile_edit.css">
    <link rel="stylesheet" href="/css/dev_css/message.css">

    <link rel="stylesheet" href="/css/dev_css/my_mobile.css">


    <script src="/css/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
    <script src="/css/js/main.js"></script>

    <link href="/css/js/lity-1.6.6/dist/lity.css" rel="stylesheet">

    <script src="/css/js/lity-1.6.6/vendor/jquery.js"></script>
    <script src="/css/js/lity-1.6.6/dist/lity.js"></script>

    <script src="/css/js/jquery.nanoscroller.min.js"></script>
    <link href="/css/js/nanoscroller.css" rel="stylesheet">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body >
<? //echo preg_replace("/![0-9]/is", "", "dfgdfg435");



$monthNum  = 10;
//echo $monthNum  = time();
$dateObj   = DateTime::createFromFormat('m', $monthNum);
//echo $monthName = $dateObj->format('F'); // March


?>
<? if(!empty($_GET["dev"])){?>
<div style="
    position:  fixed;
z-index: 999999;
    "
        >
        <button onclick="show_hide_ttt()">Show/hide</button>
    <form action="">
        <input type="hidden" name="dev" value="Y"/>
        <input type="text" maxlength="3" style="margin: 20px; width: 40px" value="<? echo $_GET['from_top_ttt']; ?>" name="from_top_ttt">
       <br>
        <input type="submit" value="применить">
    </form>
        <script >
            function show_hide_ttt(){
                $("#dev_background_ttt").toggle()
            }

        </script>

</div>

<div id="dev_background_ttt" style="
    <?
    $img_ttt = "";

    $img_ttt = "/css/img/dev_diz/INT5-6-black.jpg";
    $img_ttt = "/css/img/dev_diz/INT5-4-black.jpg";
    $img_ttt = "/css/img/dev_diz/INT5-4-popup.jpg";

    $img_ttt = "/css/img/dev_diz/INT5-10.jpg";
    $img_ttt = "/css/img/dev_diz/INT5-2.jpg";
    $img_ttt = "/css/img/dev_diz/INT5-9.jpg";
    $img_ttt = "/css/img/dev_diz/INT5-11.jpg";
    $img_ttt = "/css/img/dev_diz/INT5-8.jpg";

    ?>

background: url('<? echo $img_ttt; ?>') no-repeat center <? if(!empty($_GET['from_top_ttt'])){  echo $_GET['from_top_ttt'];}else{ echo 0; }?>px;
width: 100%;
height: 1500px;
opacity: 0.4;
position: absolute;
z-index: 99999;
"></div>
<?}?>


<div id='container'>

<div class="header_block_mobile">
    <a href="/site/filtr" class="logo"></a>


    <a onclick="$('.menu_mobile_list').toggle()" class="menu_mobile"></a>
    <ul class="menu_mobile_list">
        <li><a href="/site/filtr">Fahrt  suchen</a></li>
        <li><a href="/travels/create">Fahrt  anbieten</a></li>
        <li><a href="/message/index">Nachrichten</a></li>
        <li><a href="/travels/driverlist">Meine Fahrten</a></li>
        <li><a href="/user/view?id=<?=Yii::app()->user->id?>">Profil</a></li>

    </ul>
    <a href="/travels/create" class="new_travel">Fahrt  anbieten</a>
</div>   <!--header_block_mobile-->

<div class="header_block">
    <div class="center-block container_f" >
        <div class=" header">
            <a href="/site/filtr">
            <div class=" logo" >

               <div class="logo_name"> Simply <span>Hop</span></div>
                <div class="logo_desc"> City - einfach einsteigen</div>

            </div>
            </a>

            <div class="right_menu_top">
                <div class="r_links">
                <a  href="/message/index" class="message">

                    <?
                    $new_messages = Message::model()->count(
                        'receiver_user_id = :receiver_user_id '.
                        ' AND viewed =0',
                        array(":receiver_user_id"=>Yii::app()->user->id)
                    );
                 // echo $new_messages;
                    ?>
                    <? if($new_messages>0){?>
                    <span style=""><?=$new_messages?></span>
                    <?}?>
                    Nachrichten
                </a>
                <a  href="/travels/driverlist" class="my_travels">
                    Meine Fahrten
                </a>
                <a  href="/user/view?id=<? echo Yii::app()->user->id?>" class="profile">
                    <div class="foto_profile">
                    <? $u=User::model()->findByPk(Yii::app()->user->id);
                        if(!empty($u)){?>
	                    <img src="<?
	                    $Mix_f = new Mix_f;
	                    $img_code = $Mix_f->show_user_pic(Yii::app()->user->id, "header_pic");
	                    echo$img_code;
	                    ?>">

                        
                        </div>
                        
							
							<?=$u->vorname?> <?=$u->nachname?> <!--span></span-->
						<?}
                        ?>
                   
                </a>
                </div>
            </div><!--right_menu_top-->
            <div class=" links" >
                <a href="/site/filtr" class="suchen" >Fahrt  suchen</a>
                <a href="/travels/create" class="anbieten">Fahrt  anbieten</a>

            </div>
        </div>
    </div>
</div>
<? /*
<div class="container" id="page">
	<div id="mainmenu" style="display: non1e;">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('site/index')),
				array('label'=>'Filtr', 'url'=>array('site/filtr')),
				array('label'=>'Travels', 'url'=>array('travels/index')),
				array('label'=>'as driver', 'url'=>array('travels/driverlist')),
				array('label'=>'as traveller', 'url'=>array('travels/travelerlist')),
				array('label'=>'New travel', 'url'=>array('travels/create')),
				array('label'=>'messages', 'url'=>array('message/index')),
				array('label'=>'Login', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
</div><!-- page -->
*/?>

<?php echo $content; ?>
</div><!--container-->
<div class="footer_block" id='bottom'>
    <div class="center-block container_f" >
        <div class="col-sm-4 f_left" >

            <div class="f_logo">
                <div class="logo_name"> Simply <span>Hop</span></div>
                <div class="logo_desc_f"> City - einfach einsteigen</div>
            </div>
            <div class="f_social" >
                <a href="" ></a>
                <a href="" ></a>
            </div><!--f_social-->
            <div class="fdata">
                (c) 2016 simply hop
            </div>
        </div>

        <div class="col-sm-4 f_center" >
            <div class="f_title">
                Simply <span>Hop Company</span>
            </div>
            <div class="f_text">
                <a href="">Über uns</a><br>
                <!--Cookies<br>
                Mitfahr-Kodex<br>
                AGB<br>
                Datenschutzerklärung<br>
                Impressum<br>-->
            </div>

        </div>
        <div class="col-sm-1 " > </div>
        <div class="col-sm-3 f_right" >
            <div class="f_title">
                Simply <span>Hop Blog</span>
            </div>
            <div class="fr_text">
                <a href="">Alle Blog-Artikel sehen</a><br>

            </div>
        </div>
    </div>
</div>

</body>
</html>