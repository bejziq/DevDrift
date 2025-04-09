<?php

require_once 'BaseService.php';
require_once 'UserDao.php';

class UserService extends BaseService {

    private $dao;

    public function __construct() {
        $this->dao = new UserDao();
    }

    public function getUserById($id) {
        return $this->dao->getById($id);
    }

    public function deleteUser($id) {
        $existingUser = $this->dao->getById($id);
        if (!$existingUser) {
            throw new Exception("User not found.");
        }

        return $this->dao->delete($id);
    }

}

?>