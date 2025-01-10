<?php

// set env
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD']);

// change the following paths if necessary
$yiic=dirname(__FILE__).'/../../yii1/framework/yiic.php';
$config=dirname(__FILE__).'/config/console.php';

require_once($yiic);
