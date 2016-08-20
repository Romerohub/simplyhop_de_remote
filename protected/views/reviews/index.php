<?php
/* @var $this ReviewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reviews',
);

$this->menu=array(
	array('label'=>'Create Reviews', 'url'=>array('create')),
	array('label'=>'Manage Reviews', 'url'=>array('admin')),
);
?>

<div class="center-block container_mid">
<div class="pr_comments list_items">
    <div class="comment_view_title">
        <span class="title_img"></span>
        <div class="title"><? echo $dataProvider->getTotalItemCount();?>  Bewertungen</div>
    </div>
    <div class="pr_comments_list">
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
            'template'=>"{items} ",
        )); ?>


        <div style="clear:both"></div>
    </div><!--pr_comments_list-->

</div>

</div><!--center-block container_mid-->
