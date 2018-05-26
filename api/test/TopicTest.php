<?php
use PHPunit\Framework\TestCase;
use classes\Topic;
require_once 'autoload.php';
require_once __DIR__.'/../config/Database.php';

/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 5/26/2018
 * Time: 3:23 PM
 */
class TopicTest extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->classname = 'Topic';
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
        $this->topic = new Topic($this->conn);
        parent::setUp();
    }

    public function testTopicConstructor(){
        // Get mock without constructor being called
        $mock = $this->getMockBuilder($this->classname)
            ->disableOriginalConstructor()
            ->getMock();

        // set expectations for constructor called
        $mock->expects($this->once())
            ->method('createDbConnection')
            ->with(
                $this->equalTo($this->conn)
        );

        //Invoke constructor
        $reflectedClass = new ReflectionClass($this->classname);
        $constructor = $reflectedClass->getConstructor();
        $constructor->invoke($mock,$this->conn);
    }

    public function testReadReturnsCorrectRecordCounts(){
        $query = "SELECT * FROM pam_topic";
        // prepeare $query statement
        $stmnt = $this->conn->prepare($query);
        // execute query
        $stmnt->execute();

        $totalRowCount = $stmnt->rowCount();
        $rowCntByRead = $this->topic->read()->rowCount();

        $this->assertEquals($totalRowCount, $rowCntByRead);
    }

    public function testCreateDbConnectionGetCorrectObject(){
        $this->assertInstanceOf(
            'PDO',$this->topic->createDbConnection($this->conn));
    }

}