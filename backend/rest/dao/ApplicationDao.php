<?php

require_once 'BaseDao.php';

    class ApplicationDao extends BaseDao{

        protected $connection;
    private $table_name = "applications";
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

        public function getByApplicationId($application_id) {
            $stmt = $this->connection->prepare("SELECT * FROM applications WHERE application_id = :application_id");
            $stmt = bindParam(':application_id', $application_id);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
?>