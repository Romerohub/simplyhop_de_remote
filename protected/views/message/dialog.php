<script>
    $(document).ready(function(){
        $(".nano").nanoScroller(({ scroll: 'top' }));

    })

</script>
<?
$name = $user_trvaler->vorname;
//print_R($user_trvaler);
 $receiver_user = $driver->id;
//print_R($driver);
if(Yii::app()->user->id == $driver->id){
    $name = $user_trvaler->vorname;
   $receiver_user = $user_trvaler->id;
}else{

}
//echo $receiver_user;
 $driver;
		$travel;
	$user_trvaler;
$Mix_f = new Mix_f();
?>
<div class="center-block container_mid message_content ">
    <div class="msg_title">
        <span class="title_img" style="  background: url('/css/img/icons_dev2.png') #017eba -4px -1127px;"></span>
        <div class="title">
            <a class="img" style="<?=$Mix_f->show_user_pic($receiver_user,"view_small")?>" href="/user/view?id=<?=$receiver_user?>"></a>
            <div class="name"><a href="/user/view?id=<?=$receiver_user?>"><?=$name?></a></div>
            <div class="date_visit"><span></span><a href="/travels/view?id=<?=$travel->id?>"><? $Mix_f-> show_date_week($travel); ?></a></div>
            <div class="rote_name"><a href="/travels/view?id=<?=$travel->id?>"><?=$travel->form_start?>,  <?=$travel->form_stadt?> ->  <?=$travel->form_ziel?></a></div>

        </div>
    </div>
    <div class="msg_block_main">
        <div class="msg_block nano">
            <div class="nano-content" id="msgs_list">
               Empty list
         
            </div>
        </div>
    </div><!--msg_block_main-->

    <div class="msg_send">
        <form id="msg_form" >
            <input type="hidden" name="Message[sender_user_id]" value="<?=Yii::app()->user->id?>">
            <input type="hidden" name="Message[receiver_user_id]" value="<?=$receiver_user?>">
            <input type="hidden" name="Message[travel_id]" value="<?=$travel->id?>">
            <div class="textarea">
                <textarea name="Message[text]" ></textarea>
            </div>
            <button onclick="return send_message(this)"></button>
        </form>
    </div>
<script>
$(document).ready(function(){
    get_mmessages_list()
    setTimeout(function(){
        get_mmessages_list();

    }, 10000)

})
    function send_message(){
        $('textarea[name="Message[text]"]').removeClass("error");
        $('textarea[name="Message[text]"]').click(function(){
            $('textarea[name="Message[text]"]').removeClass("error");
        })
        var ajaxurl = "/message/create";
        var data = $('#msg_form').serialize();
        var t = $('textarea[name="Message[text]"]').val();
        console.log(t);
        if(t.length <= 1){
            $('textarea[name="Message[text]"]').addClass("error")
            return false;
        }


        $.post(
            ajaxurl,
            data,
            function(response){
                console.log(response);
                if(response == "ok"){
                    get_mmessages_list();
                    $('textarea[name="Message[text]"]').val("")
                }
                try{
                   // res = jQuery.parseJSON(response);
                    //console.log(res);
                }catch(err){

                }

            }
        ).fail(function() {
                alert("Error happend!")
            });;
        return false;
    }
    function get_mmessages_list(){
        var ajaxurl="/message/dialog";
        "?trvl_id=86&usr_id=2"
        var data = {"trvl_id":'<?=$_GET["trvl_id"]?>', "usr_id":'<?=$_GET["usr_id"]?>', 'ajax':'y'};
        $.get(
            ajaxurl,
            data,
            function(response){
                //onsole.log(response);
                $("#msgs_list").html(response).ready(function(){
                    //$(".nano").nanoScroller({ scroll: 'bottom' });
                    //alert(2)
                    $("#msgs_list").scrollTop($("#msgs_list")[0].scrollHeight);
                    $(".message .new_messages").hide()
                });

            }
        );

    }
</script>

</div>