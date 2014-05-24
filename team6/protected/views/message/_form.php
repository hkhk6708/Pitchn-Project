<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
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
        <?php
           $this->widget('bootstrap.widgets.TbSelect2', array(
            'name' => 'recipients',
            'data' => $availableContacts,
            'htmlOptions' => array(
                'placeholder' => 'To:',
                'width' => "100px",
                'multiple' => 'multiple',
                'value' => "a",
            ),
                )
        );
        ?>
    </div>

    <div class="row">
        <?php echo $form->textArea($model, 'content', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>
    
    <div id="divider"></div>
    
    <div id="dialogBottom">
    <?php
            echo CHtml::ajaxButton('Send', Yii::app()->createAbsoluteUrl("Message/ajaxCreate"), 
                    array('type' => 'POST',
                          'success' => 'js:function(data) {updateMessageDialog(data);}',
                          'error' => 'js:function(xhr, status, error) {messageSubmitError(xhr, status, error);}'), 
                    array('name' => 'Send', 'class' => 'btn btn-danger', 'id' => 'send'.uniqid(),
            ));
     ?>
    
    <?php $this->endWidget(); ?>
    </div>

</div><!-- form -->

<script>
    function updateMessageDialog(data) {
        $('#flash').html(data).fadeIn().delay(2000).fadeOut();
        messageDialog.dialog("widget").animate({left: "+=20", opacity: 0}, {
            duration: "fast",
            complete: function() { messageDialog.dialog("close");}
        });
    }
    
    function messageSubmitError(xhr, status, error) {
        $("#flash").html(xhr.responseText).fadeIn().delay(2000).fadeOut();
        messageDialog.dialog("widget").animate({left: "+=10"},100).animate({left: "-=10"},100);
    }
    
    var preSelect = <?php echo $contactSelect ?>;
</script>