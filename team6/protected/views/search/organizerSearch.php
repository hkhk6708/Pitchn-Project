<?php
/* @var $this SearchController */

$this->breadcrumbs=array(
	'Search'=>array('/search'),
	'organizerSearch',
);
?>
<h2>Search:</h2>

<div>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider,
        'columns' => array(
            'name',
            'userType',
            'locationCity',
            'locationProvince',
            'locationCountry',
            'registered',
            'status'
        ),
    ));
    ?>
</div>

