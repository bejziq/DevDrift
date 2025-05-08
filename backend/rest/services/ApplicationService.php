<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/ApplicationDao.php";


class ApplicationService extends BaseService{
    public function __construct() {
        $dao = new ApplicationDao();

        parent::__construct($dao);
    }

    public function getByApplicationId($application_id) {
        return $this->dao->getByApplicationId($application_id);
    }

    public function addApplicaiton($data) {
        return $this->dao->add($data);
    }

    public function updateApplicaiton($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteApplication($id) {
        return $this->dao->delete($id);
    }
}

?>

