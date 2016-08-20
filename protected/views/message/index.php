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



<div class="center-block container_mid message_content">
    <div class="msg_list_title">
        <span class="title_img" style="  background: url('/css/img/icons_dev2.png') #017eba 2px -2260px;"></span>
        <div class="title">
            nachrichten
        </div>
    </div>

    <div class="msg_list ">

        <?php $r = $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
            'template'=>"{summary}{items} ",
            'summaryText'=>' <div class="mitfahrten">{count}   Nachrichten</div>',
            'pager' => array(
                'firstPageLabel'=>'<<',
                'prevPageLabel'=>'<',
                'nextPageLabel'=>'>',
                'lastPageLabel'=>'>>',
                'maxButtonCount'=>'10',
                'header'=>' ',
                'cssFile'=>false,
            ),
        )); ?>
        <div class="list_pager">
            <?             $t =$dataProvider->getPagination();         ?>
            <div class="title_l">  <?
                if($t->getPageCount() <1){
                    echo 0;
                }else{
                    echo $t->getCurrentPage()+1;
                }
                ?>  von <?=$t->getPageCount()?> Ergebnissen </div>
            <?             $r->renderPager();         ?>
        </div>


    </div><!--msg_list-->
</div><!--center-block container_mid-->



