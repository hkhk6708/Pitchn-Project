<?php
/* @var $this VolunteerNoteController */
/* @var $model VolunteerNote */

$this->breadcrumbs=array(
	'Volunteer Notes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List VolunteerNote', 'url'=>array('index')),
	array('label'=>'Create VolunteerNote', 'url'=>array('create')),
	array('label'=>'Update VolunteerNote', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete VolunteerNote', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VolunteerNote', 'url'=>array('admin')),
);
?>
<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
    'cssFile' => Yii::app()->baseUrl . '/css/table.css',
	'attributes'=>array(
		//'id',
		'volunteerEmail',
		'organizerEmail',
		//'organizationId',
		'dateTime',
		'content',
	),
)); ?>


        <div id="profilebuttonright">
            <?php
            
        $this->widget('bootstrap.widgets.TbButton', array(
    'label' => 'Back To Profile',
    'type' => 'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'normal', // null, 'large', 'small' or 'mini'
    'url' => $this->createUrl('person/view', array('id'=>$volId)),
    'visible' => Yii::app()->user->getState("type") != 'volunteer',
        //    'style'=> "margin-left: 85%;margin-right: 0;"
        ));
?>
        </div>


<script>
      $("#middleMenuLinkOrganizer").addClass("selectedMiddleMenuTab");
</script>