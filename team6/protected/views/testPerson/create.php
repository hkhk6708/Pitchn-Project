<?php
/* @var $this TestPersonController */
/* @var $model TestPerson */

$this->breadcrumbs=array(
	'Test People'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TestPerson', 'url'=>array('index')),
	array('label'=>'Manage TestPerson', 'url'=>array('admin')),
);
?>

<h1>Create TestPerson</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>