<?php
/* @var $this VolunteerNoteController */
/* @var $model VolunteerNote */

$this->breadcrumbs=array(
	'Volunteer Notes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List VolunteerNote', 'url'=>array('index')),
	array('label'=>'Create VolunteerNote', 'url'=>array('create')),
	array('label'=>'View VolunteerNote', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage VolunteerNote', 'url'=>array('admin')),
);
?>

<h1>Update VolunteerNote <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>