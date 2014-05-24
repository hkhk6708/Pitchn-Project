<?php
/* @var $this PersonAssignedToRoleController */

$this->breadcrumbs=array(
	'PersonAssignedToRole'=>array('index'),
	'ajax',
);
?>

<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainlayout.css" />
</html>

<?php
$flashMessages = Yii::app()->user->getFlashes();
if ($flashMessages) {
    echo '<div id="flashMessage">';
    foreach($flashMessages as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>";
        continue;
    }
    echo '</div>';
}
?>