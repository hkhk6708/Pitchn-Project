<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <?php foreach ($items as $i => $item): ?>
        <?php echo CHtml::activeTextField($item, "[$i]recipientEmail"); ?>
    <?php endforeach; ?>

    <div class="row">
        <?php echo CHtml::textArea('Content', 'Put your Content'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Save'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->