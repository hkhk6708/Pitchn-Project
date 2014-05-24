<?php

/* @var $this PersonController */
/* @var $model Person */

$this->breadcrumbs = array(
    'People' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
);
?>

<?php

$this->renderPartial('_form', array(
    'model' => $model,
    'skill' => $skill,
    'cause' => $cause));
?>

<script>
$("#middleMenuLinkAdmin").addClass("selectedMiddleMenuTab");
</script>

<script>
      $("#middleMenuLinkOrganizer").addClass("selectedMiddleMenuTab");
</script>
