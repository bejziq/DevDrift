<?php

require_once 'BaseService.php';
require_once __DIR__ . "/../dao/UserDao.php";

class UserService extends BaseService {

    public function __construct() {
        parent::__construct(new UserDao);
    }
    
    public function get_by_id($id) {
        return $this->dao->get_by_id($id);
    }

    public function deleteUser($id) {
        $existingUser = $this->dao->get_by_id($id);
        if (!$existingUser) {
            throw new Exception("User not found.");
        }

        return $this->dao->delete($id);
    }

    public function get_all() {
        return $this->dao->get_all();
    }

}

?>