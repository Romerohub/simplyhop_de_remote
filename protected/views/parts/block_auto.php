
    <div class="my_profile">
        <span class="title_img"></span>
        <div class="title">Auto</div>
    </div>
    <div class="data">
               <span class="img"
                   <?

                   $Mix_f = new Mix_f;
                   $img_code = $Mix_f->show_user_pic($data_auto->id, "pr_auto_view");
                   ?>

                     style="<?=$img_code?>"
                   ></span>
        <div class="info">
            <?=$data_auto->form_automarke?>
            <br>
            <br>
            <? if(!empty($data_auto->farbe)){ ?>
                Farbe: <?=$data_auto->farbe?>
            <?}?>
        </div>

    </div>

