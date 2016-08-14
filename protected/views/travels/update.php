<?php
/* @var $this TravelsController */
/* @var $model Travels */

$this->breadcrumbs=array(
	'Travels'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Travels', 'url'=>array('index')),
	array('label'=>'Create Travels', 'url'=>array('create')),
	array('label'=>'View Travels', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Travels', 'url'=>array('admin')),
);
?>

<h1>Update Travels <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>