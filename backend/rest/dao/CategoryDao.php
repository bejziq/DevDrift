<?php
require_once 'BaseDao.php';

class ReviewDao extends BaseDao {
    public function __construct() {
        parent::__construct("categories");
    }

    public function getByCategoryName($category_name) {
        $stmt = $this->connection->prepare("SELECT * FROM categories WHERE category_name = :category_name");
        $stmt->bindParam(':category_name', $category_name);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>