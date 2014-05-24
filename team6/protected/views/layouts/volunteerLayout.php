<?php ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainlayout.css" />  
    </head>
    
<?php
//Yii::app()->clientScript->registerCoreScript('jquery');
//Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>
    
<div id="main">
    <div id="header">
        
    <div id="logo">
       <?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . "/images/logo_big.png"),array('/volunteer/index')) ?>
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
                    'type' => null, // null or 'inverse'
                    'brand' => '',
                    'brandUrl' => '#',
                    'fixed' => null,
                    'collapse' => true, // requires bootstrap-responsive.css
                    'items' => array(
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
                                        array('label' => 'Change Current Organization', 'url' => array('/volunteer/viewOrganizationList')),
                                        '---',
                                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                                    )),
                            ),
                        ),
                    ),
                ));
                ?>
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
            <li><?php echo CHtml::link('Dashboard',array('volunteer/index'), array("id"=>"topMenuLinkVolunteer")); ?></li>    
            </div>
            <div id="middleMenuTab">
            <li><?php echo CHtml::link('Projects',array('/project/index'), array("id"=>"middleMenuLinkVolunteer")); ?></li>    
            </div>
            <div id="bottomMenuTab">
            <li><?php echo CHtml::link('Calendar',array('/calendar/index'), array("id"=>"bottomMenuLinkVolunteer")); ?></li>       
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
   $("#topMenuLinkVolunteer").click(function() {
      $("#topMenuLinkVolunteer").addClass("selectedTopMenuTab");
      $("#middleMenuLinkVolunteer").removeClass("selectedMiddleMenuTab");
      $("#bottomMenuLinkVolunteer").removeClass("selectedBottomMenuTab");
   });
   
   $("#middleMenuLinkVolunteer").click(function() {
      $("#middleMenuLinkVolunteer").addClass("selectedMiddleMenuTab");
      $("#topMenuLinkVolunteer").removeClass("selectedTopMenuTab");
      $("#bottomMenuLinkVolunteer").removeClass("selectedBottomMenuTab");
   });
   
   $("#bottomMenuLinkVolunteer").click(function() {
      $("#bottomMenuLinkVolunteer").addClass("selectedBottomMenuTab");
      $("#topMenuLinkVolunteer").removeClass("selectedTopMenuTab");
      $("#middleMenuLinkVolunteer").removeClass("selectedMiddleMenuTab");
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