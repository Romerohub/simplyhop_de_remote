<div class="r_sended" style=" ">
     Anfrage verschickt.<br>
     Vielen Dank!
</div>
<? $request=Request::model()->findAll('travel_id=:travel_id', array(':travel_id'=>$model->id));
$freie = $model->form_freie_platze;
$gep = $model->form_gepack;
foreach($request as $kkk=>$vvv){
    $freie = $freie - $vvv->freie;
    $gep = $gep- $vvv->gep;
   } ?>
<form  autocomplete="off" class="form_form" method="post" onsubmit="return false;">
    <div class="title">
        Mitfahren
    </div>

    <input type="hidden" name="request_user_id" value="<?= Yii::app()->user->id?>">
    <input type="hidden" name="travel_id" value="<?=$model->id?>">
    <div class="form_line standart_celector_2">
        <div class="form_label">
            Anzahl der Plätze
        </div>
        <div class="form_input_1">
            <div class="input"><?=(($freie > 0 )?"1":"0")?></div>
            <ul class="search_ul">
                <? if($freie < 1){
                    ?><li >0</li><?
                }else{?>
                    <? for ($i = 1; $i <= $freie; $i++) { ?>
                    <li ><?=$i?></li>
                    <? } ?>
                <? } ?>

            </ul>
            <input type="hidden" class="" name="freie" value="1" id="" placeholder="">

        </div>
<div class="request_devider"></div>
        <div class="form_label form_label2">
            Gepäckstücke
        </div>
        <div class="form_input_2 form_input_2_2">
            <div class="input"><?=(($gep > 0 )?"1":"0")?></div>
            <ul class="search_ul">
                <? if($gep < 1){
                    ?><li >0</li><?
                }else{?>
                    <? for ($i = 1; $i <= $gep; $i++) { ?>
                        <li ><?=$i?></li>
                    <? } ?>
                <?}?>

            </ul>
            <input type="hidden" class="" name="gep" value="1" id="" placeholder="">
        </div>
        <div class="button_form">
            <button onclick="send_request(this)" >Anfrage senden</button>

        </div>
        <div style="clear: both;"></div>
    </div>

</form>