<?php

namespace ws\cept\unit;


class PDOTest extends \PHPUnit_Extensions_Database_TestCase
{
    /**
     * @var \PDO
     */
    public $db;

    public function setUp()
    {
        parent::setUp();
        $dsn = 'mysql:host=127.0.0.1;dbname=cept_ex';
        $username = 'root';
        $password = '';
        $opts = [
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        ];
        $this->db = new \PDO($dsn, $username, $password, $opts);
    }

    public function testMain()
    {

    }

    public function testFetch()
    {
        $data = [
            ':id' => 3,
        ];
        $sql = "SELECT * FROM post WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        // 指定只返回关联数组，默认返回的是索引数组和关联数组一起
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        $this->assertEquals('title3', $result['title']);
        $this->assertEquals('content3', $result['content']);
    }

    public function testFetchAll()
    {
        $data = [
            ':id' => 3,
        ];
        $sql = "SELECT * FROM post WHERE id>:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        // 指定只返回关联数组，默认返回的是索引数组和关联数组一起
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->assertEquals(3, count($result));
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->db = null;
    }

    /**
     * Returns the test database connection.
     *
     * @return \PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    protected function getConnection()
    {
        $dsn = 'mysql:host=127.0.0.1;dbname=cept_ex';
        $username = 'root';
        $password = '';
        $opts = [
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ];
        $pdo = new \PDO($dsn, $username, $password, $opts);
        return $this->createDefaultDBConnection($pdo);
    }

    /**
     * Returns the test dataset.
     *
     * @return \PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet()
    {
        $data = [
            'post' => require(__DIR__ . '/../_data/post.php'),
        ];
        return $this->createArrayDataSet($data);
    }
}
