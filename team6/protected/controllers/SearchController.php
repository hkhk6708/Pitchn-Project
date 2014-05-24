<?php

class SearchController extends Controller 
{  
    public $testArray;
    public $testValue;
    
    public function actionIndex($name = '') {
        
        $currentUserEmail = Yii::app()->user->getId();
        
        $model3 = new Person();
        $model3->unsetAttributes();
        
        $currentUserDataProvider = $model3->searchByEmail($currentUserEmail);
        $currentUserArray = $currentUserDataProvider->getData();
        
        $currentUserType = $currentUserArray[0]["userType"];
        
        if ($currentUserType == "organizer") {
            
       //get the organizationId of all organizations the user works for
        $model1 = new WorksFor($scenario = 'searchByEmail');
        $model1->unsetAttributes();
        $model1->email = $currentUserEmail;
       
        $worksForDataProvider = $model1->searchByEmail();
        
        $worksForRowArray = $worksForDataProvider->getData();
        
        //Assume that organizers work for only 1 organization.
        //test type later to deal with arrays instead of int
        $organizationId = $worksForRowArray[0]["organizationId"];
        
        $model1->unsetAttributes();
        
        $model1->organizationId = $organizationId;
        
        $peopleFromTheSameOrgDataProvider = $model1->searchByOrgId();
        
        $peopleArray1 = $peopleFromTheSameOrgDataProvider->getData();
        
        $count = count($peopleArray1);
        
        $peopleArray2;
        
        for ($i=0; $i<$count; $i++) {
            $peopleArray2[$i] = $peopleArray1[$i]["email"];
        }
        
        $model2 = new Person();
        $model2->unsetAttributes();
       
        $peopleDataProvider = $model2->searchByEmailArray($peopleArray2);
        
        $this->render('organizerSearch', array(
         'dataProvider' => $peopleDataProvider));
            
        } else if ($currentUserType == "administrator") {
        

        $model2 = new Person($scenario="search");
        $model2->unsetAttributes();
        $model2->name = $name;
       
        $peopleDataProvider = $model2->search();

        $this->render('adminSearch', array(
            'dataProvider' => $peopleDataProvider));
        } else {
            //do nothing
        }

    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}