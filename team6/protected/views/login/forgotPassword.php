<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->breadcrumbs = array(
    'ForgotPassword',
);
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" /> 
    </head>

    <h1> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_big.png"></h1>

    

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>



      
      <div id="real_center" >  
 <?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 
<?php echo $form->textFieldRow($model, 'email', array('class'=>'span3')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Reset Password')); ?>
 
<?php $this->endWidget(); ?>
      </div>

<?php $this->endWidget(); ?>
        



</html>


