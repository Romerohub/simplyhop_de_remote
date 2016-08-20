<?php
/* @var $this TravelsController */
/* @var $model Travels */

$this->breadcrumbs=array(
	'Travels'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Travels', 'url'=>array('index')),
	array('label'=>'Create Travels', 'url'=>array('create')),
	array('label'=>'Update Travels', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Travels', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Travels', 'url'=>array('admin')),
);

$u=User::model()->findByPk($model->travel_owner_id);

//print_r($model->attributes);

//$model2=new Travels;
$model2=Travels::model()->findByPk($model->id);
$data2 = $model2->attributes;
//print_R($data2);
$data2["total_visits"] = $model2->total_visits+1;
$model2->attributes= $data2;
if($model2->save()){
}


$Mix_f = new Mix_f();
$u=User::model()->findByPk($model->travel_owner_id);
//print_r($u->attributes);
?>
<?php //echo $model->id; ?>




<div class="center-block container_mid">
    <div class="item_view">
        <div class="item_view_title">
            <span class="title_img"></span>
            <div class="title"><?=$model->form_start;?>   &#8594;
                <? $Points=Points::model()->findAll('travel_id=:travel_id', array(':travel_id'=>$model->id));
                foreach($Points as $kkk=>$vvv){ ?>
                    <?=$vvv->name?>  &#8594;
                <? } ?>

                <?=$model->form_ziel;?>

            <div style="display: none;">
                <input type="hidden" value="<?=$model->form_stadt;?>" id="t_city">
                <input type="hidden" value="<?=$model->form_start;?>" id="t_start">
                <input type="hidden" value="<?=$model->form_ziel;?>" id="t_end">
                <? $Points=Points::model()->findAll('travel_id=:travel_id', array(':travel_id'=>$model->id));
                foreach($Points as $kkk=>$vvv){ ?>
                   <input type="hidden" value="<?=$vvv->name?>" class="city_street_extra_list" id="">
                <? } ?>


            </div>

            <div class="rout" >
                <? $url = "saddr=".$model->form_start.",+".$model->form_stadt."&daddr=".$model->form_ziel.",+".$model->form_stadt.""; ?>
                <a  href="#inline_map"  data-lity>Route anzeigen</a>
                <script src="/css/js/view.js"></script>
                <div id="inline_map" style="" class="lity-hide">
                    <div id="map-canvas" style="width: 700px; height: 300px"></div>
                </div>

                <script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiEx2SiglfERkZch_N74J4lDCyu00pdh0&callback=initMap"></script>

            </div>
            </div>
        </div>




<div style="clear:both;"></div>

        <div class="v_data">
             <div class="data_31">
                 <div class="data_v_name">Abfahrtsort</div>
                 <div class="data_v_val"><span></span><?=$model->form_start;?>, <?=$model->form_stadt?></div>
             </div>
            <div class="data_32">
                <div class="data_v_name">Ankunftsort</div>
                <div class="data_v_val"><span></span> <?=$model->form_ziel;?>, <?=$model->form_stadt?></div>
            </div>
            <div class="data_33">
                <div class="data_v_name">Abfahrtsdatum</div>
                <div class="data_v_val"><span></span> <?=$model->datum_start;?> - <?=$model->datum_start_time;?> Uhr</div>
            </div>
            <div class="data_34">
                <div class="data_v_name">Details</div>
                <div class="data_v_val">
                   <div class="data_34_1" style=""> Pünktliche Abfahrt</div>
                   <div class="data_34_1" style="">
                       <?

                       $r = round(($model->estimate_time/60));

                       $tmp_res = "";
                       $tmp = explode(".", $model->datum_start_time);
                       $r = (int)$r+(int)$tmp[1];
                       if($r  > 59 ){
                           $tmp_res = date('h:i', strtotime($model->datum_start." ".$model->datum_start_time)+$model->estimate_time);
                       }else{
                          $tmp_res = $tmp[0].":".$r;
                       }
                       ?>
                       Ankunft: <?=$tmp_res?> Uhr  <? ?> </div>
                    <? if(!empty($model->form_umweg)){?>
                   <div class="data_34_2"><span></span>  Höchstens <?=$model->form_umweg?> Min. Umweg</div>
                    <? } ?>
                    <? if(!empty($model->form_max_2)){?>
                   <div class="data_34_3"><span></span>  Max. 2 auf der Rückbank</div>
                    <?}?>

                <div class="options_travel">
                    <div class="user_data_icons">
                        <? if($model->form_raucher == 1){?>
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

                </div>
                </div>


            </div>
            <div class="data_35 " style="display: none;"><div class="data_v_name">Optionen</div>
                <div class="data_v_val"></div>
            </div>
            <? if(!empty($model->form_sonstige_inweise)){?>
            <div class="data_text">
                <a href="/user/view?id=<? echo $u->id; ?>"
                   class="img" style="<?=$Mix_f->show_user_pic($u->id,"view_small")?>"></a>

                <div class="v_text">
                    <? //print_r($model->attributes);

                   // print_r($u->attributes);
                    ?>
                    <div class="v_title"><? echo $u->username; ?></div>
                    <?=$model->form_sonstige_inweise?>
                </div>
            </div>
            <? } ?>
        </div>
    </div>

    <div class="item_sidebar">
        <div class="block_1">
            <div class="v_head"> Fahrt veröffentlicht am: <?=date("d.m.Y", $model->date_add);?> - <?=$model->total_visits;?>x besucht</div>
            <div class="total_bagage">

                <?
                $res_places = $model->form_freie_platze;
                $res_gep  = $model->form_gepack;

                $tm_out =  $Mix_f->show_total($model, $res_places,$res_gep);

                $res_places = $tm_out['res_places'];
                $res_gep = $tm_out['gep'];
                ?>

                <div class="number"> <?=$res_gep;?></div>
                <div class="text_desc"> Gepäckstücke</div>
            </div>
            <div class="total_places">
                <div class="number"> <?=$res_places;?></div>
                <div class="text_desc">freie Plätze</div>
            </div>
            <div style="clear:both;"></div>




            <? if($model->travel_owner_id != Yii::app()->user->id && $res_places > 0){?>
                <div class="v_head_2">Hier klicken und Platz reservieren:</div>
                <div style="text-align: center;">
                <a href="/message/dialog?trvl_id=<?=$model->id?>&usr_id=<?=$model->travel_owner_id?>"  class="v_button" id="">Fahrer/in kontaktieren</a>
                <a href="#send_request"  data-lity class="v_button" id="">Mitfahren</a>
                </div>
            <?}else{?>
                <div style="height: 40px;"></div>
            <?}?>
        </div>
        <div id="send_request"  style="background:#fff" class="lity-hide send_request">
          <? include($_SERVER['DOCUMENT_ROOT']."/protected/views/parts/request_form.php")?>
        </div>

        <div class="block_2">
            <? include($_SERVER['DOCUMENT_ROOT']."/protected/views/parts/block_profile.php")?>
        </div>

        <div class="block_3">
        <?
        $data_auto = User::model()->findByPk($model->travel_owner_id);
        include($_SERVER['DOCUMENT_ROOT']."/protected/views/parts/block_auto.php")?>
        </div>
    </div>

    <div class="item_sidebar">
        <div class="my_profile_block">


        </div>
    </div>

    <div class="item_sidebar">
        <div class="my_profile_block">


        </div>
    </div>


        <?php /*$this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'travel_owner_id',
                'position_from_id',
                'position_from_name',
                'position_destination_id',
                'position_destination_name',
                'is_active',
                'date_add',
                'date_edit',
                'title',
                'descrition',
                'form_stadt',
                'form_start',
                'form_ziel',
                'form_automarke',
                'form_sonstige_inweise',
                'form_freie_platze',
                'form_anzahl_von_gepack',
                'form_raucher',
            ),
        )); */?>




</div>

