<?php
/* @var $this ReviewsController */
/* @var $model Reviews */

$this->breadcrumbs=array(
	'Reviews'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Reviews', 'url'=>array('index')),
	array('label'=>'Manage Reviews', 'url'=>array('admin')),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>