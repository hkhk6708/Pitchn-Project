<?php
/* @var $this VolunteerNoteController */
/* @var $model VolunteerNote */

$this->breadcrumbs=array(
	'Volunteer Notes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VolunteerNote', 'url'=>array('index')),
	array('label'=>'Manage VolunteerNote', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>


<script>
      $("#middleMenuLinkAdmin").addClass("selectedMiddleMenuTab");
</script>

<script>
      $("#middleMenuLinkOrganizer").addClass("selectedMiddleMenuTab");
</script>