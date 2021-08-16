<?php
ob_start();
if(session_id() == ''){
    session_start();
}
date_default_timezone_set("Asia/Tehran");
// database information
define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');

// SMTP information for PHPMailer
define('SMTP_SENDER','');
define('SMTP_HOST','');
define('SMTP_PORT','');
define('SMTP_PASS','');
define('SMTP_NAME','LinkShortner System');

define('APPROOT', realpath(dirname(dirname(__FILE__))));
define('URLROOT', '');
define('SITENAME', 'Link Shortner System');