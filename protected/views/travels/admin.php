<?php
/* @var $this TravelsController */
/* @var $model Travels */

$this->breadcrumbs=array(
	'Travels'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Travels', 'url'=>array('index')),
	array('label'=>'Create Travels', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#travels-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Travels</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'travels-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'travel_owner_id',
		'position_from_id',
		'position_from_name',
		'position_destination_id',
		'position_destination_name',
		/*
		'is_active',
		'date_add',
		'date_edit',
		'title',
		'descrition',
		'form_stadt',
		'form_start',
		'form_ziel',
		'form_automarke',
		'form_sonstige_inweise',
		'form_freie_platze',
		'form_anzahl_von_gepack',
		'form_raucher',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
