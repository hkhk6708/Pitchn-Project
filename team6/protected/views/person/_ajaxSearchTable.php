<?php
/* @var $this PersonController */
/* @var $data CActiveRecordProvider */

$this->breadcrumbs=array(
	'Person'=>array('index'),
	'ajaxSearchTable',
);
?>

<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>

<?php

$addButtonVisibility = "hidden";
if (Yii::app()->user->getState("type") === 'administrator') {
    $addButtonVisibility = "visible";
}

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'searchTable',
    'dataProvider' => $data,
    'selectableRows' => 2,
    'cssFile' => Yii::app()->baseUrl . '/css/table.css',
    'template'=>"{pager}\n{items}\n{pager}",
    'columns' => array(
        array('name' => 'id', 'header' => '#', 'visible' => false),
        array('name' => 'name', 'header' => 'Name', 'footer' =>  
            '<a type="LinkButton" name="create" id="create" style=visibility:'.$addButtonVisibility.' data-toggle="tooltip" data-original-title="Add Account" class="btn btn-danger" href='.Yii::app()->urlManager->createUrl("person/create").'>
                          <i class="icon icon-plus icon-white"></i>
                          </a>'),
        array('name' => 'email', 'header' => 'Email'),
        array(
            'header' => "<div>Assigned Roles</div>".CHtml::dropDownList("projectSelectSearch", "", $organization->getAllProjectsListData(), array('prompt'=>'All Projects')),
            'name' => 'roles',
            'type' => 'raw',
            'value' => 'CHtml::hiddenField("assignRole".$data->id, -1, array("personid"=>$data->id))',
            'htmlOptions'=>array('width'=>'350px'),),
        array(
            'class' => 'zii.widgets.grid.CCheckBoxColumn',
            'id' => "checkBoxes",
            'footer' =>  '<button type="button" name="msg" id="msg" class="btn btn-danger" data-toggle="tooltip" data-original-title="Message Selected Accounts">
                          <i class="icon icon-envelope icon-white"></i>
                          </button>',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}',
            'viewButtonIcon'=>'icon icon-user icon-white',
            'buttons' => array(
                'view' => array(
                    'label' => 'View',
                    'options'=>array('class'=>'btn btn-danger'),
                    ),),
        ),
    ),
    'afterAjaxUpdate'=>'function(id, data){document.getElementById("projectSelectSearch").value = projectSelected; initializeRoleSelectors(new Array(projectSelected));}',
));
?>
