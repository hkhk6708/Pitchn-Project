<?php
/* @var $this CalendarController */
/* @var $model FreeTime */

$this->breadcrumbs=array(
	'Calendar'=>array('index'),
	'Create',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>