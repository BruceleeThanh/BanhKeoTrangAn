<?php

class KindOfProduct_Product extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert($data, $r) {
        if ($r != 0) {
            $query = "insert into kindofproduct_product (IDKindOfProduct,IDProduct) values ({$data['IDKindOfProduct']},{$data['IDProduct']})";
            return $this->db->query($query);
        } else {
            throw new Exception("failed to insert kop");
        }
    }

    public function update($data, $r) {
        if ($r != 0) {
            $query = "update kindofproduct_product set IDKindOfProduct = {$data['IDKindOfProduct']} , IDProduct = {$data['IDProduct']} where IDProduct = {$data['IDProduct']} ";
            return $this->db->query($query);
        } else {
            throw new Exception("failed to update kop");
        }
    }

    public function deleteByIDProduct($id) {
        $query = "delete from kindofproduct_product where IDProduct = '{$id}' ";
        return $this->db->query($query);
    }

    public function selectAll() {
        $query = "select * from kindofproduct_product";
        $this->db->query($query);
    }

    public function selectByID($id) {
        $query = "select * from kindofproduct_product where IDKindOfProduct = '{$id}' ";
        $id = $this->db->query($query);
        return $id[0];
    }
    
    public function selectIDProductByIDKindOfProduct($id) {
        $query = "select IDProduct from kindofproduct_product where IDKindOfProduct = {$id} ";
        return $this->db->query($query);
    }

    /**
     * Function to get Name kind of product by $IDProduct
     * 
     * @param int $IDKindOfProduct
     *
     * @return record
     */
    public function getProductNameByKind($IDProduct) {
        try {
            $query = "select * from "
                    . "(select kindofproduct.Name,kindofproduct_product.IDProduct from kindofproduct inner join kindofproduct_product on kindofproduct.IDKindOfProduct = kindofproduct_product.IDKindOfProduct)AS T "
                    . "where T.IDProduct = {$IDProduct}";
            return $this->db->query($query);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
    
    public function selectIDKindOfProductByIDProduct($IDProduct) {
        try {
            $query = "select IDKindOfProduct from kindofproduct_product where IDProduct = {$IDProduct}";
            return $this->db->query($query);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function countAllRecord() {
        $query = "select count(*) as count from kindofproduct_product";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function paginate($page, $size) {
        $start = ($page - 1) * $size;
        $query = "select * from kindofproduct_product limit {$start},{$size} ";
        return $this->db->query($query);
    }

}
