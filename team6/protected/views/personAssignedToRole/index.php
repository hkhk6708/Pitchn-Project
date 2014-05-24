<?php
/* @var $this PersonAssignedToRoleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Person Assigned To Roles',
);

$this->menu=array(
	array('label'=>'Create PersonAssignedToRole', 'url'=>array('create')),
	array('label'=>'Manage PersonAssignedToRole', 'url'=>array('admin')),
);
?>

<h1>Person Assigned To Roles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
