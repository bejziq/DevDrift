<?php
require_once 'BaseDao.php';

class ReviewDao extends BaseDao {
    public function __construct() {
        parent::__construct("jobs");
    }

    public function getByJobId($job_id) {
        $stmt = $this->connection->prepare("SELECT * FROM jobs WHERE job_id = :job_id");
        $stmt->bindParam(':job_id', $job_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>