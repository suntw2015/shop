<?php
$server_host = $_SERVER['SERVER_NAME'];
$current_path = dirname(__FILE__);

$_SERVER['APP_PATH'] = 'application';
if(strpos($server_host,"manage") !== false){
    $_SERVER['APP_PATH'] = 'manage';
}

$_SERVER['APP_PATH'] = $current_path."/".$_SERVER['APP_PATH'];
chdir("./ci");
require("index.php");