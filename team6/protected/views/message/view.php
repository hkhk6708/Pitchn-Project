<?php

/* @var $this MessageController */
/* @var $model Message */
?>


<?php

$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id',
        //array('name'=>'email', 'label' => 'From'),		
        array('name' => 'senderName', 'label' => 'From'),
        array('name' => 'recipientEmail', 'value' => array($this, 'getRecipientName'), 'label' => 'Recieved by'),
        //'userType',
        'date',
        //'readmsg',
        //'content',
        array('name' => 'content', 'label' => 'Content', 'type' => 'raw'),
    ),
));
?>
