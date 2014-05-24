<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_formCreate', array('model'=>$model,'cause'=>$cause)); ?>

<script>
      $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>