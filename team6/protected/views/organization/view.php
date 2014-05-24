<?php
/* @var $this OrganizationController */
/* @var $model Organization */

$this->breadcrumbs=array(
	'Organizations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Organization', 'url'=>array('index')),
	array('label'=>'Create Organization', 'url'=>array('create')),
	array('label'=>'Update Organization', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Organization', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Organization', 'url'=>array('admin')),
);
?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'cssFile' => Yii::app()->baseUrl . '/css/table.css',
	'attributes'=>array(
		//'id',
		//'causeId',
		//'organizationName',
		'status',
		'website',
		'organizationDescription',
		'organizationPhone',
		'contactDetails',
                array('label'=>CHtml::link('Causes',array('/cause/update', 'id'=>$model->causeId, 'name'=>$model->organizationName)),
                    'type'=>'raw',
                    'value'=>$this->causeString
                    )
	),
)); ?>

<script>
      $("#middleMenuLinkAdmin1").addClass("selectedMiddleMenuTab");
</script>
