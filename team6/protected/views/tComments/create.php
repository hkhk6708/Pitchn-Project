<?php
/* @var $this TCommentsController */
/* @var $model TComments */

$this->breadcrumbs=array(
	'Tcomments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TComments', 'url'=>array('index')),
	array('label'=>'Manage TComments', 'url'=>array('admin')),
);
?>

<h1>Create TComments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>