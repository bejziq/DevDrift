<?php

require_once __DIR__ . '/BaseDao.php';

class CompanyDao extends BaseDao{

    protected $table_name;

    public function __construct()
    {
        $this->table_name = "companies";
        parent::__construct($this->table_name);
    }

    public function get_all() {
        return $this->query('SELECT * FROM ' . $this->table_name, []);
    }

    public function get_by_id($id) {
        return $this->query_unique('SELECT * FROM ' . $this->table_name . ' WHERE company_id = :id', ['id' => $id]);
    }

    }
?>