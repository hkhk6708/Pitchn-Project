<?php
/* @var $this TCommentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tcomments',
);

$this->menu=array(
	array('label'=>'Create TComments', 'url'=>array('create')),
	array('label'=>'Manage TComments', 'url'=>array('admin')),
);
?>

<h1>Tcomments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
