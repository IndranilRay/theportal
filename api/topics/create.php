<?php
/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 5/26/2018
 * Time: 7:28 PM
 */
use classes\Topic;
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/Database.php';

//required headers
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization,X-Requested-With");

//Instantiate Database and Topic object
$database = new Database();
$db = $database->getConnection();

// initialize Topic
$topic = new Topic($db);

//get posted data
$data = json_decode("php://input");
echo $data;




