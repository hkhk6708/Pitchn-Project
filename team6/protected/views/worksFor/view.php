<?php
/* @var $this WorksForController */
/* @var $model WorksFor */

$this->breadcrumbs=array(
	'Works Fors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WorksFor', 'url'=>array('index')),
	array('label'=>'Create WorksFor', 'url'=>array('create')),
	array('label'=>'Update WorksFor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WorksFor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WorksFor', 'url'=>array('admin')),
);
?>

<h1>View WorksFor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'organizationId',
	),
)); ?>
