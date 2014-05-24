<?php
/* @var $this PCommentsController */
/* @var $model PComments */

$this->breadcrumbs=array(
	'Pcomments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PComments', 'url'=>array('index')),
	array('label'=>'Create PComments', 'url'=>array('create')),
	array('label'=>'Update PComments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PComments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PComments', 'url'=>array('admin')),
);
?>

<h1>View PComments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'projectId',
		'cdate',
		'email',
		'content',
	),
)); ?>
