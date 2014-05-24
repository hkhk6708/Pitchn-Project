<?php
/* @var $this CalendarController */
/* @var $model FreeTime */

$this->breadcrumbs=array(
	'Calendar'=>array('index'),
	'Update',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>