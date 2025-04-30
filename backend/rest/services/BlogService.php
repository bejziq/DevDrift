<?php

require_once 'BaseService.php';
require_once __DIR__ . "/../dao/BlogDao.php";


class BlogService extends BaseService{
    public function __construct() {
        parent::__construct(new BlogDao);
    }

    public function getByBlogId($blog_id) {
        return $this->dao->getByBlogId($blog_id);
    }

    public function addBlog($data) {
        return $this->dao->add($data);
    }

    public function updateBlog($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteBlog($id) {
        return $this->dao->delete($id);
    }
}

?>