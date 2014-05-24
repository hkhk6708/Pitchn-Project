<?php
/* @var $this PCommentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pcomments',
);

$this->menu=array(
	array('label'=>'Create PComments', 'url'=>array('create')),
	array('label'=>'Manage PComments', 'url'=>array('admin')),
);
?>

<h1>Pcomments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
