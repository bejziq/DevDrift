<?php
require_once 'BaseDao.php';

public function __construct(){
    parent::__construct("roles"); 
}

public function get_by_id($id){
    return $this->getById($id);
}

public function get_all(){
    return $this->getAll();
}


public function get_by_id($id){
    $stmt = $this->connection->prepare("SELECT * FROM roles WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll();
}

public function add($roles){
    $this->insert($roles);
    return $roles;
}

public function partial_update($id, $roles){
    return $this->update($id, $roles);
}

?>