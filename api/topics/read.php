<?php
use classes\Topic;
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/Database.php';

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Instantiate Database and Topic object
$database = new Database();
$db = $database->getConnection();

// initialize Topic
$topic = new Topic($db);

// Query Topic Object
$stmnt = $topic->read();

//echo '<pre>';
//print_r($stmnt);
//exit;
$num = $stmnt->rowCount();

if($num > 0) {
    // Topic array
    $topic_arr = array();
    $topic_arr['records'] = array();

    while ( $row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $topic_items = array(
            'id' => $topic_id,
            'title' => $topic_title,
        );
        array_push($topic_arr["records"],$topic_items);
    }
    echo json_encode($topic_arr);
} else {
    echo json_encode(array("message" => "No Topic Found."));
}





