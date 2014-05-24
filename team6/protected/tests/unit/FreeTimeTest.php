<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FreeTimeTest
 *
 * @author Lenox
 */
class FreeTimeTest extends CDbTestCase{
    
    public function testValidRangeOnce()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-02';
        $freeTime->startTime = '01:00:00';
        $freeTime->endDate = '2014-03-05';
        $freeTime->endTime = '10:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'once';
        
        $this->assertEquals($freeTime->save(),true);
        $this->assertEquals($freeTime->delete(),true);
    }
    
    public function testInvalidStartDateGreaterOnce()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-06-02';
        $freeTime->startTime = '01:00:00';
        $freeTime->endDate = '2014-03-05';
        $freeTime->endTime = '10:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'once';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidStartDateTimeGreaterOnce()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-05';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-05';
        $freeTime->endTime = '10:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'once';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidRangeBoundaryCaseOnce()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-05';
        $freeTime->startTime = '15:00:01';
        $freeTime->endDate = '2014-03-05';
        $freeTime->endTime = '15:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'once';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidRangeEqualCaseOnce()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-05';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-05';
        $freeTime->endTime = '15:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'once';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testValidRangeBoundaryCaseOnce()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-05';
        $freeTime->startTime = '14:59:59';
        $freeTime->endDate = '2014-03-05';
        $freeTime->endTime = '15:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'once';
        
        $this->assertEquals($freeTime->save(),true);
        $this->assertEquals($freeTime->delete(),true);
    }
    
    
    
    
    
    
    public function testValidRangeDaily()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-05';
        $freeTime->startTime = '00:00:00';
        $freeTime->endDate = '2014-03-05';
        $freeTime->endTime = '15:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'daily';
        
        $this->assertEquals($freeTime->save(),true);
        $this->assertEquals($freeTime->delete(),true);
    }
    
    public function testValidRangeBoundaryCaseDaily()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-05';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-06';
        $freeTime->endTime = '14:59:59';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'daily';
        
        $this->assertEquals($freeTime->save(),true);
        $this->assertEquals($freeTime->delete(),true);
    }
    
    public function testInvalidRangeEqualCaseDaily()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-05';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-06';
        $freeTime->endTime = '15:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'daily';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidRangeBoundaryCaseDaily()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-05';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-06';
        $freeTime->endTime = '15:00:01';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'daily';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidStartDateGreaterDaily()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-09';
        $freeTime->endTime = '00:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'daily';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidStartDateTimeGreaterDaily()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-10';
        $freeTime->endTime = '00:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'daily';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    
    
    
    
    public function testValidRangeWeekly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-14';
        $freeTime->endTime = '00:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'weekly';
        
        $this->assertEquals($freeTime->save(),true);
        $this->assertEquals($freeTime->delete(),true);
    }
    
    public function testValidRangeRecurringBoundaryCaseWeekly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-17';
        $freeTime->endTime = '14:59:59';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'weekly';
        
        $this->assertEquals($freeTime->save(),true);
        $this->assertEquals($freeTime->delete(),true);
    }
    
    public function testInvalidRangeRecurringEqualCaseWeekly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-17';
        $freeTime->endTime = '15:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'weekly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidRangeRecurringBoundaryCaseWeekly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-17';
        $freeTime->endTime = '15:00:01';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'weekly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidStartDateGreaterWeekly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-20';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-17';
        $freeTime->endTime = '15:00:01';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'weekly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidStartDateTimeGreaterWeekly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-17';
        $freeTime->startTime = '15:00:01';
        $freeTime->endDate = '2014-03-17';
        $freeTime->endTime = '15:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'weekly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    
    
    
    
    public function testValidRangeMonthly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-03-14';
        $freeTime->endTime = '00:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'monthly';
        
        $this->assertEquals($freeTime->save(),true);
        $this->assertEquals($freeTime->delete(),true);
    }
    
    public function testValidRangeRecurringBoundaryCaseMonthly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-04-10';
        $freeTime->endTime = '14:59:59';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'monthly';
        
        $this->assertEquals($freeTime->save(),true);
        $this->assertEquals($freeTime->delete(),true);
    }
    
    public function testInvalidRangeRecurringEqualCaseMonthly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-04-10';
        $freeTime->endTime = '15:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'monthly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidRangeRecurringBoundaryCaseMonthly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-04-10';
        $freeTime->endTime = '15:00:01';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'monthly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidStartDateGreaterMonthly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-06-20';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-04-20';
        $freeTime->endTime = '15:00:01';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'monthly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidStartDateTimeGreaterMonthly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-17';
        $freeTime->startTime = '15:00:01';
        $freeTime->endDate = '2014-03-17';
        $freeTime->endTime = '15:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'monthly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    
    
    
    public function testValidRangeYearly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-12-14';
        $freeTime->endTime = '00:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'yearly';
        
        $this->assertEquals($freeTime->save(),true);
        $this->assertEquals($freeTime->delete(),true);
    }
    
    public function testValidRangeRecurringBoundaryCaseYearly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2015-03-10';
        $freeTime->endTime = '14:59:59';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'yearly';
        
        $this->assertEquals($freeTime->save(),true);
        $this->assertEquals($freeTime->delete(),true);
    }
    
    public function testInvalidRangeRecurringEqualCaseYearly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2015-03-10';
        $freeTime->endTime = '15:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'yearly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidRangeRecurringBoundaryCaseYearly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-10';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2015-03-10';
        $freeTime->endTime = '15:00:01';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'yearly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidStartDateGreaterYearly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-07-20';
        $freeTime->startTime = '15:00:00';
        $freeTime->endDate = '2014-04-20';
        $freeTime->endTime = '15:00:01';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'yearly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
    public function testInvalidStartDateTimeGreaterYearly()
    {     
        $person = Person::model()->findByPk(1);
        $freeTime = new FreeTime();
        $freeTime->startDate = '2014-03-17';
        $freeTime->startTime = '15:00:01';
        $freeTime->endDate = '2014-03-17';
        $freeTime->endTime = '15:00:00';
        $freeTime->email = $person->email;
        $freeTime->recurring = 'yearly';
        
        $this->assertEquals($freeTime->save(),false);
    }
    
}
