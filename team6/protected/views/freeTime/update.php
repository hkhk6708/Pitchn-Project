<?php
/* @var $this FreeTimeController */
/* @var $model FreeTime */

$this->breadcrumbs=array(
	'Free Times'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FreeTime', 'url'=>array('index')),
	array('label'=>'Create FreeTime', 'url'=>array('create')),
	array('label'=>'View FreeTime', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FreeTime', 'url'=>array('admin')),
);
?>

<h1>Update FreeTime <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>