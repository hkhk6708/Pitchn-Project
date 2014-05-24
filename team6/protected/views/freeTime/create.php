<?php
/* @var $this FreeTimeController */
/* @var $model FreeTime */

$this->breadcrumbs=array(
	'Free Times'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FreeTime', 'url'=>array('index')),
	array('label'=>'Manage FreeTime', 'url'=>array('admin')),
);
?>

<h1>Create FreeTime</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>