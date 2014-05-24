<?php
/* @var $this UserimageController */

$this->breadcrumbs=array(
	'Userimage'=>array('/userimage'),
	'Upload',
);
?>

<div>

<?php

/** @var TbActiveForm $form */
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'inlineForm',
        'type' => 'inline',

        'htmlOptions' => array('class' => 'well',
                                'enctype' => 'multipart/form-data'),
    )
);
 
echo $form->fileFieldRow($model, 'filename');

$this->widget(
    'bootstrap.widgets.TbButton',
    array('buttonType' => 'submit', 'label' => 'Upload File')
);
 
$this->endWidget();
unset($form);

?>
</div>