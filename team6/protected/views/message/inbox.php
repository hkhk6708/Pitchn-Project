<?php
/* @var $this MessageController */
?>
<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dialogstyle.css" />
</html>
<html><link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/inbox.css" />  </html>
<h3>(unread:<?php echo $count ?> messages)</h3>

<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>

<div id='inboxMessage'>
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
            array('name' => 'readmsg', 'header' => "Read?"),
            //array('name' => 'id', 'header' => 'MessageID'),
            //array('name' => 'email', 'header' => 'From:'),
            array('name' => 'senderName', 'header' => 'From:'),
            //array('name' => 'recipientEmail', 'header' => 'Reciever'),
            array('name' => 'content', 'header' => 'Content', 'type' => 'raw'),
            array('name' => 'date', 'header' => 'Date Recieved'),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{delete}',
                'buttons' => array(
                    'delete' => array(
                        'label' => 'Delete',
                        'url' => 'Yii::app()->createUrl("message/delete", array("id"=>$data->id))',
                    ),
                ),
            ),
        ),
    ));
    ?>
</div>

<div id="messageDialogInbox"></div>

<script type="text/javascript">
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('message/view', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }

    var messageDialog = $("#messageDialogInbox").dialog();
    $("#messageDialogInbox").dialog("close");
    messageDialog.dialog("widget").css("opacity", "0");

    messageDialog.dialog("widget").bind('dialogclose', function(event) {
        messageDialog.dialog("widget").css("opacity", "0");
    });
</script>

<?php
echo CHtml::ajaxButton('Create', Yii::app()->createAbsoluteUrl("Message/ajaxCreate"), array('type' => 'GET',
    'data' => array('recipients' => array(null)),
    'success' => 'js:function(data) {'
    . '$("#messageDialogInbox").html(data);'
    . 'messageDialog = $("#messageDialogInbox").dialog({title: "Message", dialogClass:"dialogstyle", resizable: false,
                    width: 600, });'
    . 'messageDialog.dialog("widget").animate({opacity: 1}, {duration: "fast"});'
    . '}',
    'error' => 'js:function() {alert("Error Retrieving Data!");}',
    'dataType' => 'text'), array('name' => 'Create', 'class' => 'btn btn-danger',
));
?>
