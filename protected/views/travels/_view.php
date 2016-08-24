<?php
/* @var $this TravelsController */
/* @var $data Travels */
?>

<?

$tmp_data = $data;
if(!empty($data->user_request_id)){
    //print_r( $tmp_data);
    $tmp_data = $data;
    $data = $data->travelId;
}

//print_r($data);
//return false;
//echo $data->travel_owner_id;
if(!empty($tmp_data->user_request_id)){
    $u=User::model()->findByPk($tmp_data->user_request_id);
}else{
    $u=User::model()->findByPk($data->travel_owner_id);
}

//$u->attributes;
//print_R($u->id);
$Mix_f = new Mix_f;

?>

<div class="view" onclick=" return redirectTravel('/travels/view?id=<? echo $data->id; ?>', this, event)">
    <div class="user_data">
        <a class="img" href="/user/view?id=<? echo $u->id;?>" style="<?=$Mix_f->show_user_pic($u->id,"list_view")?>"></a>

        <a href="/user/view?id=<? echo $u->id; ?>"
           class="img_40" style="<?=$Mix_f->show_user_pic($u->id,"view_small_40")?>""></a>
        <div class="name">

            <a href="/user/view?id=<? echo $u->id;?>"><?=$u->vorname;?> <?//=$u->nachname;?></a>
            <div style="clear:both;"></div>
            <div class="age"><?=$Mix_f->show_age($u->geburtsdatum)?> </div>
        </div>
        <div class="data_33">
        <div class="user_data_icons">
            <? if($data->form_raucher == 1){?>
                <span class="smoking"></span>
            <?}else{?>
                <span class="not_smoking"></span>
            <?}?>
            <? if($u->haustiere == 1){?>
            <span class="dog"></span>
            <?}else{?>
                <span class="not_dog"></span>
            <?}?>
            <? if($u->musik == 1){?>
            <span class="musik"></span>
            <?}else{?>
                <span class="not_musik"></span>
            <?}?>
        </div>
        <div class="review">
            <? $Mix_f->count_review($u->id) ; ?>

        </div>
        </div><!--data_33-->
    </div>

    <div class="travel_data">

        <div class="data_10 time_10"><a href="/travels/view?id=<? echo $data->id; ?>"><?
              // сегодня - Heute
                // завтра - Morgen
                if($data->datum_start == date("d.m.Y")){
                    echo "Heute";
                }elseif($data->datum_start == date("d.m.Y",strtotime("+1 day"))){
                    echo "Morgen";
                }else{
                    $Mix_f-> show_date_week($data);
                }

                ?></a>
        </div>
        <div class="data_10">

            <?
            $active = "";
            if(
                empty($_GET["from"]) &&
                empty($_GET["to"])
                /*!isset($_GET['from'])
                && !isset($_GET['to'])
                && !isset($_GET['date'])
                && !isset($_GET['time'])*/
            ){ $active = "active ";}?>
            <?
            $tmp_from = "";
            if(!empty($_GET['from'])){ $tmp_from = $_GET['from']; }
            $tmp_to = "";
            if(!empty($_GET['to'])){ $tmp_to = $_GET['to']; }
            $is_started = false;
            ?>

            <span class="<?=$active?> <? if($tmp_from == $data->form_start){
                echo "active";
                $is_started  =true;
            }?>"><?=$data->form_start;?>  &#8594; </span>
            <? $Points=Points::model()->findAll('travel_id=:travel_id', array(':travel_id'=>$data->id));
            foreach($Points as $kkk=>$vvv){
                ?>
                <span class="<?=$active?> <?
                if($tmp_from == $vvv->name || $tmp_to == $vvv->name  ){
                    echo "active";
                    if($tmp_from == $vvv->name){ $is_started = true; }
                    if($tmp_to == $vvv->name){ $is_started = false; }
                } ?>"><?=$vvv->name?> &#8594;</span>
            <? } ?>
            <span class="<?=$active?>  <?=($tmp_to == $data->form_ziel)?"active":"";?>"> <?=$data->form_ziel;?></span>
        </div>
        <div class="data_12"><?=$data->form_start;?>, <?=$data->form_stadt;?>  </div>
        <div class="data_13"><?=$data->form_ziel;?>, <?=$data->form_stadt;?></div>

        <? if(!empty($u->form_automarke)){?>
        <div class="data_14"><span>Fahrzeug:</span> <? echo $u->form_automarke;//$data->form_automarke; ?></div>
        <?}?>
        <?if(!$my_list){?>
        <div class="data_15" style="">
            <?
            $res_places = $data->form_freie_platze;
            $tm_out =  $Mix_f->show_total($data, $res_places);
            $res_places = $tm_out['res_places'];
            ?>

            <?=$res_places?> Plätze frei


            <? if($data->travel_owner_id != Yii::app()->user->id && $res_places > 0){?>
                <a href="#send_request_<?=$data->id?>" class="view_send_request" data-lity>Mitfahren</a>
                <div id="send_request_<?=$data->id?>" style="background:#fff" class="lity-hide send_request">
                   <? $model = $data;?>
                <? include($_SERVER['DOCUMENT_ROOT']."/protected/views/parts/request_form.php")?>
                </div>
            <?}?>

        </div>

        <?}else{?>

           <? if(empty($tmp_data->user_request_id)){?>
                <?if(!$traveller){?>
                    <div class="data_16" style=""><a href="/travels/reviewslist?rout=<?=$data->id?>">Mitfahrer bewerten</a></div>
                <?}else{?>
                    <div class="data_16" style=""><a href="/reviews/create?ur=<?=$data->travel_owner_id?>">Fahrer bewerten</a></div>
                <?}?>
           <? }else{ ?>
                <div class="data_16" style=""><a href="/reviews/create?ur=<?=$tmp_data->user_request_id?>">Fahrer bewerten</a></div>
            <?}?>

        <?}?>

    </div>


</div>

<? return false;?>
<div class="view" >

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('travel_owner_id')); ?>:</b>
	<?php echo CHtml::encode($data->travel_owner_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position_from_id')); ?>:</b>
	<?php echo CHtml::encode($data->position_from_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position_from_name')); ?>:</b>
	<?php echo CHtml::encode($data->position_from_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position_destination_id')); ?>:</b>
	<?php echo CHtml::encode($data->position_destination_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position_destination_name')); ?>:</b>
	<?php echo CHtml::encode($data->position_destination_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_add')); ?>:</b>
	<?php echo CHtml::encode($data->date_add); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_edit')); ?>:</b>
	<?php echo CHtml::encode($data->date_edit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descrition')); ?>:</b>
	<?php echo CHtml::encode($data->descrition); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_stadt')); ?>:</b>
	<?php echo CHtml::encode($data->form_stadt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_start')); ?>:</b>
	<?php echo CHtml::encode($data->form_start); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_ziel')); ?>:</b>
	<?php echo CHtml::encode($data->form_ziel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_automarke')); ?>:</b>
	<?php echo CHtml::encode($data->form_automarke); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_sonstige_inweise')); ?>:</b>
	<?php echo CHtml::encode($data->form_sonstige_inweise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_freie_platze')); ?>:</b>
	<?php echo CHtml::encode($data->form_freie_platze); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_anzahl_von_gepack')); ?>:</b>
	<?php echo CHtml::encode($data->form_anzahl_von_gepack); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_raucher')); ?>:</b>
	<?php echo CHtml::encode($data->form_raucher); ?>
	<br />

	*/ ?>

</div>