<?php

/*
|--------------------------------------------------------------
| Boot autoloader!
|--------------------------------------------------------------
 */
require BASE_PATH . 'vendor/autoload.php';

/*
|--------------------------------------------------------------
| Boot Eloquent database configuration!
|--------------------------------------------------------------
 */
require BASE_PATH . 'config/database.php';

/*
|--------------------------------------------------------------
| Save configuration settings into memory & make it global!
|--------------------------------------------------------------
 */
$config = require BASE_PATH . 'config/app.php';
global $config;

/*
|--------------------------------------------------------------
| Include global helpers functoins!
|--------------------------------------------------------------
 */
require BASE_PATH . 'system/services/facades.php';
