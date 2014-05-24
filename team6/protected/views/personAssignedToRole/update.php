<?php
/* @var $this PersonAssignedToRoleController */
/* @var $model PersonAssignedToRole */

$this->breadcrumbs=array(
	'Person Assigned To Roles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PersonAssignedToRole', 'url'=>array('index')),
	array('label'=>'Create PersonAssignedToRole', 'url'=>array('create')),
	array('label'=>'View PersonAssignedToRole', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PersonAssignedToRole', 'url'=>array('admin')),
);
?>

<h1>Update PersonAssignedToRole <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>