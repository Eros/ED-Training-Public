<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 11-Apr-18
 * Time: 8:43 PM
 */
define('DB_TYPE', 'mysql');
define('DB_CONNTYPE', 'unixsocket');
define('DB_UNIX_SOCKET', '/tmp/mysql.sock');
define('DB_HOST_ADDRESS', 'localhost');
define('DB_HOST_PORT', '3306');
define('DB_USER', 'admin');
define('DB_PASS', 'secret');
define('DB_DATABASE', 'default');
define('PREF_PARTYLINE', false);
define('PREF_PARTYLINE_GROUP', 'George-DEV-DB');
define('PREF_PASSFORMAT', 'plain');
$admin_jids = array('admin@localhost', 'admin2@localhost');
define('APP_PATH', dirname(__FILE__));
define('VIEW_PATH', APP_PATH . '/views');
?>