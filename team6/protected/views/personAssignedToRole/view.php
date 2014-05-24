<?php
/* @var $this PersonAssignedToRoleController */
/* @var $model PersonAssignedToRole */

$this->breadcrumbs=array(
	'Person Assigned To Roles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PersonAssignedToRole', 'url'=>array('index')),
	array('label'=>'Create PersonAssignedToRole', 'url'=>array('create')),
	array('label'=>'Update PersonAssignedToRole', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PersonAssignedToRole', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PersonAssignedToRole', 'url'=>array('admin')),
);
?>

<h1>View PersonAssignedToRole #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'roleId',
	),
)); ?>
