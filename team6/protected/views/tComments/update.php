<?php
/* @var $this TCommentsController */
/* @var $model TComments */

$this->breadcrumbs=array(
	'Tcomments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TComments', 'url'=>array('index')),
	array('label'=>'Create TComments', 'url'=>array('create')),
	array('label'=>'View TComments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TComments', 'url'=>array('admin')),
);
?>

<h1>Update TComments <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>