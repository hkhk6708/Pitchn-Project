<?php
/* @var $this VolunteerController */

$this->breadcrumbs = array(
    'Volunteer',
);
?>
<h3>Hello! Volunteer</h3>
<h3>
    Your Current Organization:
    <?php
    $org = Organization::model()->findByPk(Yii::app()->user->getState('defaultOrgId'));
    echo $org->organizationName;
    ?>
</h3>

<h4>
    Choose one of the options below to change the current organziation.
</h4>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'table',
    'type' => 'striped bordered condensed',
    'dataProvider' => $dataProvider,
    'selectableRows' => 1,
    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
    'cssFile' => Yii::app()->baseUrl . '/css/table.css',
    'htmlOptions' => array('style' => 'cursor: pointer;'),
    'selectionChanged' => 'clickedRow',
    'columns' => array(
       // array('name' => 'id', 'header' => 'OrgID', 'type' => 'raw'),
        array('name' => 'organizationName', 'header' => 'Organization'),
    ),
));
?>

<script type="text/javascript">
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('volunteer/test', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
</script>
