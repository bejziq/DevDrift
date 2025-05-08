<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/JobDao.php";

class JobService extends BaseService{
    public function __construct() {
        parent::__construct(new JobDao);
    }

    public function getByJobId($job_id) {
        return $this->dao->getByJobId($job_id);
    }

    public function addJob($data) {
        return $this->dao->add($data);
    }

    public function updateJob($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteJob($id) {
        return $this->dao->delete($id);
    }
}


?>