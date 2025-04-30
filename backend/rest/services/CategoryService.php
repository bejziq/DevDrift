<?php
require_once 'BaseService.php';
require_once __DIR__ . "/../dao/CategoryDao.php";

class CategoryService extends BaseService{
    public function __construct() {
        parent::__construct(new CategoryDao);
    }

    public function getByCategoryId($category_id) {
        return $this->dao->getByCategoryId($category_id);
    }

    public function addCategory($data) {
        return $this->dao->add($data);
    }

    public function updateCategory($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteCategory($id) {
        return $this->dao->delete($id);
    }
}

?>