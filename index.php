<?php
session_start();
header('Access-Control-Allow-Origin: *');
// put your code here
require_once("Config/Config.php");
require_once("Helpers/Helpers.php");
require_once('vendor/autoload.php');
include_once('utils/location-info.php');

use Square\Environment;

// dotenv is used to read from the '.env' file created for credentials
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

// Pulled from the .env file and upper cased e.g. SANDBOX, PRODUCTION.
$upper_case_environment = strtoupper(getenv('ENVIRONMENT'));
$web_payment_sdk_url = $_ENV["ENVIRONMENT"] === Environment::PRODUCTION ? "https://web.squarecdn.com/v1/square.js" : "https://sandbox.web.squarecdn.com/v1/square.js";

$url = !empty($_GET['url']) ? $_GET['url'] : 'Home/index';
$arrUrl = explode("/", $url);
$controller = $arrUrl[0];
$method = $arrUrl[0];
$parameters = "";

if (!empty($arrUrl[1]) && $arrUrl[1] != "") {
    $method = $arrUrl[1];
}

if (!empty($arrUrl[2]) && $arrUrl[2] != "") {
    for ($i = 2; $i < count($arrUrl); $i++) {
        $parameters .= $arrUrl[$i] . ",";
    }
    $parameters = trim($parameters, ",");
}

require_once("Libraries/Core/Autoload.php");
require_once("Libraries/Core/Load.php");
