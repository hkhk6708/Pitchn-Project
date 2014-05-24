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
        array('label' => 'Role Documents', 'url' => array('roleDocuments', 'id' => $id, 'roleId' => $roleId)),
        array('label' => 'Role Info', 'url' => array('onBoarding', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") == 'volunteer'),
        array('label' => 'Modify Role Info', 'url' => array('modifyOnBoarding', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") != 'volunteer', 'active' => true),
        array('label' => 'Role Tasks', 'url' => array('roleView', 'id' => $id, 'roleId' => $roleId)),
        array('label' => 'Role Contacts', 'url' => array('orgContacts', 'id' => $id, 'roleId' => $roleId), 'visible' => Yii::app()->user->getState("type") != 'volunteer'),
    ),
));
?>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'message-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php echo $form->textArea($model, 'content', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>

    <div class="row buttons" >
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

<script>
      $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
</script>
