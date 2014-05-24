<?php
/* @var $this AdminController */

$this->breadcrumbs = array(
    'Admin',
);


        
        ?>

<head>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainlayout.css" />  
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/popUp.css" />
</head>

<script type="text/javascript">
  /*  function invisble(){
        document.getElementById("arrow_box").style.display='none';
    } */
</script>


<!--<div id="arrow_box" onclick="invisble()">
    <div>Hi! Dear </div>
    <div>Tip:</div>
    <div>you can send messages Here  <?php //echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . "/images/email.png")) ?> </div>
</div>   -->

<div id='adminReport'>
    <?php 
        $this->widget(
            'chartjs.widgets.ChBars', 
            array(
                'width' => 750,
                'height' => 350,
                'htmlOptions' => array(),
                'labels' => array("Total Volunteers","Total Organizations","Volunteers w/ Projects","Volunteers w/o Projects","Active Volunteers","Active Organizations", "Total Projects"),
                'datasets' => array(
                    array(
                        "fillColor" => "#f14c49",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "data" => $SystemData,
                    )       
                ),
                'options' => array()
            )
        ); 
    ?>
</div>

    <h3 class="dash"> Organizations:</h3>
    <div id='organizationList'>
        
    <?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'table',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model,
    'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/table.css'),
    'cssFile' => Yii::app()->baseUrl . '/css/table.css',
    'htmlOptions' => array('style' => 'cursor: pointer;'),
    'selectionChanged' => 'clickedRow',
    'columns' => array(


        array('name' => 'organizationName', 'header' => 'Organization:'),
        array('name' => 'website', 'header' => 'Website'),
        array('name' => 'organizationPhone', 'header' => 'Phone'),
        array('name' => 'contactDetails', 'header' => 'Contact Details'),
)))

?>
</div>
    
    
    
<script type="text/javascript">
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('organization/view', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
</script>



<script>
      $("#topMenuLinkAdmin").addClass("selectedTopMenuTab");
</script>