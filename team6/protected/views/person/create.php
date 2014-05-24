<?php

/* @var $this PersonController */
/* @var $model Person */

$this->breadcrumbs = array(
    'People' => array('index'),
    'Create',
);
?>

<?php

$this->renderPartial('_form', array(
    'model' => $model,
    'skill' => $skill,
    'cause' => $cause,
    'worksFor' => $worksFor));
?>

<script>
$("#middleMenuLinkAdmin").addClass("selectedMiddleMenuTab");
</script>

<script>
      $("#middleMenuLinkOrganizer").addClass("selectedMiddleMenuTab");
</script>
