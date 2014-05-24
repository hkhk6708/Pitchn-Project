<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked' => false, // whether this is a stacked menu
    'items' => array(
        array('label' => 'Main', 'url' => array('main', 'id' => $id)),
        array('label' => "Team", 'url' => array('team', 'id' => $id), 'visible' => Yii::app()->user->getState("type") == 'volunteer'),
        array('label' => 'Roles', 'url' => array('roles', 'id' => $id)),
        array('label' => 'Documents', 'url' => array('documents', 'id' => $id), 'active' => true),
        //array('label' => 'Onboarding', 'url' => array('onboarding','id'=>$id)),
        array('label' => 'Tasks', 'url' => array('tasks', 'id' => $id), 'visible' => Yii::app()->user->getState("type") == 'volunteer'),
    ),
));
?>

<div>
    <h4>Upload New File</h4>

<?php
/** @var TbActiveForm $form */
$form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array('class' => 'well',
        'enctype' => 'multipart/form-data'), // for inset effect
        )
);


echo $form->fileFieldRow($model, 'filename');

$this->widget(
        'bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Sumbit')
);

$this->endWidget();
unset($form);
?>

</div>

<div>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'file-grid',
        'dataProvider' => $dataProvider,
        'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
        'cssFile' => Yii::app()->baseUrl . '/css/table.css',
        //'filter'=>$dataProvider,
        'columns' => array(
            //'id',
            //'projectId',
            //'roleId',
            'filename',
            //'path',
            array(
                'header' => 'Download',
                'type' => 'raw',
                'value' => 'CHtml::link("Download" ,Yii::app()->createUrl("project/documentDownload",array("path"=>$data->path, "filename"=>$data->filename)))',
            ),
//		array(
//			'class'=>'CButtonColumn',
//		),
        ),
    ));
    ?>
</div>

<script>
    $("#middleMenuLinkVolunteer").addClass("selectedMiddleMenuTab");
</script>


<script>
    $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>
