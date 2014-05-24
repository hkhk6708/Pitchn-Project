<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkillTest
 *
 * @author Lenox
 */
class SkillTest extends CDbTestCase{
    
    public function testGetSelectedSkillStringOptions()
    {
        // insert a comment in pending status
            $skill = new Skill();
            $skill->accounting = 1;
            $skill->branding = 1;
            $skillString = $skill->getSelectedSkillString("", ",");

            $this->assertEquals($skillString,"Accounting,Branding");
            
            $skill->accounting = 0;
            $skillString = $skill->getSelectedSkillString("", ",");

            $this->assertEquals($skillString,"Branding");
            
            $skill->accounting = 1;
            $skill->education = 1;
            $skill->photography = 1;
            $skillString = $skill->getSelectedSkillString("", ",");

            $this->assertEquals($skillString,"Accounting,Branding,Education,Photography");
    }
    
    public function testGetSelectedSkillStringOther() {
            $skill = new Skill();
            $skill->other = "c++,perl,ruby";
            $skillString = $skill->getSelectedSkillString("", ",");

            $this->assertEquals($skillString,"c++,perl,ruby");
    }
    
    public function testGetSelectedSkillStringOtherWithOptions() {
            $skill = new Skill();
            $skill->other = "c++,perl,ruby";
            $skill->photography = 1;
            $skillString = $skill->getSelectedSkillString("", ",");
            
            $this->assertEquals($skillString,"Photography,c++,perl,ruby");
    }
    
    public function testGetAttributeString() {
            $skill = new Skill();
            $skillString = $skill->getAttributeString("'", "',");
           
            $this->assertEquals($skillString,""
                    . "'Accounting',"
                    . "'Advertising',"
                    . "'Branding',"
                    . "'Business Strategy',"
                    . "'Communications',"
                    . "'Copywriting',"
                    . "'Design',"
                    . "'Education',"
                    . "'Entrepreneurship',"
                    . "'Event Planning',"
                    . "'Finance',"
                    . "'Fundraising',"
                    . "'Human Resources',"
                    . "'Legal',"
                    . "'Marketing',"
                    . "'Multimedia',"
                    . "'Online Marketing',"
                    . "'Photography',"
                    . "'Project Management',"
                    . "'Public Relations',"
                    . "'Sales',"
                    . "'Social Media',"
                    . "'Technology',"
                    . "'Web Development',");
    }
    
    public function testGetAttributeStringSeparators() {
            $skill = new Skill();
            $skillString = $skill->getAttributeString(":", ":");
           
            $this->assertEquals($skillString,""
                    . ":Accounting:"
                    . ":Advertising:"
                    . ":Branding:"
                    . ":Business Strategy:"
                    . ":Communications:"
                    . ":Copywriting:"
                    . ":Design:"
                    . ":Education:"
                    . ":Entrepreneurship:"
                    . ":Event Planning:"
                    . ":Finance:"
                    . ":Fundraising:"
                    . ":Human Resources:"
                    . ":Legal:"
                    . ":Marketing:"
                    . ":Multimedia:"
                    . ":Online Marketing:"
                    . ":Photography:"
                    . ":Project Management:"
                    . ":Public Relations:"
                    . ":Sales:"
                    . ":Social Media:"
                    . ":Technology:"
                    . ":Web Development:");
    }
    
    public function testSetSkillString() {
        
        $skill = new Skill();
        $skill->setSkillString("Accounting,Branding,Education,Photography,Technology", 0);
        
        $createdSkillId = $skill->id;
        $createdSkill = Skill::model()->findByPk($createdSkillId);
        
        $this->assertNotEquals($createdSkill, null);
        
        $this->assertEquals($createdSkill->accounting, 1);
        $this->assertEquals($createdSkill->advertising, 0);
        $this->assertEquals($createdSkill->branding, 1);
        $this->assertEquals($createdSkill->businessStrategy, 0);
        $this->assertEquals($createdSkill->communications, 0);
        $this->assertEquals($createdSkill->copywriting, 0);
        $this->assertEquals($createdSkill->design, 0);
        $this->assertEquals($createdSkill->education, 1);
        $this->assertEquals($createdSkill->entrepreneurship, 0);
        $this->assertEquals($createdSkill->eventPlanning, 0);
        $this->assertEquals($createdSkill->finance, 0);
        $this->assertEquals($createdSkill->fundraising, 0);
        $this->assertEquals($createdSkill->humanResources, 0);
        $this->assertEquals($createdSkill->legal, 0);
        $this->assertEquals($createdSkill->marketing, 0);
        $this->assertEquals($createdSkill->multimedia, 0);
        $this->assertEquals($createdSkill->onlineMarketing, 0);
        $this->assertEquals($createdSkill->photography, 1);
        $this->assertEquals($createdSkill->projectManagement, 0);
        $this->assertEquals($createdSkill->publicRelations, 0);
        $this->assertEquals($createdSkill->sales, 0);
        $this->assertEquals($createdSkill->socialMedia, 0);
        $this->assertEquals($createdSkill->technology, 1);
        $this->assertEquals($createdSkill->webDevelopment, 0);
        $this->assertEquals($createdSkill->other, "");
        
        $skill->delete();
        
        $deletedSkill = Skill::model()->findByPk($createdSkillId);
        
        $this->assertEquals($deletedSkill, null);
    }
    
    public function testSetSkillStringUnordered() {
        
        $skill = new Skill();
        $skill->setSkillString("Education,Social Media,Accounting,Photography,Branding", 0);
        
        $createdSkillId = $skill->id;
        $createdSkill = Skill::model()->findByPk($createdSkillId);
        
        $this->assertNotEquals($createdSkill, null);
        
        $this->assertEquals($createdSkill->accounting, 1);
        $this->assertEquals($createdSkill->advertising, 0);
        $this->assertEquals($createdSkill->branding, 1);
        $this->assertEquals($createdSkill->businessStrategy, 0);
        $this->assertEquals($createdSkill->communications, 0);
        $this->assertEquals($createdSkill->copywriting, 0);
        $this->assertEquals($createdSkill->design, 0);
        $this->assertEquals($createdSkill->education, 1);
        $this->assertEquals($createdSkill->entrepreneurship, 0);
        $this->assertEquals($createdSkill->eventPlanning, 0);
        $this->assertEquals($createdSkill->finance, 0);
        $this->assertEquals($createdSkill->fundraising, 0);
        $this->assertEquals($createdSkill->humanResources, 0);
        $this->assertEquals($createdSkill->legal, 0);
        $this->assertEquals($createdSkill->marketing, 0);
        $this->assertEquals($createdSkill->multimedia, 0);
        $this->assertEquals($createdSkill->onlineMarketing, 0);
        $this->assertEquals($createdSkill->photography, 1);
        $this->assertEquals($createdSkill->projectManagement, 0);
        $this->assertEquals($createdSkill->publicRelations, 0);
        $this->assertEquals($createdSkill->sales, 0);
        $this->assertEquals($createdSkill->socialMedia, 1);
        $this->assertEquals($createdSkill->technology, 0);
        $this->assertEquals($createdSkill->webDevelopment, 0);
        $this->assertEquals($createdSkill->other, "");
        
        $skill->delete();
        
        $deletedSkill = Skill::model()->findByPk($createdSkillId);
        
        $this->assertEquals($deletedSkill, null);
    }
    
    public function testSetSkillStringDuplicate() {
        
        $skill = new Skill();
        $skill->setSkillString("Education,Education,Photography,Photography", 0);
        
        $createdSkillId = $skill->id;
        $createdSkill = Skill::model()->findByPk($createdSkillId);
        
        $this->assertNotEquals($createdSkill, null);
        
        $this->assertEquals($createdSkill->accounting, 0);
        $this->assertEquals($createdSkill->advertising, 0);
        $this->assertEquals($createdSkill->branding, 0);
        $this->assertEquals($createdSkill->businessStrategy, 0);
        $this->assertEquals($createdSkill->communications, 0);
        $this->assertEquals($createdSkill->copywriting, 0);
        $this->assertEquals($createdSkill->design, 0);
        $this->assertEquals($createdSkill->education, 1);
        $this->assertEquals($createdSkill->entrepreneurship, 0);
        $this->assertEquals($createdSkill->eventPlanning, 0);
        $this->assertEquals($createdSkill->finance, 0);
        $this->assertEquals($createdSkill->fundraising, 0);
        $this->assertEquals($createdSkill->humanResources, 0);
        $this->assertEquals($createdSkill->legal, 0);
        $this->assertEquals($createdSkill->marketing, 0);
        $this->assertEquals($createdSkill->multimedia, 0);
        $this->assertEquals($createdSkill->onlineMarketing, 0);
        $this->assertEquals($createdSkill->photography, 1);
        $this->assertEquals($createdSkill->projectManagement, 0);
        $this->assertEquals($createdSkill->publicRelations, 0);
        $this->assertEquals($createdSkill->sales, 0);
        $this->assertEquals($createdSkill->socialMedia, 0);
        $this->assertEquals($createdSkill->technology, 0);
        $this->assertEquals($createdSkill->webDevelopment, 0);
        $this->assertEquals($createdSkill->other, "");
        
        $skill->delete();
        
        $deletedSkill = Skill::model()->findByPk($createdSkillId);
        
        $this->assertEquals($deletedSkill, null);
    }
    
    public function testSetSkillStringPlusOther() {
        
        $skill = new Skill();
        $skill->setSkillString("ruby,Business Strategy,perl,Fundraising,c++,Marketing", 0);
        
        $createdSkillId = $skill->id;
        $createdSkill = Skill::model()->findByPk($createdSkillId);
        
        $this->assertNotEquals($createdSkill, null);
        
        $this->assertEquals($createdSkill->accounting, 0);
        $this->assertEquals($createdSkill->advertising, 0);
        $this->assertEquals($createdSkill->branding, 0);
        $this->assertEquals($createdSkill->businessStrategy, 1);
        $this->assertEquals($createdSkill->communications, 0);
        $this->assertEquals($createdSkill->copywriting, 0);
        $this->assertEquals($createdSkill->design, 0);
        $this->assertEquals($createdSkill->education, 0);
        $this->assertEquals($createdSkill->entrepreneurship, 0);
        $this->assertEquals($createdSkill->eventPlanning, 0);
        $this->assertEquals($createdSkill->finance, 0);
        $this->assertEquals($createdSkill->fundraising, 1);
        $this->assertEquals($createdSkill->humanResources, 0);
        $this->assertEquals($createdSkill->legal, 0);
        $this->assertEquals($createdSkill->marketing, 1);
        $this->assertEquals($createdSkill->multimedia, 0);
        $this->assertEquals($createdSkill->onlineMarketing, 0);
        $this->assertEquals($createdSkill->photography, 0);
        $this->assertEquals($createdSkill->projectManagement, 0);
        $this->assertEquals($createdSkill->publicRelations, 0);
        $this->assertEquals($createdSkill->sales, 0);
        $this->assertEquals($createdSkill->socialMedia, 0);
        $this->assertEquals($createdSkill->technology, 0);
        $this->assertEquals($createdSkill->webDevelopment, 0);
        $this->assertEquals($createdSkill->other, "ruby,perl,c++");
        
        $skill->delete();
        
        $deletedSkill = Skill::model()->findByPk($createdSkillId);
        
        $this->assertEquals($deletedSkill, null);
    }
    
//    public function testSetSkillStringSpaces() {
//        
//        $skill = new Skill();
//        $skill->setSkillString("ruby, Business Strategy, perl, Fundraising,  c++, Marketing", 0);
//        
//        $createdSkillId = $skill->id;
//        $createdSkill = Skill::model()->findByPk($createdSkillId);
//        
//        $this->assertNotEquals($createdSkill, null);
//        
//        $this->assertEquals($createdSkill->accounting, 0);
//        $this->assertEquals($createdSkill->advertising, 0);
//        $this->assertEquals($createdSkill->branding, 0);
//        $this->assertEquals($createdSkill->businessStrategy, 1);
//        $this->assertEquals($createdSkill->communications, 0);
//        $this->assertEquals($createdSkill->copywriting, 0);
//        $this->assertEquals($createdSkill->design, 0);
//        $this->assertEquals($createdSkill->education, 0);
//        $this->assertEquals($createdSkill->entrepreneurship, 0);
//        $this->assertEquals($createdSkill->eventPlanning, 0);
//        $this->assertEquals($createdSkill->finance, 0);
//        $this->assertEquals($createdSkill->fundraising, 1);
//        $this->assertEquals($createdSkill->humanResources, 0);
//        $this->assertEquals($createdSkill->legal, 0);
//        $this->assertEquals($createdSkill->marketing, 1);
//        $this->assertEquals($createdSkill->multimedia, 0);
//        $this->assertEquals($createdSkill->onlineMarketing, 0);
//        $this->assertEquals($createdSkill->photography, 0);
//        $this->assertEquals($createdSkill->projectManagement, 0);
//        $this->assertEquals($createdSkill->publicRelations, 0);
//        $this->assertEquals($createdSkill->sales, 0);
//        $this->assertEquals($createdSkill->socialMedia, 0);
//        $this->assertEquals($createdSkill->technology, 0);
//        $this->assertEquals($createdSkill->webDevelopment, 0);
//        $this->assertEquals($createdSkill->other, "ruby,perl,c++");
//        
//        $skill->delete();
//        
//        $deletedSkill = Skill::model()->findByPk($createdSkillId);
//        
//        $this->assertEquals($deletedSkill, null);
//    }
    
    public function testSetSkillStringLetterCase() {
        
        $skill = new Skill();
        $skill->setSkillString("BusInesS strategy,funDraIsiNg,marKeting", 0);
        
        $createdSkillId = $skill->id;
        $createdSkill = Skill::model()->findByPk($createdSkillId);
        
        $this->assertNotEquals($createdSkill, null);
        
        $this->assertEquals($createdSkill->accounting, 0);
        $this->assertEquals($createdSkill->advertising, 0);
        $this->assertEquals($createdSkill->branding, 0);
        $this->assertEquals($createdSkill->businessStrategy, 1);
        $this->assertEquals($createdSkill->communications, 0);
        $this->assertEquals($createdSkill->copywriting, 0);
        $this->assertEquals($createdSkill->design, 0);
        $this->assertEquals($createdSkill->education, 0);
        $this->assertEquals($createdSkill->entrepreneurship, 0);
        $this->assertEquals($createdSkill->eventPlanning, 0);
        $this->assertEquals($createdSkill->finance, 0);
        $this->assertEquals($createdSkill->fundraising, 1);
        $this->assertEquals($createdSkill->humanResources, 0);
        $this->assertEquals($createdSkill->legal, 0);
        $this->assertEquals($createdSkill->marketing, 1);
        $this->assertEquals($createdSkill->multimedia, 0);
        $this->assertEquals($createdSkill->onlineMarketing, 0);
        $this->assertEquals($createdSkill->photography, 0);
        $this->assertEquals($createdSkill->projectManagement, 0);
        $this->assertEquals($createdSkill->publicRelations, 0);
        $this->assertEquals($createdSkill->sales, 0);
        $this->assertEquals($createdSkill->socialMedia, 0);
        $this->assertEquals($createdSkill->technology, 0);
        $this->assertEquals($createdSkill->webDevelopment, 0);
        $this->assertEquals($createdSkill->other, "");
        
        $skill->delete();
        
        $deletedSkill = Skill::model()->findByPk($createdSkillId);
        
        $this->assertEquals($deletedSkill, null);
    }
    
    public function testSetSkillStringSearchParameter() {
        
        $createdSkill = new Skill();
        $createdSkill->setSkillString("Business Strategy,Fundraising,Marketing", null);

        $this->assertEquals($createdSkill->accounting, null);
        $this->assertEquals($createdSkill->advertising, null);
        $this->assertEquals($createdSkill->branding, null);
        $this->assertEquals($createdSkill->businessStrategy, 1);
        $this->assertEquals($createdSkill->communications, null);
        $this->assertEquals($createdSkill->copywriting, null);
        $this->assertEquals($createdSkill->design, null);
        $this->assertEquals($createdSkill->education, null);
        $this->assertEquals($createdSkill->entrepreneurship, null);
        $this->assertEquals($createdSkill->eventPlanning, null);
        $this->assertEquals($createdSkill->finance, null);
        $this->assertEquals($createdSkill->fundraising, 1);
        $this->assertEquals($createdSkill->humanResources, null);
        $this->assertEquals($createdSkill->legal, null);
        $this->assertEquals($createdSkill->marketing, 1);
        $this->assertEquals($createdSkill->multimedia, null);
        $this->assertEquals($createdSkill->onlineMarketing, null);
        $this->assertEquals($createdSkill->photography, null);
        $this->assertEquals($createdSkill->projectManagement, null);
        $this->assertEquals($createdSkill->publicRelations, null);
        $this->assertEquals($createdSkill->sales, null);
        $this->assertEquals($createdSkill->socialMedia, null);
        $this->assertEquals($createdSkill->technology, null);
        $this->assertEquals($createdSkill->webDevelopment, null);
        $this->assertEquals($createdSkill->other, "");
    }
}
