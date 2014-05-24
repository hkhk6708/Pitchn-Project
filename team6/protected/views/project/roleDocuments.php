<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>

<div id="roleSubHeader">
    <p class="rolepath"><span><?php echo Yii::app()->user->getState('projectTitle'); ?></p>
                    <?php Yii::app()->user->setState('projectTitle', ''); ?></span></p>
</div>
<div id="profileclear">
    
</div>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Role Documents', 'url' => array('roleDocuments', 'id'=>$id, 'roleId' => $roleId),  'active' => true),
        array('label' => 'Role Info', 'url' => array('onBoarding', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") == 'volunteer'),
        array('label' => 'Modify Role Info', 'url' => array('modifyOnBoarding', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") != 'volunteer'),
        array('label' => 'Role Tasks', 'url' => array('roleView', 'id' => $id, 'roleId' => $roleId)),
        array('label' => 'Role Contacts', 'url' => array('orgContacts', 'id'=>$id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") != 'volunteer'),
    ),
));
?>

<div>
    <h4>Upload New File</h4>

    <?php
/** @var TbActiveForm $form */
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'verticalForm',
        'htmlOptions' => array('class' => 'well',
                                'enctype' => 'multipart/form-data'), // for inset effect
    )
);


echo $form->fileFieldRow($model, 'filename');

$this->widget(
    'bootstrap.widgets.TbButton',
    array('buttonType' => 'submit', 'label' => 'Sumbit')
);
 
$this->endWidget();
unset($form);
?>
    
</div>

<div>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'file-grid',
	'dataProvider'=>$dataProvider,
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/table.css',
	//'filter'=>$dataProvider,
	'columns'=>array(
		//'id',
		//'projectId',
		//'roleId',
                'filename',
		//'path',
                array (
                    'header' => 'Download',
                    'type'=>'raw',
                    'value' => 'CHtml::link("Download" ,Yii::app()->createUrl("project/documentDownload",array("path"=>$data->path, "filename"=>$data->filename)))',
                ),
//		array(
//			'class'=>'CButtonColumn',
//		),
	),
)); ?>
</div>

<script>
$("#middleMenuLinkVolunteer").addClass("selectedMiddleMenuTab");
</script>


<script>
      $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>
