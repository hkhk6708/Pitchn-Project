<?php
/* @var $this PersonController */

$this->breadcrumbs = array(
    'People' => array('index'),
    'ChangePassword',
);
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

<script>
$("#middleMenuLinkAdmin").addClass("selectedMiddleMenuTab");
</script>