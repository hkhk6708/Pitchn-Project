<?php
/* @var $this WorksForController */
/* @var $model WorksFor */

$this->breadcrumbs=array(
	'Works Fors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WorksFor', 'url'=>array('index')),
	array('label'=>'Create WorksFor', 'url'=>array('create')),
	array('label'=>'View WorksFor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WorksFor', 'url'=>array('admin')),
);
?>

<h1>Update WorksFor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>