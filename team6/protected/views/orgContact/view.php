<?php
/* @var $this OrgContactController */
/* @var $model OrgContact */

$this->breadcrumbs=array(
	'Org Contacts'=>array('index'),
	$model->title,
);


?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                'name',
		'email',
		'title',
                'projectName',
                'roleName',
	),
)); ?>
