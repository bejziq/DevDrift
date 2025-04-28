<?php
require_once 'BaseDao.php';

class CompanyDao extends BaseDao {

    protected $connection;
    private $table_name = "companies";
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


    public function getByCompanyId($company_id) {
        $stmt = $this->connection->prepare("SELECT * FROM companies WHERE company_id = :company_id");
        $stmt->bindParam(':company_id', $company_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>