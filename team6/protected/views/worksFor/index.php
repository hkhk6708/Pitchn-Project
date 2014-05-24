<?php
/* @var $this WorksForController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Works Fors',
);

$this->menu=array(
	array('label'=>'Create WorksFor', 'url'=>array('create')),
	array('label'=>'Manage WorksFor', 'url'=>array('admin')),
);
?>

<h1>Works Fors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
