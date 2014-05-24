<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('chartjs', dirname(__FILE__).'/../extensions/yii-chartjs');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/booster');
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Pitch\'n',
    // preloading 'log' component
    'defaultController' => "site", // <--- add this line and replace with correct controller/action
    'preload' => array('log', 'bootstrap','chartjs'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

//        'gii' => array(
//            'class' => 'system.gii.GiiModule',
//            'password' => false,
//        // If removed, Gii defaults to localhost only. Edit carefully to taste.
//        //'ipFilters' => array('127.0.0.1', '::1'),
//        ),
    ),
    // application components
    'components' => array(
        'bootstrap' => array(
            //'class' => 'bootstrap.components.Bootstrap',
            'class' => 'ext.booster.components.Bootstrap',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        /*
          'urlManager'=>array(
          'urlFormat'=>'path',
          'rules'=>array(
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
          ),
          ),
         
        /*
          'db' => array(
          'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
          ), */
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=pvms',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    'chartjs' => array('class' => 'chartjs.components.ChartJs'),
        ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
