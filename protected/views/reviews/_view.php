<?php
/* @var $this ReviewsController */
/* @var $data Reviews */
?>

<?
$Mix_f = new Mix_f;
$img_code = $Mix_f->show_user_pic($data->user_vouter, "pr_edit");
//print_R($data);

$u=User::model()->findByPk($data->user_vouter);
?>
<div class="pr_comments_item">
    <a href="/user/view?id=<?=$data->user_vouter?>" class="img" style="<?=$img_code?>"></a>

    <div class="info">
        <div class="data_1">
            <a href="/user/view?id=<?=$data->user_vouter?>"><?=$u->vorname." ".$u->nachname?></a>
        </div>
        <? $Mix_f->show_stars($data->vote); ?>
        <div class="border"></div>
        <div class="data_2" ><? $data->date_add;
            $Mix_f-> show_date_week_stamp($data->date_add);
            ?>

            <!--Montag 11. Juli - 21:04 Uhr--></div>
        <div class="border"></div>
        <div class="data_3"><?=$data->text?></div>


    </div>
    <div style="clear:both;" class="bottom_devider"></div>
</div><!--pr_comments_item-->

<? return false;?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_vouter')); ?>:</b>
	<?php echo CHtml::encode($data->user_vouter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_receiver')); ?>:</b>
	<?php echo CHtml::encode($data->user_receiver); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_add')); ?>:</b>
	<?php echo CHtml::encode($data->date_add); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote')); ?>:</b>
	<?php echo CHtml::encode($data->vote); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />


</div>