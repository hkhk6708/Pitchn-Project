<?php
/* @var $this OrganizationController */
/* @var $model Organization */

$this->breadcrumbs=array(
	'Organizations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Organization', 'url'=>array('index')),
	array('label'=>'Manage Organization', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model, 'cause'=>$cause)); ?>

<script>
      $("#middleMenuLinkAdmin1").addClass("selectedMiddleMenuTab");
</script>