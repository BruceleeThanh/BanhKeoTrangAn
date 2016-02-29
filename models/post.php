<?php

class Post extends Model {

    var $IDPost;
    var $Title;
    var $Content;
    var $Slug;
    var $Image;
    var $PostTime;

    public function __construct() {
        parent::__construct();
    }

    public function selectAll() {
        $query = "select * from post ";
        return $this->db->query($query);
    }

    public function selectByID($id) {
        $query = "select * from post where IDPost = '{$id}' ";
        $id = $this->db->query($query);
        return $id[0];
    }

    public function countAllPost() {
        $query = "select count(*) as count from post";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function countAllPostEnable() {
        $query = "select count(*) as count from post where Status = 1";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function paginate($page, $size) {
        $start = ($page - 1) * $size;
        $sql = "select * from post limit {$start},{$size} ";
        return $this->db->query($sql);
    }

    public function insert($data, $r) {
        if ($r != 0) {
            $query = "insert into post(Title,Content,Slug,Image,PostTime,Status) values ('{$data['Title']}','{$data['Content']}','{$data['Slug']}','{$data['Image']}',NOW(),{$data['Status']})";
            $this->db->query($query);
            $query = "select LAST_INSERT_ID() as LastPost";
            return $this->db->query($query);
        } else {
            throw new Exception("failed to insert post");
        }
    }

    public function update($data, $r) {
        if ($r != 0) {
            $sql = "update post set Title = '{$data['Title']}' , Content = '{$data['Content']}', Slug = '{$data['Slug']}',"
                    . "Image = '{$data['Image']}', PostTime = NOW(), Status = {$data['Status']} "
                    . "where IDPost = '{$data['id']}' ";

            return $this->db->query($sql);
        } else {
            throw new Exception("failed to edit user");
        }
    }

    public function delete($id) {
        $sql = "delete from post where IDPost = '{$id}' ";
        return $this->db->query($sql);
    }

    public function getIDPost() {
        return $this->IDPost;
    }

    public function getTitle() {
        return $this->Title;
    }

    public function getContent() {
        return $this->Content;
    }

    public function getSlug() {
        return $this->Slug;
    }

    public function getImage() {
        return $this->Image;
    }

    public function getPostTime() {
        return $this->PostTime;
    }

    public function setIDPost($IDPost) {
        $this->IDPost = $IDPost;
    }

    public function setTitle($Title) {
        $this->Title = $Title;
    }

    public function setContent($Content) {
        $this->Content = $Content;
    }

    public function setSlug($Slug) {
        $this->Slug = $Slug;
    }

    public function setImage($Image) {
        $this->Image = $Image;
    }

    public function setPostTime($PostTime) {
        $this->PostTime = $PostTime;
    }

}
