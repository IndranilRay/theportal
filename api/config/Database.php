<?php
/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 5/26/2018
 */
class Database
{
    // Database credentials
    private $host = "localhost";
    private $db_name = "api_portal_system";
    private $username = "root";
    private $password = "";
    public $conn = null;

    /* getConnection(): Method returns a vaild database connection object
     *
     */
    public function getConnection(){
        if($this->conn === null){
            try{
                $this->conn =
                    new PDO('mysql:host=localhost;dbname=api_portal_system', 'root','');
                $this->conn->exec("set names utf8");
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }
        return $this->conn;
    }
}
