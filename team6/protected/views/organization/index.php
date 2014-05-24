<?php
/* @var $this OrganizationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Organizations',
);

$this->menu=array(
	array('label'=>'Create Organization', 'url'=>array('create')),
	array('label'=>'Manage Organization', 'url'=>array('admin')),
);
?>


<h1> Organization List</h1>
<div>
    <?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'table',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model,
    'template' => "{items}\n{pager}",
    'htmlOptions' => array('style' => 'cursor: pointer;'),
    'selectionChanged' => 'clickedRow',
    'columns' => array(


        array('name' => 'organizationName', 'header' => 'Organization:'),
        array('name' => 'website', 'header' => 'website'),
        array('name' => 'organizationPhone', 'header' => 'Organization Phone #'),
        array('name' => 'contactDetails', 'header' => 'contactDetails'),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}',
            'buttons' => array(
                'view' => array(
                    'label' => 'View',
//                    Below is for the organization detail view
//                    'url' => 'Yii::app()->createUrl("message/view", array("id"=>$data->id))',
                    ),),
        ),
)))

?>
</div>
