<?php

require_once 'BaseService.php';
require_once 'CompanyDao.php';


class CompanyService extends BaseService {

    private $dao;

    public function __construct() {
        $this->dao = new CompanyDao();
    }

    public function getAllCompanies() {
        return $this->dao->getAll();
    }

    public function getCompanyById($id) {
        return $this->dao->getById($id);
    }

    public function addCompany($companyData) {
        if (empty($companyData['name'])) {
            throw new Exception("Company name is required.");
        }

        return $this->dao->add($companyData);
    }

    public function updateCompany($id, $companyData) {
        $existingCompany = $this->dao->getById($id);
        if (!$existingCompany) {
            throw new Exception("Company not found.");
        }

        return $this->dao->update($id, $companyData);
    }

    public function deleteCompany($id) {
        $existingCompany = $this->dao->getById($id);
        if (!$existingCompany) {
            throw new Exception("Company not found.");
        }

        return $this->dao->delete($id);
    }

}

?>
