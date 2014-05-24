<?php
/* @var $this CauseController */
/* @var $model Cause */

$this->breadcrumbs=array(
	'Causes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cause', 'url'=>array('index')),
	array('label'=>'Create Cause', 'url'=>array('create')),
	array('label'=>'Update Cause', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cause', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cause', 'url'=>array('admin')),
);
?>

<h1>Causes Supported by <?php echo $this->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'animalWelfare',
		'artsAndCulture',
		'children',
		'communityAndService',
		'democracyAndPolitics',
		'education',
		'environment',
		'food',
		'health',
		'housingAndHomelessness',
		'humanRights',
		'humanitarianRelief',
		'internationalAffairs',
		'media',
		'povertyAlleviation',
		'religion',
		'scienceAndTechnology',
		'seniorCitizens',
		'womensIssues',
		'other',
	),
)); ?>
