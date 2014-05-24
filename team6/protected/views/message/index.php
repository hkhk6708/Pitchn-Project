<?php
/* @var $this MessageController */
?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'table',
    'type' => 'striped bordered condensed',
    'dataProvider' => $dataProvider,
    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
    'cssFile' => Yii::app()->baseUrl . '/css/table.css',
    'htmlOptions' => array('style' => 'cursor: pointer;'),
    'selectionChanged' => 'clickedRow',
    'columns' => array(
        //array('name' => 'id', 'header' => 'MessageID', 'type' => 'raw'),
        //array('name' => 'email', 'header' => 'Sender'),
        array('name' => 'recipientEmail', 'value'=>array($this,'getRecipientName'), 'header' => 'To:'),
        array('name' => 'content', 'header' => 'Content', 'type' => 'raw'),
        array('name' => 'date', 'header' => 'Date Recieved'),

    ),
));
?>

<script type="text/javascript">
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('message/view', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
</script>

