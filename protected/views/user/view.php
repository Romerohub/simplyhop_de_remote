<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);

$Mix_f = new Mix_f;

$u=User::model()->findByPk($model->id);
?>
<div class="container_dev">
    <div class="center-block container_mid">

         <div class="profile_view">
             <div class="profile_view_title">
                 <span class="title_img"></span>
                 <div class="title">Mein Profil</div>
             </div>
            <div class="pr_data">
                <a href="/user/view?id=<?=$u->id?>" class="img" style="<?=$Mix_f->show_user_pic($model->id, "160")?>"></a>
                <div class="data_20">
                    <div class="data_21"><a href="/user/view?id=<?=$u->id?>"><?=$u->vorname;?> <?=$u->nachname;?></a>

                    </div>
                    <? if(!empty($u->geburtsdatum)){?>
                    <div class="data_22"><?=$Mix_f->show_age($u->geburtsdatum)?> </div>
                    <?}?>
                    <? if(!empty($u->form_stadt)){?>
                    <div class="data_23"><?=$u->form_stadt?></div>
                    <?}?>

                    <div class="data_26">
                        <? include($_SERVER['DOCUMENT_ROOT']."/protected/views/parts/icons_2.php")?>

                    </div>

                    <div class="data_25">
                        <? $Mix_f->count_review($u->id, 2) ; ?>
                        </div>

                    <? if($u->id == Yii::app()->user->id){?>
                        <a style="" class="profile_edit_btn" href="/user/update?id=<?=$u->id?>">Profil bearbeiten</a>
                    <?}?>
                </div>
                <? if(!empty($u->form_uber_mich)){ ?>
                <div class="pr_text_title">Über mich</div>

                <div class="pr_text">
                    <?=$u->form_uber_mich?>
                </div>
                <?}?>

            </div>

         <div class="pr_comments">
             <div class="comment_view_title">
                 <span class="title_img"></span>
                 <div class="title"><?  echo $dataProviderReviews->getTotalItemCount();?>  Bewertungen</div>
             </div>
             <div class="pr_comments_list">
                 <?php $this->widget('zii.widgets.CListView', array(
                     'dataProvider'=>$dataProviderReviews,
                     'itemView'=>'application.views.reviews._view',
                     'template'=>"{items} ",
                 )); ?>
                 <div style="clear:both"></div>
             </div><!--pr_comments_list-->

         </div>

         </div>
        <div class="item_sidebar item_sidebar_screen">
            <div class="block_3">
                <?
                $data_auto = $model;
                include($_SERVER['DOCUMENT_ROOT']."/protected/views/parts/block_auto.php")?>

            </div>

        </div>


         <div class="profile_view_left">


             <div class="analitic_block">
                 <div class="analitic_view_title">
                     <span class="title_img"></span>
                     <div class="title">Aktivität</div>
                 </div>
             </div>
             <div class="data">
                 <div><?
                     $items=Travels::model()->findAll('travel_owner_id=:travel_owner_id', array(':travel_owner_id'=>$u->id));
                    $i = 0;
                     foreach($items as $kkk=>$vvv){
                        $i = $i+1;
                     }
                     echo $i;
                     ?> Fahrten angeboten
                 </div>
                 <div>
                     <?
                     $items=Request::model()->findAll('user_request_id=:user_request_id', array(':user_request_id'=>$u->id));
                     $i = 0;

                     foreach($items as $kkk=>$vvv){
                         $i = $i+1;
                     }
                     if($i == 1){
                         echo "1 Mitfahrt";
                     }else{
                         echo $i." Mitfahrten";
                     }
                     ?></div>
                 <div>Letzter Besuch: <?
                     if($u->last_visit == date("d.m.Y")){
                         echo "Heute";
                     }else{
                         echo $u->last_visit;
                     }
                     ?> - <?=$u->last_visit_time;?> Uhr</div>
                 <div>Angemeldet seit: <?
                    echo  date("d", $u->date_create);
                     ?> <?
                     $month_names = array(
                         1=>'Januar',	2=>'Februar',	3=>'Marz',	4=>'April',	5=>'Mai',	6=>'Juni',	7=>'Juli'	,
                         8=>'August',	9=>'September',	10=>'Oktober',	11=>'November', 12=>'Dezember'
                     );
                    echo $month_names[date("n",$u->date_create)] ?>  <?  echo  date("Y", $u->date_create);?></div>

             </div>
         </div>

    </div>

</div>

<?php /* $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'email',
		'profile',
	),
));*/ ?>
