<?php
/* @var $this CauseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Causes',
);

$this->menu=array(
	array('label'=>'Create Cause', 'url'=>array('create')),
	array('label'=>'Manage Cause', 'url'=>array('admin')),
);
?>

<h1>Causes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
