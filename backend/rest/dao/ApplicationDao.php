<?php

require_once 'BaseDao.php';

    class ApplicationDao extends BaseDao{
        public function __construct() {
            parent::__construct("applications");
        }

        public function getByApplicationId($application_id) {
            $stmt = $this->connection->prepare("SELECT * FROM applications WHERE application_id = :application_id");
            $stmt = bindParam(':application_id', $application_id);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
?>