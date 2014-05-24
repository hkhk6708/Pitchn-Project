<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <?php /*echo Yii::app()->bootstrap->register();*/ ?>

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainlayout.css" /> 
        
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>


    <body>



        <?php /*
         * 
         * TODO: identify the user then loads the correct admin/volunteer/organizer Layout
         * Default: load adminLayout
         * 
         */ ?>
        <div id="content">

            <?php
            $this->widget('bootstrap.widgets.TbAlert', array(
                'block' => true,
                'fade' => true,
                'closeText' => '&times;',
            ));
            ?>

            <?php
            $type = Yii::app()->user->getState("type")
            ?>

            <?php //echo $type ?>

            <?php if ($type == "volunteer") : ?>
                <?php $this->beginContent('//layouts/volunteerLayout'); ?>
                <?php echo $content; ?>
                <?php $this->endContent(); ?>

            <?php elseif ($type == "administrator") : ?>
                <?php $this->beginContent('//layouts/adminLayout'); ?>
                <?php echo $content; ?>
                <?php $this->endContent(); ?>

            <?php elseif ($type == "organizer") : ?>
                <?php $this->beginContent('//layouts/organizerLayout'); ?>
                <?php echo $content; ?>
                <?php $this->endContent(); ?>

            <?php else : ?>
                <?php echo $content; ?>

            <?php endif; ?>


            <?php /*
              <div id="mainmenu">
              <?php
              $this->widget('zii.widgets.CMenu', array(
              'items' => array(
              array('label' => 'Home', 'url' => array('/login/forgotPassword')),
              array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
              array('label' => 'Contact', 'url' => array('/site/contact')),
              array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
              array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
              ),
              ));
              ?>
              </div><!-- mainmenu -->

              <?php if (isset($this->breadcrumbs)): ?>
              <?php
              $this->widget('zii.widgets.CBreadcrumbs', array(
              'links' => $this->breadcrumbs,
              ));
              ?><!-- breadcrumbs -->
              <?php endif ?>
             * 
             */ ?>

        </div><!-- content -->

        <div id="footer">
            Copyright &copy; 2014 Pitch'n Solutions Inc.<br/>
            All Rights Reserved.<br/>
            Version: 1.01 <br/>
        </div><!-- footer -->


    </body>

</html>
