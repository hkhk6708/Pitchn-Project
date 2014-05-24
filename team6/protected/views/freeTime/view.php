<?php
/* @var $this FreeTimeController */
/* @var $model FreeTime */

$this->breadcrumbs=array(
	'Free Times'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FreeTime', 'url'=>array('index')),
	array('label'=>'Create FreeTime', 'url'=>array('create')),
	array('label'=>'Update FreeTime', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FreeTime', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FreeTime', 'url'=>array('admin')),
);
?>

<h1>View FreeTime #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'startDate',
		'endDate',
		'startTime',
		'endTime',
		'recurring',
	),
)); ?>
