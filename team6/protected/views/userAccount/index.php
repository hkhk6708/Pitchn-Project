<?php
/* @var $this UserAccountController */

$this->breadcrumbs = array(
    'User Account',
);
?>

<html>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />
</html>



    <div id="profilebuttons">
         <div id ="profilebutton">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Change Password',
                'url' => array('userAccount/changePassword'),
                'htmlOptions' => array('class' => 'btn btn-danger'),
                    )
            );
            ?>
        </div>
        
      
         <div id ="profilebutton">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Change Picture',
                'url' => array('userimage/update'),
                'htmlOptions' => array('class' => 'btn btn-danger'),
                    )
            );
            ?>
        </div>
        
        <div id ="profilebutton">
                        <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Edit Profile',
                'url' => array('userAccount/editPersonalInfo'),
                'htmlOptions' => array('class' => 'btn btn-danger'),
                    )
            );
            ?>
          
        </div>
        <div id="profileclear"></div>
    </div>

<div id="divider"></div>

<div id="profilebody">

        <div id="profile" class="left">
            
                                 <div id="profilerow">
            <b>Skills:</b> 
            <?php
            $skillString = $skill->getSelectedSkillString('', ', ');
            echo ""
            . "$skillString";
            ?>
        </div>

          <div id="profilerow">
            <b>Phone:</b> 
            <?php echo "$model->phone"; ?>
        </div>

          <div id="profilerow">
            <b>Work Phone:</b> 
            <?php echo "$model->workPhone"; ?>
        </div>
         
            
                     <div id="profilerow">
            <b>Languages:</b> 
            <?php
            $stringArray = explode(",", $model->language);
            $languageString = implode(", ", $stringArray);
            echo "$languageString";
            ?>
        </div>
            
                <div id="profilerow">
            <b>City:</b> 
            <?php echo "$model->locationCity"; ?>
        </div>
            
            
          <div id="profilerow">
            <b>Province:</b> 
            <?php echo "$model->locationProvince"; ?>
        </div>


          <div id="profilerow">
            <b>Country:</b> 
            <?php echo "$model->locationCountry"; ?>
          </div>


        <div id="profilerow">
            <b>Causes:</b> 
            <?php
            $causeString = $cause->getSelectedCauseString('', ', ');
            echo "$causeString";
            ?>
        </div>
          <div id="profilerow">
            <b>Birthdate:</b> 
            <?php echo "$model->birthdate"; ?>
        </div>
            
            
        </div>
        
       <div id="profile" class="center">
              <div id="profilerow">
            <b>Additional Info:</b>
        </div>
                   <div class="profilerow">
                       <p><?php echo $model->description; ?></p>
                    </div>
        </div>
    
    <div id="profile" class="right">
        <div id="profilepic">
        <?php
        if ($userImage != NULL) {
                echo CHtml::image(Yii::app()->baseUrl . '/userImages/' . Yii::app()->user->getState('email') . "/" . $userImage->filename);
        } else {
                echo CHtml::image(Yii::app()->baseUrl . '/images/person_blank.png');
        }
      
        ?>
        </div>
        
    </div>
    
    
    <div id="profileclear"></div>
  
</div>

