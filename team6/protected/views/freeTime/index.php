<?php
/* @var $this FreeTimeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Free Times',
);

$this->menu=array(
	array('label'=>'Create FreeTime', 'url'=>array('create')),
	array('label'=>'Manage FreeTime', 'url'=>array('admin')),
);
?>

<h1>Free Times</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
