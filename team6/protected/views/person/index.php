<?php
/* @var $this PersonController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'People',
);
?>
<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>

<div id="contentBox">
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'table',
        'type' => 'striped bordered condensed',
        'dataProvider' => $dataProvider,
        'template' => "{items}\n{pager}",
        'htmlOptions' => array('style' => 'cursor: pointer;'),
        'selectionChanged' => 'clickedRow',
        'columns' => array(
            array('name' => 'id', 'header' => '#', 'visible' => false),
            array('name' => 'email', 'header' => 'Username'),
            array('name' => 'name', 'header' => 'Name'),
        ),
    ));
    ?>

    <script type="text/javascript">
        function clickedRow(id) {
            var url = "<?php echo Yii::app()->urlManager->createUrl('person/view', array('id' => '')) ?>";
            var rid = $.fn.yiiGridView.getSelection(id);
            window.location.assign(url + rid);
        }
    </script>

</div>

<div id="contentButton">
    <footer>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Create',
            'url' => Yii::app()->urlManager->createUrl('person/create'),
            'htmlOptions' => array('class' => 'btn btn-danger'),
                )
        );
        ?>
    </footer>
</div>

