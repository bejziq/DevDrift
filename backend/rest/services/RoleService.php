<?php

require_once 'BaseService.php';
require_once __DIR__ . "/../dao/RoleDao.php";


class RoleService extends BaseService{
    public function __construct() {
        parent::__construct(new RoleDao);
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