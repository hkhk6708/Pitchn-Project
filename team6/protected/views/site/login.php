<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" /> 
    </head>

    <h1> <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_big.png"></h1>

    



<div class="form" >
           
 <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
?>

      
    <div id="center" >           
<img id="iamge1" src="<?php echo Yii::app()->request->baseUrl; ?>/images/Image1.png" >
<table>
<tr>
<th><?php echo $form->labelEx($model, 'Email: '); ?></th>
<th>   <?php echo $form->textField($model, 'username'); ?>
                    <?php echo $form->error($model, 'username'); ?></th>

</tr>
<tr>
<td><?php echo $form->labelEx($model, 'Password: '); ?></td>
<td><?php echo $form->passwordField($model, 'password'); ?>
    <?php echo $form->error($model, 'password'); ?></td>

<td>   <?php echo CHtml::submitButton('Login', array('size' => 'large',)); ?></td>
</tr>


</table>

<table id="table" >
    <tr><td id="fontColor"><?php echo CHtml::link('Forgot Password?',array('login/forgotPassword')); ?></td>
        <td id="fontColor"><a href="http://www.pitchn.ca">Register</a></td></tr>
</table>

</div> <!--center -->
<?php $this->endWidget(); ?>
            
            
            
        </div><!-- form -->
        
        
        



</html>