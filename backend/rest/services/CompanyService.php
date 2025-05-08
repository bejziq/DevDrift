<?php

require_once 'BaseService.php';
require_once __DIR__ . "/../dao/CompanyDao.php";


class CompanyService extends BaseService {

    public function __construct()
    {
        parent::__construct(new CompanyDao);
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
