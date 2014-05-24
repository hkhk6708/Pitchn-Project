<?php
/* @var $this PCommentsController */
/* @var $model PComments */

$this->breadcrumbs=array(
	'Pcomments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PComments', 'url'=>array('index')),
	array('label'=>'Create PComments', 'url'=>array('create')),
	array('label'=>'View PComments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PComments', 'url'=>array('admin')),
);
?>

<h1>Update PComments <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>