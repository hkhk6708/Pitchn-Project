<?php
/* @var $this CauseController */
/* @var $model Cause */

$this->breadcrumbs=array(
	'Causes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cause', 'url'=>array('index')),
	array('label'=>'Manage Cause', 'url'=>array('admin')),
);
?>

<h1>Create Cause</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>