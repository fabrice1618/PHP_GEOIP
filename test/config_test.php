<?php 
require_once("../App.php");

$app = new App();

$config = new ConfigJson(App::get_base_path()."/config.dist");
$config->set('MYSQL_HOST', '<mysqlhost>');
$config->set('MYSQL_DATABASE', '<database>');
$config->set('MYSQL_USER', '<user>');
$config->set('MYSQL_PASSWORD', '<password>');
$config->writeJSONFile();

