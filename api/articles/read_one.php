<?php
/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 5/27/2018
 * Time: 1:10 AM
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

use classes\Article;
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/Database.php';

//Instantiate Database and Article object
$database = new Database();
$db = $database->getConnection();

// initialize Article
$article = new Article($db);

// set ID property of article to be edited
$article->article_id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of article to be edited
$article->read_one();

// create array
$article_arr = array(
    "article_id" =>  $article->article_id,
    "article_title" => $article->article_title,
    "article_author" => $article->article_author,
    "article_text" => $article->article_text,
    "topic_title" => $article->topic_title

);

// make it json format
print_r(json_encode($article_arr));