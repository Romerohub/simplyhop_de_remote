<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/bootstrap-3.3.2-dist/css/bootstrap.min.css">
    <script src="/css/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dev_css/enter_page.css" />
    <!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/my.css" /-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="center-block container_c" >

    <div class="enter_f">
        <img src="/css/img/main_logo.png" width="270px">


        <div  class="text_f">
            Unsere Vision von flexibler Mobilität <br>
            durch
            Mitfahrmöglichkeit in deiner Stadt.<br>
            Einfach kostenlos über Facebook <br>
            anmelden und
            Fahrten anbieten oder<br> mitfahren.
        </div>

        <img src="/css/img/map.png" style="max-width:333px; width: 100%;">


        <? $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login')); ?>

        <!--a href="/site/filtr">
            <img class="facebook_btn" src="/css/img/facebook.png">
        </a-->


    </div><!--enter_f-->

</div>


</body>
</html>