<?php
/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 5/27/2018
 * Time: 12:29 AM
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

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set article property values
$article->article_title = $data->article_title;
$article->article_author = $data->article_author;
$article->article_text = $data->article_text;
$article->topic_id = $data->topic_id;
$article->created_date = date('Y-m-d H:i:s');

// create the article
if($article->create()){
    echo '{';
    echo '"message": "Article was created."';
    echo '}';
}

// if unable to create the product, tell the user
else{
    echo '{';
    echo '"message": "Unable to create article."';
    echo '}';
}
