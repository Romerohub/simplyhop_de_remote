<div class="user_data_icons_2">
    <? if($u->raucher == 1){?>
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