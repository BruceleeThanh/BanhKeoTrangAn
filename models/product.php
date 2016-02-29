<?php

class Product extends Model {

    public $id;

    public function __construct() {
        parent::__construct();
        $this->id = 1;
    }

    public function insert($data, $r) {
        if ($r != 0) {
            $sql = "insert into product(Name,Slug,Model,UnitPrice,Image,Description,Rate,RatePeople,Status) values ('{$data['Name']}','{$data['Slug']}','{$data['Model']}',"
                    . "'{$data['UnitPrice']}','{$data['Image']}','{$data['Description']}','{$data['Rate']}','{$data['RatePeople']}','{$data['Status']}')";
            $this->db->query($sql);
            $query = "select LAST_INSERT_ID() as LastPost";

            $result = $this->db->query($query);
            $this->id = $result[0]['LastPost'];
            return $result;
        } else {
            throw new Exception("Failed to insert product");
        }
    }

    public function update($data, $r) {
        if ($r != 0) {
            $sql = "update product set Name = '{$data['Name']}' , Slug = '{$data['Slug']}', Model = '{$data['Model']}',"
                    . "UnitPrice = '{$data['UnitPrice']}', Image = '{$data['Image']}', Description = '{$data['Description']}',Rate = '{$data['Rate']}',"
                    . "RatePeople = '{$data['RatePeople']}',Status = '{$data['Status']}' "
                    . "where IDProduct = '{$data['id']}' ";

            return $this->db->query($sql);
        } else {
            throw new Exception("failed to edit user");
        }
    }

    public function delete($id) {
        $sql = "delete from product where IDProduct = '{$id}' ";
        return $this->db->query($sql);
    }

    public function countAllRecord() {
        $query = "select count(*) as count from product";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function countAllRecordEnable() {
        $query = "select count(*) as count from product where Status = 1";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function paginate($page, $size) {
        $start = ($page - 1) * $size;
        $sql = "select * from product limit {$start},{$size} ";
        return $this->db->query($sql);
    }

    public function selectBySlugKindOfProduct($slug) {
        $result = [];
        $kindofproduct = new KindOfProduct();
        $kindofproduct_product = new KindOfProduct_Product();
        $temp = $kindofproduct->selectBySlug($slug);
        $temp = $kindofproduct_product->selectIDProductByIDKindOfProduct($temp[0]['IDKindOfProduct']);
        foreach ($temp as $item) {
            $sql = "select * from product where IDProduct = {$item['IDProduct']}";
            array_push($result, $this->db->query($sql)[0]);
        }

        return $result;
    }

    public function paginateJoin($page, $size) {
        $start = ($page - 1) * $size;
        $query = "select product.*, productdetail.Image,productdetail.Caption "
                . "from product inner join productdetail on product.IDProduct = productdetail.IDProduct and "
                . "product.Status = 1 limit {$start},{$size} ";
        return $this->db->query($query);
    }

    public function selectAll() {
        $query = "select * from product ";
        return $this->db->query($query);
    }

    public function search($Name) {
        $query = "select * from product where Name like '%$Name%' ";
        return $this->db->query($query);
    }

    public function selectByStatus($Status) {
        $count = $this->countAllRecordEnable();
        if (((int) $count % 3) == 1) {
            $count--;
        } else {
            if (((int) $count % 3) == 2) {
                $count-=2;
            }
        }
        $query = "select * from product where Status = {$Status} limit 0, $count";
        return $this->db->query($query);
    }

    public function selectByIDProduct($id) {
        $query = "select * from product where IDProduct = '{$id}' ";
        $id = $this->db->query($query);
        return $id;
    }

    public function selectBySlug($Slug) {
        $query = "select * from product where Slug = '{$Slug}' ";
        $id = $this->db->query($query);
        return $id;
    }

    public function selectIDBySlug($Slug) {
        $query = "select IDProduct from product where Slug = '{$Slug}' ";
        $id = $this->db->query($query);
        return $id;
    }

    public function selectByIDStatus($id, $Status) {
        $query = "select * from product where IDProduct = '{$id}' and Status = {$Status} ";
        $id = $this->db->query($query);
        return $id;
    }

    public function selectAll_Limit($limit) {
        $query = "select * from product limit {$limit}";
        return $this->db->query($query);
    }

    public function getLastID() {
        return $this->id;
    }

}
