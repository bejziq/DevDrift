<?php
require_once 'BaseDao.php';

class ReviewDao extends BaseDao {
    public function __construct() {
        parent::__construct("companies");
    }

    public function getByCompanyId($company_id) {
        $stmt = $this->connection->prepare("SELECT * FROM companies WHERE company_id = :company_id");
        $stmt->bindParam(':company_id', $company_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>