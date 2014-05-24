<?php
/* @var $this DataImportController */

$this->breadcrumbs=array(
	'Data Import'=>array('/dataImport'),
	'Map',
);
?>

<div>
 
    <h3>Step 2: Map Column Names</h3>
<p>Use the following dropdown menus to select the column names which correspond to the label. If your dataset does not contain a column name which corresponds to any of the labels, leave it blank. The only required labels are NAME and EMAIL.</p>
</div>



<?php
/** @var TbActiveForm $form */
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'verticalForm',
        'htmlOptions' => array('class' => 'well',
                                'enctype' => 'multipart/form-data'), // for inset effect
    )
);

echo $form->dropDownListRow(
            $model2,
            'email',
            $model2->fileHeadersArray);

echo $form->dropDownListRow(
            $model2,
            'name',
            $model2->fileHeadersArray);

echo $form->dropDownListRow(
            $model2,
            'phone',
            $model2->fileHeadersArray);

echo $form->dropDownListRow(
            $model2,
            'workPhone',
            $model2->fileHeadersArray);

echo $form->dropDownListRow(
            $model2,
            'birthdate',
            $model2->fileHeadersArray);

echo $form->dropDownListRow(
            $model2,
            'locationCity',
            $model2->fileHeadersArray);

echo $form->dropDownListRow(
            $model2,
            'locationProvince',
            $model2->fileHeadersArray);

echo $form->dropDownListRow(
            $model2,
            'locationCountry',
            $model2->fileHeadersArray);

echo $form->dropDownListRow(
            $model2,
            'language',
            $model2->fileHeadersArray);

echo $form->dropDownListRow(
            $model2,
            'description',
            $model2->fileHeadersArray);


$this->widget(
    'bootstrap.widgets.TbButton',
    array('buttonType' => 'submit', 'label' => 'Sumbit')
);
 
$this->endWidget();
unset($form);


?>




