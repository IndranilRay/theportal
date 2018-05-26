<?php

require_once 'FixtureTestCase.php';

/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 5/26/2018
 * Time: 11:02 AM
 */
class PortalFixturesTestCase extends FixtureTestCase
{
    public $fixtures = array(
        'topic',
    );

    function testReadDatabase() {

        $conn = $this->getConnection()->getConnection();

        // fixtures auto loaded, let's read some data
        $query = $conn->query('SELECT * FROM topic');
        $results = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(2, count($results));

        // now delete them
        $conn->query('TRUNCATE topics');

        $query = $conn->query('SELECT * FROM topic');
        $results = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(0, count($results));

        // now reload them
        $ds = $this->getDataSet(array('topic'));
        $this->loadDataSet($ds);

        $query = $conn->query('SELECT * FROM topics');
        $results = $query->fetchAll(PDO::FETCH_COLUMN);
        $this->assertEquals(3, count($results));
    }

}