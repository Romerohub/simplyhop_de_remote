<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
?>
<script>
    $(document).ready(function(){
        $(".nano").nanoScroller();

    })

</script>
<div class="center-block container_mid ">
    <div class="msg_title">
        <span class="title_img" style="  background: url('/css/img/icons_dev2.png') #017eba -4px -1127px;"></span>
        <div class="title">
            <div class="img" style="background: url(/upload/2/upic/thumb_100.jpg) no-repeat center top"></div>
            <div class="name">name</div>
            <div class="date_visit"><span></span>Donnerstag, den 30. Juni - 06:00 Uhr</div>
            <div class="rote_name">Hauptstraße 11, 30159 Hannover  ->     Mailand</div>

        </div>
    </div>
<div class="msg_block_main">
    <div class="msg_block nano">
        <div class="nano-content">
            <div class="msg_item">
                <div class="img" style="background: url(/upload/2/upic/thumb_100.jpg) no-repeat center top"></div>
                <div class="devider_1"></div>
                <div class="text">11111<br>333</div>
                <div class="time">11:11</div>
            </div>
            <div class="msg_item_me" >
                <div class="img"></div>
                <div class="devider_2"></div>
                <div class="time">11:11</div>
                <div class="text">22222</div>

            </div>
            <div class="msg_item">
                <div class="img" style="background: url(/upload/2/upic/thumb_100.jpg) no-repeat center top"></div>
                <div class="devider_1"></div>
                <div class="text">11111<br>333</div>
                <div class="time">11:11</div>
            </div>
        </div>
    </div>
</div><!--msg_block_main-->

    <div class="msg_send">
        <div class="textarea">
        <textarea></textarea>
            </div>
        <button></button>
    </div>


</div>


<? return false;?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sender_user_id'); ?>
		<?php echo $form->textField($model,'sender_user_id'); ?>
		<?php echo $form->error($model,'sender_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receiver_user_id'); ?>
		<?php echo $form->textField($model,'receiver_user_id'); ?>
		<?php echo $form->error($model,'receiver_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_add'); ?>
		<?php echo $form->textField($model,'date_add'); ?>
		<?php echo $form->error($model,'date_add'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->