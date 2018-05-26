<?php
namespace classes;
use Prophecy\Exception\InvalidArgumentException;
/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 5/24/2018
 * Time: 10:14 PM
 */
class Article implements PortalInterface
{
    //Database objects
    private $conn;
    private $table_name = 'pam_article';

    //Article attributes
    public $article_id;
    public $article_title;
    public $article_author;
    public $article_text;
    public $topic_title;
    public $topic_id;
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
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                article_title=:article_title, article_author=:article_author, article_text=:article_text, topic_id=:topic_id, created_date=:created_date";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->article_title=htmlspecialchars(strip_tags($this->article_title));
        $this->article_author=htmlspecialchars(strip_tags($this->article_author));
        $this->article_text=htmlspecialchars(strip_tags($this->article_text));
        $this->topic_id=htmlspecialchars(strip_tags($this->topic_id));
        $this->created_date=htmlspecialchars(strip_tags($this->created_date));

        // bind values
        $stmt->bindParam(":article_title", $this->article_title);
        $stmt->bindParam(":article_author", $this->article_author);
        $stmt->bindParam(":article_text", $this->article_text);
        $stmt->bindParam(":topic_id", $this->topic_id);
        $stmt->bindParam(":created_date", $this->created_date);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function read()
    {
        // select all query
        $query = "SELECT
                t.topic_title as topic, a.article_id, a.article_title, a.article_author, a.article_text, a.created_date
            FROM
                " . $this->table_name . " a
                LEFT JOIN
                    pam_topic t
                        ON t.topic_id = a.topic_id
            ORDER BY
                a.created_date DESC";

        // prepare $query statement
        $stmnt = $this->conn->prepare($query);

        // execute query
        $stmnt->execute();

        return $stmnt;
    }

    public function read_one()
    {
        // query to read single record
        $query = "SELECT
                t.topic_title as topic_title, a.article_id, a.article_title, a.article_author, a.article_text, a.created_date
            FROM
                " . $this->table_name . " a
                LEFT JOIN
                    pam_topic t
                        ON t.topic_id = a.topic_id
            WHERE
                a.article_id = ?
            LIMIT
                0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->article_id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        // set values to object properties
        $this->article_title = $row['article_title'];
        $this->article_author = $row['article_author'];
        $this->article_text = $row['article_text'];
        $this->topic_title = $row['topic_title'];
    }

    public function delete()
    {
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE article_id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->article_id=htmlspecialchars(strip_tags($this->article_id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->article_id);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
}