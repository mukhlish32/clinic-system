<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Sistem Informasi Klinik',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.commands.*',
	),

	'modules' => array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/),

	// application components
	'components' => array(
		'menu' => array(
			'class' => 'MenuItem',
		),

		// uncomment the following to enable URLs in path-format
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => array(
				'' => 'auth/login',
				'dashboard' => 'auth/dashboard',
				'master/role' => 'master/role/index',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),

		// database settings are configured in database.php
		'db' => require(dirname(__FILE__) . '/database.php'),
		'user' => array(
			'class' => 'WebUser', 
			'allowAutoLogin' => true,
			'loginUrl' => array('auth/login'),
		),
		'authManager' => array(
			'class' => 'CDbAuthManager',
			'connectionID' => 'db',
		),

		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => YII_DEBUG ? null : 'site/error',
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
		'timeZone' => 'Asia/Jakarta', // Set the timezone to your desired location

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'webmaster@example.com',
	),
);
