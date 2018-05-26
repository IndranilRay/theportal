<?php
namespace classes;
use Prophecy\Exception\InvalidArgumentException;

/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 5/24/2018
 * Time: 10:14 PM
 */
class Topic implements PortalInterface
{
    //Database objects
    private $conn;
    private $table_name = 'pam_topic';

    //Topic attributes
    public $topic_id;
    public $topic_title;
    public $created_date;

    public function __construct($db){
        $this->getDbConnection($db);
    }

    public function getDbConnection($db){
        if($db instanceof \PDO){
            $this->conn = $db;
            return $this->conn;
        } else {
            throw new InvalidArgumentException();
        }
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function read()
    {
        $query = "SELECT topic_id,topic_title from ".$this->table_name." ORDER BY created_date DESC";

        // prepare $query statement
        $stmnt = $this->conn->prepare($query);

        // execute query
        $stmnt->execute();

        return $stmnt;
    }

    public function read_one()
    {
        // TODO: Implement read_one() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

}