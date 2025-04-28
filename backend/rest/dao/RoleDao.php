<?php
require_once 'BaseDao.php';
class RoleDao extends BaseDao {

    protected $connection;
    private $table_name = "roles";
    public function __construct()
    {
        try {
            $this->connection = new PDO(
                "mysql:host=" . Config::DB_HOST() . ";dbname=" . Config::DB_NAME() . ";port=" . Config::DB_PORT(),
                Config::DB_USER(),
                Config::DB_PASSWORD(),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            throw $e;
        }
    }

public function get_by_id($id){
    return $this->getById($id);
}

public function get_all(){
    return $this->getAll();
}

public function add($roles){
    $this->insert($roles);
    return $roles;
}

public function partial_update($id, $roles){
    return $this->update($id, $roles);
}
}
?>