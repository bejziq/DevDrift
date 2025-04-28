<?php

require_once 'BaseDao.php';


class RoleService extends RoleService{
    public function __construct() {
        $dao = new RoleDao();

        parent::__construct($dao);
    }

    public function getByRoleId($blog_id) {
        return $this->dao->getByRoleId($role_id);
    }

    public function addRole($data) {
        return $this->dao->add($data);
    }

    public function updateRole($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteRole($id) {
        return $this->dao->delete($id);
    }
}
?>