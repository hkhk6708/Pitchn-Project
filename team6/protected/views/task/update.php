<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>'Create Task', 'url'=>array('create')),
	array('label'=>'View Task', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Task', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>


 <script>
      $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>