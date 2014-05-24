<?php
/* @var $this TestPersonController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Test People',
);

$this->menu=array(
	array('label'=>'Create TestPerson', 'url'=>array('create')),
	array('label'=>'Manage TestPerson', 'url'=>array('admin')),
);
?>

<h1>Test People</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
