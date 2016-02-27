<?php

class WishList extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert($data, $r) {
        if ($r != 0) {
            $query = "insert into wishlist (IDUser,IDProduct,Status) values "
                    . "({$data['IDUser']},{$data['IDProduct']},{$data['Status']}) ";
            $this->db->query($query);
            $query = "select LAST_INSERT_ID() as LastID";
            return $this->db->query($query);
        } else {
            throw new Exception;
        }
    }

    public function update($data, $r) {
        if ($r != 0) {
            $query = "update wishlist set IDUser = {$data['IDUser']} , IDProduct = {$data['IDProduct']}, Status = {$data['Status']} "
                    . "where IDWishlist = {$data['IDWishlist']} ";
            return $this->db->query($query);
        } else {
            throw new Exception;
        }
    }

    public function updateStatus($data, $r) {
        if ($r != 0) {
            $query = "update wishlist set Status = {$data['Status']} "
                    . "where IDWishlist = {$data['IDWishlist']} ";
            return $this->db->query($query);
        } else {
            throw new Exception;
        }
    }

    public function delete($data) {
        $query = "delete from wishlist where IDWishlist = {$data['IDWishlist']} ";
        return $this->db->query($query);
    }

    public function selectAll() {
        $query = "select * from wishlist ";
        return $this->db->query($query);
    }

    public function selectByIDUser($id) {
        $query = "select * from wishlist where IDUser = {$id}";
        return $this->db->query($query);
    }

    public function countAllRecord() {
        $query = "select count(*) as count from wishlist";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function countByIDUser($id = null) {
        $query = "select count(*) as count from wishlist where IDUser = {$id}";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function paginate($id, $page, $size) {
        $start = ($page - 1) * $size;
        $sql = "select * from wishlist where IDUser = {$id} limit {$start},{$size} ";
        return $this->db->query($sql);
    }

}
