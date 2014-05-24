<?php
/* @var $this MessageController */

$this->breadcrumbs=array(
	'Message'=>array('/message'),
	'SendMessage',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<h1><?php echo $int ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>



<div id='container'>
    <div id='row1'>
        <div id='to'></div>
        <div id='insideRow'></div>
    </div>
    <div id='row2'>
        <div id='subject'></div>
        <div id='insideRow2'></div>
    </div>
    <div id='row3'> 
        <div id='content'></div>
    </div>
    <div id='row3'>
        <div id='sned'></div>
    </div>
    
</div>
