<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>'Manage Task', 'url'=>array('admin')),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<script>
      $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>