<?php
/* @var $this PersonAssignedToRoleController */
/* @var $model PersonAssignedToRole */

$this->breadcrumbs=array(
	'Person Assigned To Roles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PersonAssignedToRole', 'url'=>array('index')),
	array('label'=>'Manage PersonAssignedToRole', 'url'=>array('admin')),
);
?>

<h1>Create PersonAssignedToRole</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>