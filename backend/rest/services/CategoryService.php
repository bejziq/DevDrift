<?php
require_once 'BaseDao.php';

class CategoryService extends BaseService{
    public function __construct() {
        $dao = new CategoryDao();

        parent::__construct($dao);
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