<?php
/* @var $this CauseController */
/* @var $model Cause */
/* @var $form CActiveForm */
?>

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cause-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

        <div class="row">
           
            <?php
                $this->widget('bootstrap.widgets.TBSelect2',array(
                    'asDropDownList' => false,
                    'name'=>"causes",
                        ));
            ?>
  
        </div>
        
        
	<div class="row">
		<?php echo $form->labelEx($model,'Other'); ?>
		<?php echo $form->textField($model,'other'); ?>
		<?php echo $form->error($model,'other'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
var causeSelect = $('#causes');
$(causeSelect).select2({
    //data:[
<?php

?>
    //],
    tags:[ <?php echo $model->getAttributeString('"', '",'); ?> ],
    multiple: true,
    width: "300px",
    placeholder: "Add Causes",
    tokenSeparators: [","],
    initSelection: function (element, callback) {
var data = [];
$(element.val().split(",")).each(function () {
    data.push({id: this, text: this});
});
callback(data);
}
});
                            
jQuery(function($) {
 
 
var causesLoad = [ <?php echo $model->getSelectedCauseString('"', '",'); ?> ]; 

if (causesLoad.length != 0) {
$('#causes').select2('val',causesLoad);
}
 
}); 
</script>