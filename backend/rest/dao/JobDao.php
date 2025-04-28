<?php
require_once 'BaseDao.php';

class JobDao extends BaseDao {
    /*
    private $connection;
        private $table_name = "jobs";
        public function __construct()
        {
            try {
                $host = 'localhost';
                $dbName = 'devdrift2';
                $dbPort = 3307;
                $username = 'root';
                $password = '';
                self::$connection = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";port=" . self::$port,
                    self::$username,
                    self::$password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
                );
            } catch (PDOException $e) {
                throw $e;
            }
        }*/

    protected $connection;
    private $table_name = "jobs";
    public function __construct()
    {
        try {
            $this->connection = new PDO(
                "mysql:host=" . Config::DB_HOST() . ";dbname=" . Config::DB_NAME() . ";port=" . Config::DB_PORT(),
                Config::DB_USER(),
                Config::DB_PASSWORD(),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getByJobId($job_id) {
        $stmt = $this->connection->prepare("SELECT * FROM jobs WHERE job_id = :job_id");
        $stmt->bindParam(':job_id', $job_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>