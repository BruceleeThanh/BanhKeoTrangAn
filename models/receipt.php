<?php

class Receipt extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert($data, $r) {
        if ($r != 0) {
            $query = "insert into receipt (IDUser,Fullname,Address,Email,Phonenumber,Total) values "
                    . "({$data['IDUser']},'{$data['Fullname']}','{$data['Address']}','{$data['Email']}','{$data['Phonenumber']}',{$data['Total']}) ";
            return $this->db->query($query);
        } else {
            throw new Exception;
        }
    }

    public function getLastID() {
        $query = "select max(IDReceipt) as last_id from receipt ";
        $last_id = $this->db->query($query);
        return $last_id[0]['last_id'];
    }

    public function selectAll() {
        $query = "select * from receipt ";
        return $this->db->query($query);
    }

    public function countAllRecord() {
        $query = "select count(*) as count from receipt";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function countAllRecordEnable() {
        $query = "select count(*) as count from receipt where Status = 1";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function paginate($page, $size) {
        $start = ($page - 1) * $size;
        $sql = "select * from receipt limit {$start},{$size} ";
        return $this->db->query($sql);
    }

}
