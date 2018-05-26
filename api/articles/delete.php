<?php
/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 5/27/2018
 * Time: 1:57 AM
 */
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


use classes\Article;
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/Database.php';

//Instantiate Database and Article object
$database = new Database();
$db = $database->getConnection();

// initialize Article
$article = new Article($db);

// get article id
$data = json_decode(file_get_contents("php://input"));

// set article id to be deleted
$article->article_id = $data->id;

// delete the article
if($article->delete()){
    echo '{';
    echo '"message": "Article was deleted."';
    echo '}';
}

// if unable to delete the product
else{
    echo '{';
    echo '"message": "Unable to delete object."';
    echo '}';
}