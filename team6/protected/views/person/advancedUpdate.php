<?php

/* @var $this PersonController */
/* @var $model Person */

$this->breadcrumbs = array(
    'People' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'AdvancedUpdate',
);
?>

<?php

$this->renderPartial('_form_advanced', array(
    'model' => $model,
    'accountOrgList' => $accountOrgList,
    'allOrgList' => $allOrgList,
//    'worksFor' => $worksFor,
    ));
?>

<script>
      $("#middleMenuLinkAdmin").addClass("selectedMiddleMenuTab");
</script>