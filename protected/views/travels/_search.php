<?php
/* @var $this TravelsController */
/* @var $model Travels */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'travel_owner_id'); ?>
		<?php echo $form->textField($model,'travel_owner_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position_from_id'); ?>
		<?php echo $form->textField($model,'position_from_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position_from_name'); ?>
		<?php echo $form->textField($model,'position_from_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position_destination_id'); ?>
		<?php echo $form->textField($model,'position_destination_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position_destination_name'); ?>
		<?php echo $form->textField($model,'position_destination_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_add'); ?>
		<?php echo $form->textField($model,'date_add'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_edit'); ?>
		<?php echo $form->textField($model,'date_edit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descrition'); ?>
		<?php echo $form->textArea($model,'descrition',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'form_stadt'); ?>
		<?php echo $form->textField($model,'form_stadt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'form_start'); ?>
		<?php echo $form->textField($model,'form_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'form_ziel'); ?>
		<?php echo $form->textField($model,'form_ziel'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'form_automarke'); ?>
		<?php echo $form->textField($model,'form_automarke',array('size'=>60,'maxlength'=>244)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'form_sonstige_inweise'); ?>
		<?php echo $form->textArea($model,'form_sonstige_inweise',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'form_freie_platze'); ?>
		<?php echo $form->textField($model,'form_freie_platze'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'form_anzahl_von_gepack'); ?>
		<?php echo $form->textField($model,'form_anzahl_von_gepack'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'form_raucher'); ?>
		<?php echo $form->textField($model,'form_raucher'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->