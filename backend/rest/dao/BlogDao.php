<?php

require_once __DIR__ . '/BaseDao.php';

class BlogDao extends BaseDao{

    protected $table_name;

    public function __construct()
    {
        $this->table_name = "blogs";
        parent::__construct($this->table_name);
    }

    public function get_all() {
        return $this->query('SELECT * FROM ' . $this->table_name, []);
    }

    public function get_by_id($id) {
        return $this->query_unique('SELECT * FROM ' . $this->table_name . ' WHERE blog_id = :id', ['id' => $id]);
    }

    }
?>