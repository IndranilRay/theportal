<?php
/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 5/26/2018
 * Time: 8:54 PM
 */
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

use classes\Article;
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/Database.php';

//Instantiate Database and Topic object
$database = new Database();
$db = $database->getConnection();

// initialize Article
$article = new Article($db);

// Query Article Object
$stmnt = $article->read();
$num = $stmnt->rowCount();

if($num > 0) {
    // Article array
    $article_arr = array();
    $article_arr['records'] = array();

    while ( $row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $article_items = array(
            'topic' => $topic,
            'article_id' => $article_id,
            'article_title'=> $article_title,
            'article_author'=> $article_author,
            'article_text'=> $article_text,
            'created_date'=> $created_date,
        );
        array_push($article_arr["records"],$article_items);
    }
    echo json_encode($article_arr);
} else {
    echo json_encode(array("message" => "No Articles Found."));
}





