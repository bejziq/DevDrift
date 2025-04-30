<?php

require_once __DIR__ . '/BaseDao.php';

class CategoryDao extends BaseDao{

    protected $table_name;

    public function __construct()
    {
        $this->table_name = "categories";
        parent::__construct($this->table_name);
    }

    public function get_all() {
        return $this->query('SELECT * FROM ' . $this->table_name, []);
    }

    public function get_by_id($id) {
        return $this->query_unique('SELECT * FROM ' . $this->table_name . ' WHERE category_id = :id', ['id' => $id]);
    }


    }
?>