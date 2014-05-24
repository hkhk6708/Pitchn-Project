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

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'changePassword-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <?php if ((Yii::app()->user->getState("type") != 'administrator')) { ?>
    
    <div id='middleContent'>
    <?php echo $form->passwordFieldRow($model, 'oldPassword'); ?>
    <?php echo $form->passwordFieldRow($model, 'confirmOldPassword'); ?>
    </div>
    
    <div id="divider"></div>
    
    <?php } ?>
    
    <div id='middleContent'>
    <?php echo $form->passwordFieldRow($model, 'newPassword'); ?>
    <?php echo $form->passwordFieldRow($model, 'confirmNewPassword'); ?>
    </div>
    
    <div id="divider"></div>
    
    <div id="bottomContent">
        <div id="contentButton">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Submit', 'htmlOptions' => array('class' => 'button'),)); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

