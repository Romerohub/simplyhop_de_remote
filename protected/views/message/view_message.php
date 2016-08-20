<div class="msg_item">
    <? $Mix_f = new Mix_f;?>
    <div class="img" style="<?=$Mix_f->show_user_pic($v->receiver_user_id,"view_small");?>"></div>
    <a class="img_40" href="/user/view?id=<?=$usr_id?>" style="<?=$Mix_f->show_user_pic($u->id,"view_small_40")?>"></a>

    <div class="devider_1"></div>
    <div class="text"><?=$v->text?></div>
    <div class="time"><?=date("H:i", $v->date_add)?></div>
</div>