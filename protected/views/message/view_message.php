<div class="msg_item">
    <? $Mix_f = new Mix_f;?>
    <? //print_R($v);?>
    <a class="img"
       href="/user/view?id=<?=$v->sender_user_id?>"
       style="<?=$Mix_f->show_user_pic($v->sender_user_id,"view_small");?>"></a>
    <div class="small_info">
        <a class="img_40" href="/user/view?id=<?=$v->sender_user_id?>" style="<?=$Mix_f->show_user_pic($v->sender_user_id,"view_small_40")?>"></a>
        <div class="time_small"><?=date("H:i", $v->date_add)?></div>
    </div><!--small_info-->
    <div class="devider_1"></div>
    <div class="text"><?=$v->text?></div>
    <div class="time"><?=date("H:i", $v->date_add)?></div>
</div>