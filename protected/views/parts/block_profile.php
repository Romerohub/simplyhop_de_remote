<div>
    <div class="my_profile">
        <span class="title_img"></span>
        <div class="title">
            <? if(Yii::app()->user->id == $u->id){?>
            Mein Profil
            <?}else{?>
            <? if($u->geschlecht == 2){?>
                Fahrerin
            <?}else{?>
                Fahrer/in
        <?} ?>
        <?} ?>
        </div>
    </div>
    <div class="data_block_2">
        <a href="/user/view?id=<?=$u->id?>" class="img" style="<?=$Mix_f->show_user_pic($u->id,"list_view")?>"></a>
        <div class="data_20">
            <div class="data_21"><a href="/user/view?id=<?=$u->id?>"><?=$u->vorname?> <?=$u->nachname?></a></div>
            <div class="data_22"><?=$Mix_f->show_age($u->geburtsdatum);?>                  </div>
            <div class="data_23" style="display: none;"><?=$u->form_stadt?></div>
        </div>
        <div class="data_28">
            <div class="data_24">   </div>
            <div class="data_25">   
                <? $Mix_f->count_review($u->id, 2) ; ?>


            </div>
            <div class="data_26">

                <? include($_SERVER['DOCUMENT_ROOT']."/protected/views/parts/icons_2.php")?>
                <a href="/user/view?id=<?=$u->id?>" class="view_profile">Profil anzeigen</a>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>