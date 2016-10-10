<?php

/*
|---------------------------------------------------------------------------
| Constants:
|---------------------------------------------------------------------------
|
| Define the root-path and root-url-path constants,
| that we can use trough rest of our application.
|
 */
define('BASE_PATH', rtrim(__DIR__, 'public'));
define('BASE_URL', rtrim($_SERVER['PHP_SELF'], 'index.php'));

/*
|--------------------------------------------------------------------------
| Bootstrap:
|--------------------------------------------------------------------------
|
| Require a bootstrap file that will boot all that
| is needed for our application to run.
|
 */
require BASE_PATH . 'system/bootstrap.php';

/*
|--------------------------------------------------------------------------
| Instantiate the application class:
|--------------------------------------------------------------------------
|
| Start the application !
|
 */
$app = new Application;
