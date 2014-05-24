<?php
/* @var $this VolunteerNoteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Volunteer Notes',
);

$this->menu=array(
	array('label'=>'Create VolunteerNote', 'url'=>array('create')),
	array('label'=>'Manage VolunteerNote', 'url'=>array('admin')),
);
?>

<h1>Volunteer Notes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
