<?php

require_once 'BaseService.php';
require_once __DIR__ . "/../dao/UserDao.php";

class UserService extends BaseService {

    public function __construct() {
        parent::__construct(new UserDao);
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