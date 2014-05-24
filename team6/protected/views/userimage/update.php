<?php
/* @var $this UserimageController */

$this->breadcrumbs=array(
	'Userimage'=>array('/userimage'),
	'Update',
);
?>

<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>

 <div id="profilebuttons">
         <div id ="profilebutton">
            <?php
            if ($userImage != NULL) {
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Upload New Picture',
              //  'url' => array('userimage/upload'),
                'url' => Yii::app()->urlManager->createUrl('userimage/upload', array('id'=>$userImage->id)),
                'htmlOptions' => array('class' => 'btn btn-danger'),
                    )
            );
            } else {
                            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Upload New Picture',
              //  'url' => array('userimage/upload'),
                'url' => Yii::app()->urlManager->createUrl('userimage/upload'),
                'htmlOptions' => array('class' => 'btn btn-danger'),
                    )
            );
            }
            ?>
        </div>
 </div>
<div id="imagegallery">
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
 'id'=>'image-grid',
 'type' => 'condensed',
 'selectableRows' => 1,
 'dataProvider'=>$dataProvider,
 'selectionChanged' => 'clickedRow',
 'rowCssClassExpression'=>'(($data->current=="1")?"selected ":"") . ($row%2?"even":"odd")',
 'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
 'cssFile' => Yii::app()->baseUrl . '/css/table.css',
 //'filter'=>$model,
 'columns'=>array(
// -------------------------------//
   
array(
       'name'=>'', // 
        'type'=>'image',
        'value'=>'Yii::app()->request->baseUrl."/userImages/" . Yii::app()->user->email . "/" .$data->filename',
  'htmlOptions'=>array('width'=>'40%','height'=>'15%'),
        ),
'filename',
'date',
array(
   'class'=>'CButtonColumn',
    'template'=>'{delete}',
    'htmlOptions'=>array('width'=>'8%'),
    'buttons'=>array(
        'delete'=>array(
            'label'=>'Delete Image',
           'imageUrl'=>Yii::app()->request->baseUrl.'/images/redx.png',
        ),
    ),
  ),
 ),
));

?>
</div>


<script type="text/javascript">
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('userimage/select', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
</script>