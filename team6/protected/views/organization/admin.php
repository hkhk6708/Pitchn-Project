<?php
/* @var $this OrganizationController */
/* @var $model Organization */

$this->breadcrumbs=array(
	'Organizations'=>array('index'),
	'Manage',
);
?>

<?php


$this->menu=array(
	array('label'=>'List Organization', 'url'=>array('index')),
	array('label'=>'Create Organization', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#organization-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'organization-grid',
	'dataProvider'=>$model->search(),
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/table.css',

	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'causeId',
		'organizationName',
		'status',
		'website',
		'organizationDescription',
		
		'organizationPhone',
		//'contactDetails',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<div>
    <?php echo CHtml::link('Create New Organization',array('/organization/create')); ?>
</div>

<script>
      $("#middleMenuLinkAdmin1").addClass("selectedMiddleMenuTab");
</script>