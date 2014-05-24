<?php
/* @var $this DataImportController */

$this->breadcrumbs=array(
	'Data Import',
);
?>


<div>
    <h3> Step 1: Upload CSV File</h3>
    <p> Upload a .csv file which contains your dataset.</p>
    <p>Note: The first row of your file must contain the column names.</p>
    
</div>

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


