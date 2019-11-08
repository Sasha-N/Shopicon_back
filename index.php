<?php
//phpinfo();
//exit;
//spl_autoload_register(function ($MyApi){
//    include './classes/' . $MyApi . '.php';
//});
//require __DIR__.'./vendor/autoload.php';

//include_once './vendor/autoload.php';

use Roowix\ShopiconApp\DB\DB;
use Roowix\ShopiconApp\Response\ResponseWriter;
use Roowix\ShopiconApp\App;

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$dbconn = new DB();
$response = new ResponseWriter();

$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

$api = new App($dbconn);
$api->run($uri, $method, $response);