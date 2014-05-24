<?php
/* @var $this OrgContactController */
/* @var $model OrgContact */

$this->breadcrumbs=array(
	'Org Contacts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrgContact', 'url'=>array('index')),
	array('label'=>'Create OrgContact', 'url'=>array('create')),
	array('label'=>'View OrgContact', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage OrgContact', 'url'=>array('admin')),
);
?>

<h1>Update OrgContact <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>