<?php
/* @var $this TravelsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Travels',
);

$this->menu=array(
	array('label'=>'Create Travels', 'url'=>array('create')),
	array('label'=>'Manage Travels', 'url'=>array('admin')),
);
$Mix_f = new Mix_f;

$rout = 0;
if(!empty($_GET['rout']) && (int)$_GET['rout']){
    $rout = (int)$_GET['rout'];
}

?>


<div class="center-block container_mid">
    <div class="list_items">
<?//=$traveller?>
        <?  if(!$rout){ ?>
        <div class="type_user_btn">
        <a class="<? if(!$traveller) echo "active";?>" href="/travels/driverlist">als Fahrer</a>
        <a class="<? if($traveller) echo "active";?>" href="/travels/travelerlist" >als Mitfahrer</a><!--как пассажир-->
        </div><!--type_user_btn -->
        <?}?>
        <div class="list_items_title">
            <span class="title_img" style="<?
            if($rout){
                echo "  background: url('/css/img/icons_dev2.png') #017eba -4px -1127px;";
            }else  if(!$traveller){
                echo "background: url('/css/img/icons_dev2.png') #017eba 5px -684px"; }else{

            } ?>" ></span>
            <div class="title">
                <? if($rout){
                    ?>Bewerten<?
                } else if(!$traveller){ ?>
                    Meine fahrten
            <?}else{?>Als mitfahrer<?}?>
            </div>
        </div>

        <div class="list_views">
        <?php
if(!$traveller){
    $str = "Fahrten";
}else{
    $str = "Mitfahrten";
}
        $r = $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'ajaxUpdate'=>false,
            'itemView'=>'_view',
           // 'template' => "<div>{summary}</div>{sorter}\n{items}\n{pager}",
            'summaryText'=>' <div class="mitfahrten">{count} '.$str.'  </div>',
            //'template'=>"{summary}{items} {pager}",
            'template'=>"{summary}{items} ",
            'pager' => array(
                'firstPageLabel'=>'<<',
                'prevPageLabel'=>'<',
                'nextPageLabel'=>'>',
                'lastPageLabel'=>'>>',
                'maxButtonCount'=>'10',
                'header'=>' ',
                'cssFile'=>false,
            ),
            'viewData'=>array("my_list"=>true, 'traveller'=>$traveller, "rout"=>$rout)
        ));
        ?>
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
        </div>
    </div><!--list_items-->
    <div class="item_sidebar">
        <div class="block_2 ">
            <? $u=User::model()->findByPk(Yii::app()->user->id); ?>
            <? include($_SERVER['DOCUMENT_ROOT']."/protected/views/parts/block_profile.php")?>
        </div>
    </div>
   <?/* <div class="profile_block">
        <div class="list_items_title">
            <span class="title_img"></span>
            <div class="title">Mein Profil</div>
        </div>


        <div class="p_data">

            <a href="?" class="img" style="background: url('<?=$Mix_f->show_user_pic($u->id)?>') no-repeat center center"></a>
            <div class="data_20">
                <div class="data_21"><a href="?"><?=Yii::app()->user->name;?></a></div>
                <div class="data_22">29 Jahre                    </div>
                <div class="data_23">ich Begleiter</div>
            </div>
            <div class="data_28">
                <div class="data_24">   Durchschnittl.</div>

Bewertung: <span>5.0 - 14 Bewertungen</span></div>
                <div class="data_26">  Meine Präferenzen:</div>
            </div>
        </div>


    </div>
*/?>
</div>




