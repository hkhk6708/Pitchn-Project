<?php
/* @var $this PCommentsController */
/* @var $model PComments */

$this->breadcrumbs=array(
	'Pcomments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PComments', 'url'=>array('index')),
	array('label'=>'Manage PComments', 'url'=>array('admin')),
);
?>

<h1>Create PComments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>