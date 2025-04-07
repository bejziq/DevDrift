<?php
require_once 'BaseDao.php';

class ReviewDao extends BaseDao {
    public function __construct() {
        parent::__construct("blogs");
    }

    public function getByBlogId($blog_id) {
        $stmt = $this->connection->prepare("SELECT * FROM blogs WHERE blog_id = :blog_id");
        $stmt->bindParam(':blog_id', $blog_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>