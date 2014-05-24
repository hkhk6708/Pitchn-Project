<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CauseTest
 *
 * @author Lenox
 */
class CauseTest extends CDbTestCase{
    
    public function testGetSelectedCauseStringOptions()
    {
        // insert a comment in pending status
            $cause = new Cause();
            $cause->children = 1;
            $cause->humanRights = 1;
            $causeString = $cause->getSelectedCauseString("", ",");

            $this->assertEquals($causeString,"Children,Human Rights");
            
            $cause->children = 0;
            $causeString = $cause->getSelectedCauseString("", ",");

            $this->assertEquals($causeString,"Human Rights");
            
            $cause->children = 1;
            $cause->humanRights = 1;
            $cause->media = 1;
            $causeString = $cause->getSelectedCauseString("", ",");

            $this->assertEquals($causeString,"Children,Human Rights,Media");
    }
    
    public function testGetSelectedCauseStringOther() {
            $cause = new Cause();
            $cause->other = "research,society";
            $causeString = $cause->getSelectedCauseString("", ",");

            $this->assertEquals($causeString,"research,society");
    }
    
    public function testGetSelectedCauseStringOtherWithOptions() {
            $cause = new Cause();
            $cause->other = "research,society";
            $cause->media = 1;
            $causeString = $cause->getSelectedCauseString("", ",");
            
            $this->assertEquals($causeString,"Media,research,society");
    }
    
    public function testGetAttributeString() {
            $cause = new Cause();
            $causeString = $cause->getAttributeString("'", "',");
           
            $this->assertEquals($causeString,""
                    . "'Animal Welfare',"
                    . "'Arts And Culture',"
                    . "'Children',"
                    . "'Community And Service',"
                    . "'Democracy And Politics',"
                    . "'Education',"
                    . "'Environment',"
                    . "'Food',"
                    . "'Health',"
                    . "'Housing And Homelessness',"
                    . "'Human Rights',"
                    . "'Humanitarian Relief',"
                    . "'International Affairs',"
                    . "'Media',"
                    . "'Poverty Alleviation',"
                    . "'Religion',"
                    . "'Science And Technology',"
                    . "'Senior Citizens',"
                    . "'Womens Issues',");
    }
    
    public function testGetAttributeStringSeparators() {
            $cause = new Cause();
            $causeString = $cause->getAttributeString(":", ":");
           
            $this->assertEquals($causeString,""
                    . ":Animal Welfare:"
                    . ":Arts And Culture:"
                    . ":Children:"
                    . ":Community And Service:"
                    . ":Democracy And Politics:"
                    . ":Education:"
                    . ":Environment:"
                    . ":Food:"
                    . ":Health:"
                    . ":Housing And Homelessness:"
                    . ":Human Rights:"
                    . ":Humanitarian Relief:"
                    . ":International Affairs:"
                    . ":Media:"
                    . ":Poverty Alleviation:"
                    . ":Religion:"
                    . ":Science And Technology:"
                    . ":Senior Citizens:"
                    . ":Womens Issues:");
    }
    
    public function testSetCauseString() {
        
        $cause = new Cause();
        $cause->setCauseString("Community And Service,Food,Health,Media,Religion", 0);
        
        $createdCauseId = $cause->id;
        $createdCause = Cause::model()->findByPk($createdCauseId);
        
        $this->assertNotEquals($createdCause, null);
        
        $this->assertEquals($createdCause->animalWelfare, 0);
        $this->assertEquals($createdCause->artsAndCulture, 0);
        $this->assertEquals($createdCause->children, 0);
        $this->assertEquals($createdCause->communityAndService, 1);
        $this->assertEquals($createdCause->democracyAndPolitics, 0);
        $this->assertEquals($createdCause->education, 0);
        $this->assertEquals($createdCause->environment, 0);
        $this->assertEquals($createdCause->food, 1);
        $this->assertEquals($createdCause->health, 1);
        $this->assertEquals($createdCause->housingAndHomelessness, 0);
        $this->assertEquals($createdCause->humanRights, 0);
        $this->assertEquals($createdCause->humanitarianRelief, 0);
        $this->assertEquals($createdCause->internationalAffairs, 0);
        $this->assertEquals($createdCause->media, 1);
        $this->assertEquals($createdCause->povertyAlleviation, 0);
        $this->assertEquals($createdCause->religion, 1);
        $this->assertEquals($createdCause->scienceAndTechnology, 0);
        $this->assertEquals($createdCause->seniorCitizens, 0);
        $this->assertEquals($createdCause->womensIssues, 0);
        $this->assertEquals($createdCause->other, "");
        
        $cause->delete();
        
        $deletedCause = Cause::model()->findByPk($createdCauseId);
        
        $this->assertEquals($deletedCause, null);
    }
    
    public function testSetCauseStringUnordered() {
        
        $cause = new Cause();
        $cause->setCauseString("Food,Media,Religion,Community And Service,Health", 0);
        
        $createdCauseId = $cause->id;
        $createdCause = Cause::model()->findByPk($createdCauseId);
        
        $this->assertNotEquals($createdCause, null);
        
        $this->assertEquals($createdCause->animalWelfare, 0);
        $this->assertEquals($createdCause->artsAndCulture, 0);
        $this->assertEquals($createdCause->children, 0);
        $this->assertEquals($createdCause->communityAndService, 1);
        $this->assertEquals($createdCause->democracyAndPolitics, 0);
        $this->assertEquals($createdCause->education, 0);
        $this->assertEquals($createdCause->environment, 0);
        $this->assertEquals($createdCause->food, 1);
        $this->assertEquals($createdCause->health, 1);
        $this->assertEquals($createdCause->housingAndHomelessness, 0);
        $this->assertEquals($createdCause->humanRights, 0);
        $this->assertEquals($createdCause->humanitarianRelief, 0);
        $this->assertEquals($createdCause->internationalAffairs, 0);
        $this->assertEquals($createdCause->media, 1);
        $this->assertEquals($createdCause->povertyAlleviation, 0);
        $this->assertEquals($createdCause->religion, 1);
        $this->assertEquals($createdCause->scienceAndTechnology, 0);
        $this->assertEquals($createdCause->seniorCitizens, 0);
        $this->assertEquals($createdCause->womensIssues, 0);
        $this->assertEquals($createdCause->other, "");
        
        $cause->delete();
        
        $deletedCause = Cause::model()->findByPk($createdCauseId);
        
        $this->assertEquals($deletedCause, null);
    }
    
    public function testSetSkillStringDuplicate() {
        
        $cause = new Cause();
        $cause->setCauseString("Food,Food,Religion,Religion", 0);
        
        $createdCauseId = $cause->id;
        $createdCause = Cause::model()->findByPk($createdCauseId);
        
        $this->assertNotEquals($createdCause, null);
        
        $this->assertEquals($createdCause->animalWelfare, 0);
        $this->assertEquals($createdCause->artsAndCulture, 0);
        $this->assertEquals($createdCause->children, 0);
        $this->assertEquals($createdCause->communityAndService, 0);
        $this->assertEquals($createdCause->democracyAndPolitics, 0);
        $this->assertEquals($createdCause->education, 0);
        $this->assertEquals($createdCause->environment, 0);
        $this->assertEquals($createdCause->food, 1);
        $this->assertEquals($createdCause->health, 0);
        $this->assertEquals($createdCause->housingAndHomelessness, 0);
        $this->assertEquals($createdCause->humanRights, 0);
        $this->assertEquals($createdCause->humanitarianRelief, 0);
        $this->assertEquals($createdCause->internationalAffairs, 0);
        $this->assertEquals($createdCause->media, 0);
        $this->assertEquals($createdCause->povertyAlleviation, 0);
        $this->assertEquals($createdCause->religion, 1);
        $this->assertEquals($createdCause->scienceAndTechnology, 0);
        $this->assertEquals($createdCause->seniorCitizens, 0);
        $this->assertEquals($createdCause->womensIssues, 0);
        $this->assertEquals($createdCause->other, "");
        
        $cause->delete();
        
        $deletedCause = Cause::model()->findByPk($createdCauseId);
        
        $this->assertEquals($deletedCause, null);
    }
    
    public function testSetCauseStringPlusOther() {
        
        $cause = new Cause();
        $cause->setCauseString("Food,research,Religion,society", 0);
        
        $createdCauseId = $cause->id;
        $createdCause = Cause::model()->findByPk($createdCauseId);
        
        $this->assertNotEquals($createdCause, null);
        
        $this->assertEquals($createdCause->animalWelfare, 0);
        $this->assertEquals($createdCause->artsAndCulture, 0);
        $this->assertEquals($createdCause->children, 0);
        $this->assertEquals($createdCause->communityAndService, 0);
        $this->assertEquals($createdCause->democracyAndPolitics, 0);
        $this->assertEquals($createdCause->education, 0);
        $this->assertEquals($createdCause->environment, 0);
        $this->assertEquals($createdCause->food, 1);
        $this->assertEquals($createdCause->health, 0);
        $this->assertEquals($createdCause->housingAndHomelessness, 0);
        $this->assertEquals($createdCause->humanRights, 0);
        $this->assertEquals($createdCause->humanitarianRelief, 0);
        $this->assertEquals($createdCause->internationalAffairs, 0);
        $this->assertEquals($createdCause->media, 0);
        $this->assertEquals($createdCause->povertyAlleviation, 0);
        $this->assertEquals($createdCause->religion, 1);
        $this->assertEquals($createdCause->scienceAndTechnology, 0);
        $this->assertEquals($createdCause->seniorCitizens, 0);
        $this->assertEquals($createdCause->womensIssues, 0);
        $this->assertEquals($createdCause->other, "research,society");
        
        $cause->delete();
        
        $deletedCause = Cause::model()->findByPk($createdCauseId);
        
        $this->assertEquals($deletedCause, null);
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
    
    public function testSetCauseStringLetterCase() {
        
        $cause = new Cause();
        $cause->setCauseString("environment,foOd,ReLiGion", 0);
        
        $createdCauseId = $cause->id;
        $createdCause = Cause::model()->findByPk($createdCauseId);
        
        $this->assertNotEquals($createdCause, null);
        
        $this->assertEquals($createdCause->animalWelfare, 0);
        $this->assertEquals($createdCause->artsAndCulture, 0);
        $this->assertEquals($createdCause->children, 0);
        $this->assertEquals($createdCause->communityAndService, 0);
        $this->assertEquals($createdCause->democracyAndPolitics, 0);
        $this->assertEquals($createdCause->education, 0);
        $this->assertEquals($createdCause->environment, 1);
        $this->assertEquals($createdCause->food, 1);
        $this->assertEquals($createdCause->health, 0);
        $this->assertEquals($createdCause->housingAndHomelessness, 0);
        $this->assertEquals($createdCause->humanRights, 0);
        $this->assertEquals($createdCause->humanitarianRelief, 0);
        $this->assertEquals($createdCause->internationalAffairs, 0);
        $this->assertEquals($createdCause->media, 0);
        $this->assertEquals($createdCause->povertyAlleviation, 0);
        $this->assertEquals($createdCause->religion, 1);
        $this->assertEquals($createdCause->scienceAndTechnology, 0);
        $this->assertEquals($createdCause->seniorCitizens, 0);
        $this->assertEquals($createdCause->womensIssues, 0);
        $this->assertEquals($createdCause->other, "");
        
        $cause->delete();
        
        $deletedCause = Cause::model()->findByPk($createdCauseId);
        
        $this->assertEquals($deletedCause, null);
    }
    
    public function testSetCauseStringSearchParameter() {
        
        $createdCause = new Cause();
        $createdCause->setCauseString("Community And Service,Health,Food,Media,Religion", null);

        $this->assertEquals($createdCause->animalWelfare, null);
        $this->assertEquals($createdCause->artsAndCulture, null);
        $this->assertEquals($createdCause->children, null);
        $this->assertEquals($createdCause->communityAndService, 1);
        $this->assertEquals($createdCause->democracyAndPolitics, null);
        $this->assertEquals($createdCause->education, null);
        $this->assertEquals($createdCause->environment, null);
        $this->assertEquals($createdCause->food, 1);
        $this->assertEquals($createdCause->health, 1);
        $this->assertEquals($createdCause->housingAndHomelessness, null);
        $this->assertEquals($createdCause->humanRights, null);
        $this->assertEquals($createdCause->humanitarianRelief, null);
        $this->assertEquals($createdCause->internationalAffairs, null);
        $this->assertEquals($createdCause->media, 1);
        $this->assertEquals($createdCause->povertyAlleviation, null);
        $this->assertEquals($createdCause->religion, 1);
        $this->assertEquals($createdCause->scienceAndTechnology, null);
        $this->assertEquals($createdCause->seniorCitizens, null);
        $this->assertEquals($createdCause->womensIssues, null);
        $this->assertEquals($createdCause->other, "");
    }
}
