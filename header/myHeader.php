<?php

require_once("/var/www/html/debug/header/dbconfig.php");
require_once("/var/www/html/debug/header/pdodbconfig.php");
require_once("/var/www/html/debug/header/LOG_HCH.php");

error_log ('{남기고자 하는 로그 메시지}', 3, "/var/www/html/book_sns/debug/log/logs/php_error.log");
error_reporting(E_ALL);
ini_set('display_errors',1);
?>