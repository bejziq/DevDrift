<?php
require_once 'BaseDao.php';

class CategoryDao extends BaseDao {

    protected $connection;
    private $table_name = "categories";
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

    public function getByCategoryName($category_name) {
        $stmt = $this->connection->prepare("SELECT * FROM categories WHERE category_name = :category_name");
        $stmt->bindParam(':category_name', $category_name);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>