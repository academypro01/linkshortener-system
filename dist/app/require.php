<?php
if(session_id() == ''){
    session_start();
}
require_once 'libraries/Core.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Database.php';
require_once 'libraries/Semej.php';
require_once 'libraries/Mailer.php';
require_once 'libraries/AuthToken.php';

require_once 'config/config.php';

$init = new Core();