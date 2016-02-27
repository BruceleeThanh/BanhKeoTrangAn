<?php

class ReceiptDetail extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert($data, $r) {
        if ($r != 0) {
            $query = "insert into receiptdetail (IDReceipt,IDCart,SaleUnitPrice,Quantity) values "
                    . "( {$data['IDReceipt']} , {$data['IDCart']} , {$data['SaleUnitPrice']} , {$data['Quantity']} ) ";
            return $this->db->query($query);
        } else {
            throw new Exception;
        }
    }

    public function selectAll() {
        $query = "select * from receiptdetail ";
        return $this->db->query($query);
    }

    public function selectByIDReceipt($ID) {
        $query = "select * from receiptdetail where IDReceipt = {$ID}";
        return $this->db->query($query);
    }

    public function countAllRecord() {
        $query = "select count(*) as count from receiptdetail";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function countAllRecordEnable() {
        $query = "select count(*) as count from receiptdetail where Status = 1";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function paginate($id,$page, $size) {
        $start = ($page - 1) * $size;
        $sql = "select * from receiptdetail where IDReceipt = {$id} limit {$start},{$size} ";
        return $this->db->query($sql);
    }

}
