<?php
/* @var $this WorksForController */
/* @var $model WorksFor */

$this->breadcrumbs=array(
	'Works Fors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WorksFor', 'url'=>array('index')),
	array('label'=>'Manage WorksFor', 'url'=>array('admin')),
);
?>

<h1>Create WorksFor</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>