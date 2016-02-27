<?php

class Cart extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert($data, $r) {
        if ($r != 0) {
            $query = "insert into cart (IDUser,IDProduct,Quantity,Status) values "
                    . "({$data['IDUser']},{$data['IDProduct']},{$data['Quantity']},{$data['Status']}) ";
            $this->db->query($query);
            $query = "select LAST_INSERT_ID() as LastID";
            return $this->db->query($query);
        } else {
            throw new Exception;
        }
    }

    public function update($data, $r) {
        if ($r != 0) {
            $query = "update cart set IDUser = {$data['IDUser']} , IDProduct = {$data['IDProduct']} , "
                    . "Quantity = {$data['Quantity']} , Status = {$data['Status']} "
                    . "where IDCart = {$data['IDCart']} ";
            return $this->db->query($query);
        } else {
            throw new Exception;
        }
    }

    public function paid($data, $r) {
        if ($r != 0) {
            $query = "update cart set "
                    . "Status = {$data['Status']} "
                    . "where IDCart = {$data['IDCart']} ";
            return $this->db->query($query);
        } else {
            throw new Exception;
        }
    }

    public function delete($data) {
        $query = "delete from cart where IDCart = {$data['IDCart']} ";
        return $this->db->query($query);
    }

    public function selectAll() {
        $query = "select * from cart ";
        return $this->db->query($query);
    }

    public function selectByIDUser($id, $status = 0) {
        $query = "select * from cart where IDUser = {$id} and Status = {$status}";
        return $this->db->query($query);
    }

    public function countAllRecord() {
        $query = "select count(*) as count from cart";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function countAllRecordEnable() {
        $query = "select count(*) as count from cart where Status = 1";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }
    public function countByIDUser($id = null){
        $query = "select count(*) as count from cart where IDUser = {$id} and status = 0 ";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }
    public function paginate($page, $size) {
        $start = ($page - 1) * $size;
        $sql = "select * from cart limit {$start},{$size} ";
        return $this->db->query($sql);
    }

}
