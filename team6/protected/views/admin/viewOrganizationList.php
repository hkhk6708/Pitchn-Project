<?php
/* @var $this AdminController */
/* @var $model CArrayDataProvider */

$this->breadcrumbs = array(
    'Admin' => array('/admin'),
    'ViewOrganizationList',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'table',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model,
    'template' => "{items}\n{pager}",
    'htmlOptions' => array('style' => 'cursor: pointer;'),
    'selectionChanged' => 'clickedRow',
    'columns' => array(
//        array('name' => 'id', 'header' => '#', 'visible' => false),
//        array('name' => 'organizationName', 'header' => 'Name'),
//        array('name' => 'organizationName', 'header' => 'Name'),
//        array('name' => '', 'header' => 'Selected', 'type' => 'raw', 'value' => "CHtml::radioButton('',false)"),
//    ),

        array('name' => 'organizationName', 'header' => 'Organization:'),
        array('name' => 'website', 'header' => 'website'),
        array('name' => 'organizationPhone', 'header' => 'Organization Phone #'),
        array('name' => 'contactDetails', 'header' => 'contactDetails'),
        array('name' => '', 'header' => 'Selected', 'type' => 'raw', 'value' => "CHtml::radioButton('',false)"),
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

<script type="text/javascript">
    function clickedRow(id) {
        var url = "<?php echo Yii::app()->urlManager->createUrl('admin/viewOrganization', array('id' => '')) ?>";
        var rid = $.fn.yiiGridView.getSelection(id);
        window.location.assign(url + rid);
    }
</script>

<p>
    (Reuters) - The U.S. military said on Wednesday it will bolster training with Poland's air force and provide more U.S. aircraft to a NATO air policing mission in the Baltics, as it eyes ways to reassure allies without escalating the Ukraine crisis.

    The United States has showed no interest in pursuing military options following the Russian intervention in Crimea. The biggest step the Pentagon had taken so far was to cut off military exchanges with Russia on Monday.

    General Martin Dempsey, the chairman of the Joint Chiefs of Staff, told a Senate hearing he had directed the U.S. military's European Command to "consult and plan within the construct of the North Atlantic Council" but stressed the intent was to stabilize the situation.

    "Obviously we want to provide NATO's leaders with options that stabilize and not escalate tensions in the Ukraine," Dempsey said.

    Dempsey said he spoke with his Russian counterpart on Wednesday and urged restraint in the days ahead "in order to preserve room for a diplomatic solution."

    Russia and the West are locked in the most serious battle since the end of the Cold War for influence in Ukraine, a former Soviet republic with historic ties to Moscow that is a major commodities exporter and strategic link between East and West.

    Ukraine says Russia has occupied Crimea, where its Black Sea fleet is based, provoking an international outcry and sharp falls in financial markets on Monday, though they have since stabilized.

    Defense Secretary Chuck Hagel, who aimed to speak with Ukraine's defense minister later on Wednesday, said the United States would boost training with Poland's air force. A U.S. defense official said there are about 10 U.S. Air Force personnel in Poland to support rotations of U.S. aircraft, including F-16 fighter jets, for training.

    It was still unclear how the United States would boost training but one option would be to provide additional aircraft, the U.S. official said.

    Hagel also said the United States would step up its participation in NATO's 10-year-old air policing mission in skies over the Baltic states of Estonia, Latvia and Lithuania.

    The duties rotate among NATO members and the United States took over air policing duties from Belgium in January, providing four F-15 aircraft through May, which are on call to help respond to any violations of Baltic airspace.

    The U.S. defense official said the Pentagon, in a response to a request from Baltic allies, aimed to provide additional aircraft during the current rotation.

    "Across the administration, our efforts ... (are) focused on de-escalating crisis, supporting the new Ukrainian government with economic assistance and reaffirming our commitments to allies in Central and Eastern Europe," Hagel said.
<tt><?php echo __FILE__; ?></tt>.
</p>
