<?php
/* @var $this AdminController */
/* @var $model CArrayDataProvider */

$this->breadcrumbs=array(
	'Admin'=>array('/admin'),
	'ViewAccountList',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'table',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model,
    'template' => "{items}\n{pager}",
    'htmlOptions' => array('style'=>'cursor: pointer;'),
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
        var url = "<?php echo Yii::app()->urlManager->createUrl('admin/viewAccount', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
</script>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
