<?php
/* @var $this TestPersonController */
/* @var $model TestPerson */

$this->breadcrumbs=array(
	'Test People'=>array('index'),
	$model->email=>array('view','id'=>$model->email),
	'Update',
);

$this->menu=array(
	array('label'=>'List TestPerson', 'url'=>array('index')),
	array('label'=>'Create TestPerson', 'url'=>array('create')),
	array('label'=>'View TestPerson', 'url'=>array('view', 'id'=>$model->email)),
	array('label'=>'Manage TestPerson', 'url'=>array('admin')),
);
?>

<h1>Update TestPerson <?php echo $model->email; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>