<?php
/* @var $this CalendarController */
/* @var $model FreeTime */
/* @var $form CActiveForm */
?>

<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manage-event-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true),
)); ?>

    <div id="divider"></div>

    <div id="middleContent">
		<?php echo $form->labelEx($model,'recurring'); ?>
                <?php echo $form->radioButtonList($model, 'recurring', 
                        array(
                            'once'=>'None',
                            'daily'=>'Daily',
                            'weekly'=>'Weekly',
                            'monthly'=>'Monthly',
                            'yearly'=>'Yearly',
                               ),
                        array('onchange' => 'this.value',
                            'labelOptions'=>array('style'=>'display:inline'),
                            'separator'=>' ')); ?>
                <?php echo $form->error($model,'recurring'); ?>
    </div>
        
        <div id="divider"></div>

         <div id="middleContent">
        <div class="row">
		<?php echo $form->labelEx($model,'startDate'); ?>
                <?php echo $form->textfield($model, 'startDate'); ?>
                <?php echo $form->textfield($model, 'startTime'); ?>
		<?php echo $form->error($model,'startDate'); ?>
                <?php echo $form->error($model, 'startTime'); ?>
	</div>

        
        <div class="row">
		<?php echo $form->labelEx($model,'endDate'); ?>
                <?php echo $form->textfield($model, 'endDate'); ?>
                <?php echo $form->textfield($model, 'endTime'); ?>
		<?php echo $form->error($model,'endDate'); ?>
                <?php echo $form->error($model, 'endTime'); ?>
        </div>

        
    </div>

        
        
        <div id="divider"></div>
        
        <div id="bottomContent">
	<div id="contentButton">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-danger')); ?>
                <?php 
                if (!$model->isNewRecord) {
                    echo CHtml::submitButton('Delete', array(
                                                        'name' => 'Delete',
                                                        'class'=>'btn btn-danger',
                                                        )); 
                } ?>    
                    <?php /* echo CHtml::ajaxButton('Delete', 
                        Yii::app()->createAbsoluteUrl("Calendar/delete"), 
                        array(
                            'type' => 'POST',
                            'data' => 'js:{id:' . $model->id . '}',
                            'success' => 'js:function(data) {updateFlashMessage(data);}',
                            'error' => 'js:function() {alert(nay);}'),
                        array(
                                                    'name' => 'Delete',
                                                    'class'=>'button',
                                                    )); */?>
        </div>
        </div>



<?php $this->endWidget(); ?>

</div><!-- form -->
