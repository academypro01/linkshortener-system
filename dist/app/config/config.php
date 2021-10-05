<?php
ob_start();
if(session_id() == ''){
    session_start();
}
date_default_timezone_set("Asia/Tehran");
// database information
define('DB_HOST', 'localhost');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');

// SMTP information for PHPMailer
define('SMTP_SENDER','');
define('SMTP_HOST','');
define('SMTP_PORT','');
define('SMTP_PASS','');
define('SMTP_NAME','LinkShortner System');

// set local root path
define('APPROOT', realpath(dirname(dirname(__FILE__))));

// set url root path link
define('URLROOT', '');

// set site name
define('SITENAME', 'Link Shortner System');