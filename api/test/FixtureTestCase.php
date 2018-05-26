<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

require_once __DIR__.'/../vendor/autoload.php';

class FixtureTestCase extends TestCase
{
    use TestCaseTrait;

    private $conn = null;
    public $fixtures = array(
        'topics',
    );

    public function setUp()
    {
        $conn  = $this->getConnection();
        $pdo = $conn->getConnection();

        $fixtureDataSet = $this->getDataSet($this->fixtures);
        foreach ($fixtureDataSet->getTableNames() as $table) {
            // drop table
            $pdo->exec("DROP TABLE IF EXISTS `$table`;");
            // recreate table
            $meta = $fixtureDataSet->getTableMetaData($table);
            $create = "CREATE TABLE IF NOT EXISTS `$table` ";
            $cols = array();
            foreach ($meta->getColumns() as $col) {
                $cols[] = "`$col` VARCHAR(200)";
            }
            $create .= '('.implode(',', $cols).');';
            $pdo->exec($create);
        }

        parent::setUp();
    }

    public function tearDown() {
        $allTables =
            $this->getDataSet($this->fixtures)->getTableNames();
        foreach ($allTables as $table) {
            // drop table
            $conn = $this->getConnection();
            $pdo = $conn->getConnection();
            $pdo->exec("DROP TABLE IF EXISTS `$table`;");
        }

        parent::tearDown();
    }

    /**
     * @return PHPUnit\DbUnit\Database\Connection
     */
    public function getConnection()
    {
        if($this->conn === null){
            try{
                $pdo =
                    new PDO('mysql:host=localhost;dbname=api_portal_system', 'root','');
                    $this->conn = $this->createDefaultDBConnection($pdo,'api_portal_system');
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }

        return $this->conn;
    }

    /**
     * @param array $fixtures
     * @return PHPUnit\DbUnit\DataSet\IDataSet
     */
    public function getDataSet($fixtures = array()) {
        if (empty($fixtures)) {
            $fixtures = $this->fixtures;
        }

        $compositeDs = new PHPUnit\DbUnit\DataSet\CompositeDataSet(array());
        $fixturePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'fixtures';

        foreach ($fixtures as $fixture) {
            $path =  $fixturePath . DIRECTORY_SEPARATOR . "$fixture.xml";
            $ds = $this->createMySQLXMLDataSet($path);
            $compositeDs->addDataSet($ds);
        }
        return $compositeDs;
    }

    public function loadDataSet($dataset)
    {
        // set the new dataset
        $this->getDatabaseTester()->setDataSet($dataset);
        $this->getDatabaseTester()->onSetUp();
    }
}