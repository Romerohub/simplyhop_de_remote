<?php
/* @var $this MessageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Messages',
);

$this->menu=array(
	array('label'=>'Create Message', 'url'=>array('create')),
	array('label'=>'Manage Message', 'url'=>array('admin')),
);
?>



<div class="center-block container_mid ">
    <div class="msg_list_title">
        <span class="title_img" style="  background: url('/css/img/icons_dev2.png') #017eba -4px -1127px;"></span>
        <div class="title">
            nachrichten
        </div>
    </div>

    <div class="summary"> <div class="mitfahrten">185  Nachrichten  </div></div>
    <div class="msg_list ">
        <div class="msg_list_item active">
            <div class="user_info">
                <a class="img" href="/user/view?id=2" style="background: url(/upload/2/upic/thumb_100.jpg) no-repeat center top"></a>
                <div class="data_1">
                    <div class="data_1_1">Silvia</div>
                    <div class="data_1_2">23 Jahre</div>
                </div>
                <div class="data_2"><span>5.0</span>- 12 Bewertungen</div>
            </div>
            <div class="msg_info">
                <div class="data_3"><span></span>Donnerstag, den 30. Juni - 06:00 Uhr</div>
                <div class="data_4"><span>11.07.2016 in 23:44</span> <span class="data_4_1"> Hauptstraße 11, 30159 Hannover       Mailand</span></div>
                <div class="data_5"> Hallo!  <br>  ich komme 15 min spater...</div>
                <div class="data_6"><a href="">Antworten</a> <a href="">Anzeigen</a></div>
            </div>

        </div><!--msg_list_item-->

    </div><!--msg_list-->
</div><!--center-block container_mid-->


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
