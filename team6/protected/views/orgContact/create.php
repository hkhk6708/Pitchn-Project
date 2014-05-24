<?php
/* @var $this OrgContactController */
/* @var $model OrgContact */

$this->breadcrumbs=array(
	'Org Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrgContact', 'url'=>array('index')),
	array('label'=>'Manage OrgContact', 'url'=>array('admin')),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<script>
      $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>
