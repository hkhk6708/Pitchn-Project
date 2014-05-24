<?php ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainlayout.css" />  
    </head>

<div id="main">
    <div id="header">
        
    <div id="logo">
        <?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . "/images/logo_big.png"),array('/organizer/index')) ?>
    </div>


    <div id="navigationBar"> 
      <?php 
                $newMessages = Message::model()->countByAttributes(
                array('recipientEmail' => Yii::app()->user->getState('email'),
                    'readmsg' => 'N',)
                );
                $messageImageUrl = CHtml::image(Yii::app()->request->baseUrl . "/images/message.png", "messageImage", array('class'=>'navbar-image', 'id' => 'messageImage'));
                if ($newMessages > 0) {
//                    if (Yii::app()->user->getState('messageUnreadAnimationSeen') === "true" && Yii::app()->user->getState('messageUnreadSeen') === "false") {
                          $messageImageUrl = CHtml::image(Yii::app()->request->baseUrl . "/images/messageNew.png", "messageImage", array('class'=>'navbar-image', 'id' => 'messageImage'));
//                    }
                } 
//                else {
//                    Yii::app()->user->setState('messageUnreadSeen', "true");
//                }
                $userImageUrl = CHtml::image(Yii::app()->request->baseUrl . "/images/user.png", "userImage", array('class'=>'navbar-image'));
                $listImageUrl = CHtml::image(Yii::app()->request->baseUrl . "/images/list.png", "listImage", array('class'=>'navbar-image'));
                
      $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>null, // null or 'inverse'
    'brand'=>'',
    'brandUrl'=>'#',
    'fixed'=>null,
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
       
        
         array(
                            'class' => 'bootstrap.widgets.TbMenu',
                            'encodeLabel'=>false,
                            'htmlOptions' => array('class' => 'pull-right'),
                            'items' => array(
                                array('label' => $messageImageUrl."<div class=messageUnreadNumber id=messageUnread></div>", 'url' => '#', 'items' => array(
                                        array('label' => 'Inbox', 'url' => array('/message/inbox')),
                                        array('label' => 'Sent Message', 'url' => array('/message/index')),)),
                                array('label' => $userImageUrl, 'url' =>  array('/userAccount/index')),
                                array('label' => $listImageUrl, 'url' => '#', 'items' => array(
                                        array('label'=>'Help: User Guide', 'url'=>array('/userDocs/index')),
                                        '---',
                                         array('label'=>'Create New Organizer Account', 'url'=>array('/person/create')),
                                        array('label'=>'Import Data', 'url'=>array('/dataImport/index')),
                                        '---',
                                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                                    )),
                            ),
                        ),
                   
)
      )) ?>
                             <div id="navbarcurrentorg">
                    <p class="navbar"><?php echo Yii::app()->user->getState('currentOrgName'); ?></p>
                   
                </div>
    </div>
        
    </div>
    
    <div id="contentAndMenu">

    <div id="leftside">  
        <div id="menubar">
        <div id="menu">
            <ul>
            <div id="topMenuTab">
            <li><?php echo CHtml::link('Dashboard',array('organizer/index'), array("id"=>"topMenuLinkOrganizer")); ?></li>
            </div>
            <div id="middleMenuTab">
            <li><?php echo CHtml::link('Volunteers',array('/person/search'), array("id"=>"middleMenuLinkOrganizer")); ?></li>
            </div>
            <div id="middleMenuTab">
            <li><?php echo CHtml::link('Projects',array('/project/index'), array("id"=>"middleMenuLinkOrganizer1")); ?></li>   
            </div>
            <div id="bottomMenuTab">
            <li><?php echo CHtml::link('Reports',array('organizer/viewreports'), array("id"=>"bottomMenuLinkOrganizer")); ?></li>        
            </div>      
            </ul>
       </div>
         
    </div>
    </div>
    <div id="rightside"> 
        <div id="contentHeader">
                    <p class="contentHeader"><?php echo Yii::app()->user->getState('contentTitle'); ?></p>
                    <?php Yii::app()->user->setState('contentTitle', ''); ?>
                </div>
        <?php echo $content; ?>
    </div>

</div>

</div>


</html>

<script>
   $("#topMenuLinkOrganizer").click(function() {
      $("#topMenuLinkOrganizer").addClass("selectedTopMenuTab");
      $("#bottomMenuLinkOrganizer").removeClass("selectedBottomMenuTab");
      $("#middleMenuLinkOrganizer").removeClass("selectedMiddleMenuTab");
      $("#middleMenuLinkOrganizer1").removeClass("selectedMiddleMenuTab");
   });
   
   $("#middleMenuLinkOrganizer").click(function() {
      $("#middleMenuLinkOrganizer").addClass("selectedMiddleMenuTab");
      $("#topMenuLinkOrganizer").removeClass("selectedTopMenuTab");
      $("#middleMenuLinkOrganizer1").removeClass("selectedMiddleMenuTab");
      $("#bottomMenuLinkOrganizer").removeClass("selectedBottomMenuTab");
   });
   
   $("#middleMenuLinkOrganizer1").click(function() {
      $("#middleMenuLinkOrganizer1").addClass("selectedMiddleMenuTab");
      $("#topMenuLinkOrganizer").removeClass("selectedTopMenuTab");
      $("#middleMenuLinkOrganizer").removeClass("selectedMiddleMenuTab");
      $("#bottomMenuLinkOrganizer").removeClass("selectedBottomMenuTab");
   });
   
   $("#bottomMenuLinkOrganizer").click(function() {
      $("#bottomMenuLinkOrganizer").addClass("selectedBottomMenuTab");
      $("#topMenuLinkOrganizer").removeClass("selectedTopMenuTab");
      $("#middleMenuLinkOrganizer").removeClass("selectedMiddleMenuTab");
      $("#middleMenuLinkOrganizer1").removeClass("selectedMiddleMenuTab");
   });
</script>

<script>
    $( document ).ready(function(){
        var newMessages = <?php echo $newMessages ?>;
        var messageUnreadAnimationSeen = <?php echo Yii::app()->user->getState('messageUnreadAnimationSeen') ?>;
    
        if (newMessages !== 0 && !messageUnreadAnimationSeen) {
            $("#messageImage").animate({opacity:0.3},{duration:"fast"}).animate({opacity:1},{duration:"fast"}).animate({opacity:0.3},{duration:"fast"}).animate({opacity:1},{duration:"fast"});
            $("#messageUnread").text("+" + newMessages);
            $("#messageUnread").animate({bottom: "+=30"},500).animate({opacity:1},{queue: false, duration: 500,
                complete: function() {  
                    $("#messageUnread").animate({bottom: "-=10"},500).animate({opacity:0},{queue: false, duration: 500});
                }
            });
            <?php echo Yii::app()->user->setState('messageUnreadAnimationSeen', "true"); ?>
        }
    });
</script>