<?php


putenv('APP_URL=http://ecommerce.test');
putenv('APP_ENV=local');
putenv('APP_NAME=Ecommerce mdesign');

//database
putenv('DB_DRIVER=mysql');
putenv('HOST=localhost');
putenv('DB_USERNAME=root');
putenv('DB_PASSWORD=root');

//Mail Credentials
putenv('EMAIL_USERNAME=montrecatalogue@gmail.com');
putenv('EMAIL_PASSWORD=zack1203');
putenv('SMTP_PORT=587');
putenv('SMTP_HOST=smtp.gmail.com');
putenv('ADMIN_EMAIL=montrecatalogue@gmail.com');

/**
 * Start session if not already started
 */
if(!isset($_SESSION)) session_start();

//load environment variable
require_once __DIR__ . '/../app/config/_env.php';

//instantiate database class
new \App\Classes\Database();

//set custom error handler
set_error_handler([new \App\Classes\ErrorHandler(), 'handleErrors']);


//load router file
require_once __DIR__ . '/../app/routing/routes.php';

new \App\RouteDispatcher($router);

