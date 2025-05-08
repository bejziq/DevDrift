<?php

require_once 'BaseService.php';
require_once __DIR__ . "/../dao/ContactDao.php";


class ContactService extends BaseService{
    public function __construct() {
        parent::__construct(new ContactDao);
    }

    public function getByContactId($contact_id) {
        return $this->dao->getByContactId($contact_id);
    }

    public function addContact($data) {
        return $this->dao->add($data);
    }

    public function updateContact($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteContact($id) {
        return $this->dao->delete($id);
    }
}

?>