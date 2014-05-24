<?php
/* @var $this TestPersonController */
/* @var $model TestPerson */

$this->breadcrumbs=array(
	'Test People'=>array('index'),
	$model->email,
);

$this->menu=array(
	array('label'=>'List TestPerson', 'url'=>array('index')),
	array('label'=>'Create TestPerson', 'url'=>array('create')),
	array('label'=>'Update TestPerson', 'url'=>array('update', 'id'=>$model->email)),
	array('label'=>'Delete TestPerson', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->email),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TestPerson', 'url'=>array('admin')),
);
?>

<h1>View TestPerson #<?php echo $model->email; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'email',
		'password',
	),
)); ?>
