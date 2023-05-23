<?php
require('./read_config.php');
$config = new read_config;
$config->readConfig();
$PHPServerIP = $config->getPHPServerIP();
$PyServerIP = $config->getPyServerIP();
$DBIP = $config->getDBIP();
$DBPort = $config->getDBPort();
$DBAdmin = $config->getDBAdmin();
$DBPassword = $config->getDBPassword();
echo $PHPServerIP;