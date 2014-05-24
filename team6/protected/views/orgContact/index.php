<?php
/* @var $this OrgContactController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Org Contacts',
);

$this->menu=array(
	array('label'=>'Create OrgContact', 'url'=>array('create')),
	array('label'=>'Manage OrgContact', 'url'=>array('admin')),
);
?>

<h1>Org Contacts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
