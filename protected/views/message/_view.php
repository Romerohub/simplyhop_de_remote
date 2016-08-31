<?php
/* @var $this MessageController */
/* @var $data Message */
?>
<?
$usr_id = 0;
if( Yii::app()->user->id == $data->sender_user_id){
    $usr_id = $data->receiver_user_id;
}else if(Yii::app()->user->id == $data->receiver_user_id){
    $usr_id = $data->sender_user_id;
}else{
    return false;
}
$data->sender_user_id;
$data->receiver_user_id;

$u=User::model()->findByPk($usr_id);
if(empty($u->id)){
    return false;
}
$travel=Travels::model()->findByPk($data->travel_id);
$Mix_f = new Mix_f;


$message=Message::model()->find(
    array("condition" => 'sender_user_id=:sender_user_id
    AND receiver_user_id=:receiver_user_id
    AND travel_id=:travel_id  ',"order" => "id DESC"
    ,

    'params' =>array(':travel_id'=>$data->travel_id,
        ":sender_user_id"=>$usr_id,
        ":receiver_user_id"=>Yii::app()->user->id
    ))
);

$message_text = $data->text;
$message_date = $data->date_add;
$viewed = $data->viewed;
if(!empty($message->text)){
    $message_text =  $message->text."";
    $message_date = $message->date_add;
    $viewed = $message->viewed;
}

?>
<div class="msg_list_item <?=(($viewed<=0)?"active":"")?>">
    <div class="user_info">
        <a class="img" href="/user/view?id=<?=$usr_id?>" style="<?=$Mix_f->show_user_pic($u->id,"list_view")?>"></a>
        <a class="img_40" href="/user/view?id=<?=$usr_id?>" style="<?=$Mix_f->show_user_pic($u->id,"view_small_40")?>"></a>
        <div class="data_1">
            <div class="data_1_1"><a href="/user/view?id=<?=$usr_id?>"><?=$u->vorname;?></a> </div>
            <div class="data_1_2"><?=$Mix_f->show_age($u->geburtsdatum)?></div>
        </div>
        <div class="data_2"> <? $Mix_f->count_review($u->id) ; ?></div>
    </div>
    <div class="msg_info">
        <div class="data_3"><span></span><a href="/travels/view?id=<?=$travel->id?>"><? $Mix_f-> show_date_week($travel); ?></a></div>
        <div class="data_4"><span><?=date("d.m.Y", $message_date)?> um <?=date("H:i", $message_date)?></span>
            <a href="/travels/view?id=<?=$travel->id?>"><span class="data_4_1"><?=$travel->form_start?>, <?=$travel->form_stadt?>&#8594; <?=$travel->form_ziel?></span></a></div>
        <div class="data_5"> <?=$message_text?></div>
        <div class="data_6"> <a href="/message/dialog?trvl_id=<?=$data->travel_id?>&usr_id=<?=$usr_id?>">Antworten</a></div>
    </div>

</div><!--msg_list_item-->

<? return false; ?>
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sender_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->sender_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receiver_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->receiver_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_add')); ?>:</b>
	<?php echo CHtml::encode($data->date_add); ?>
	<br />


</div>