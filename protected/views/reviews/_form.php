<?php
/* @var $this ReviewsController */
/* @var $model Reviews */
/* @var $form CActiveForm */
//print_R($data);
//echo 11;
?>
<div class="center-block container_mid">
<div class="form_message content_info add_form_info add_review_form">
    <span class="title_img"></span>
    <div class="title"> New  message</div>
    <div class="form add_form">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'reviews-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
        )); ?>
        <div class="form_line">
            <div class="form_label">

            </div>
        <?php echo $form->errorSummary($model); ?>
            </div>
        <?php $this->endWidget(); ?>
        <form autocomplete="off" action="" class="form_form" method="post" id="eventForm" onsubmit="return validate_form(this)">
            <input name="Reviews[user_vouter]" id="Reviews_user_vouter" value="<? echo Yii::app()->user->id?>" type="hidden">
            <input name="Reviews[user_receiver]" id="Reviews_user_vouter" value="<?=$_GET["ur"]?>" type="hidden">
<input type="hidden" name="t2" value="<?=((!empty($_GET['t2'])?$_GET['t2']:"0"))?>">
<input type="hidden" name="Reviews[id]" value="<?=$data["id"]?>">

            <div class="form_line">
                <div class="form_label">
                    Vote
                </div>
                <div class="form_input_1">
                    <table>
                        <tr>
                            <td><label for="n1">1</label></td>
                            <td><label for="n2">2</label></td>
                            <td><label for="n3">3</label></td>
                            <td><label for="n4">4</label></td>
                            <td><label for="n5">5</label></td>
                        </tr>
                        <tr>
                            <td><input id="n1" value="1"   <?=(($data["vote"]==1)?"checked":"")?> type="radio" name="Reviews[vote]"></td>
                            <td><input id="n2"  value="2"   <?=(($data["vote"]==2)?"checked":"")?>  type="radio" name="Reviews[vote]"></td>
                            <td><input id="n3"  value="3"   <?=(($data["vote"]==3)?"checked":"")?>  type="radio" name="Reviews[vote]"></td>
                            <td><input id="n4"  value="4"   <?=(($data["vote"]==4)?"checked":"")?>  type="radio" name="Reviews[vote]"></td>
                            <td><input id="n5" value="5" <?=((empty($data["vote"])?"checked":""))?> <?=(($data["vote"]==5)?"checked":"")?> type="radio" name="Reviews[vote]"></td>
                        </tr>

                    </table>

                </div>
            </div>

            <div class="form_line standart_textarea standart_textarea_2">
                <div class="form_label">
                   Message
                </div>
                <div class="form_input_1">
                    <textarea name="Reviews[text]"><?=$data['text']?></textarea>
                </div>
            </div>
<br>


            <div class="button_form">
                <button>Save</button>
            </div>
        </form>



    </div><!--form-->
</div>
</div><!--center-block container_mid-->



<? return false; ?>






















<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reviews-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_vouter'); ?>
		<?php echo $form->textField($model,'user_vouter'); ?>
		<?php echo $form->error($model,'user_vouter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_receiver'); ?>
		<?php echo $form->textField($model,'user_receiver'); ?>
		<?php echo $form->error($model,'user_receiver'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_add'); ?>
		<?php echo $form->textField($model,'date_add'); ?>
		<?php echo $form->error($model,'date_add'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote'); ?>
		<?php echo $form->textField($model,'vote'); ?>
		<?php echo $form->error($model,'vote'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->