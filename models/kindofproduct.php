<?php

class KindOfProduct extends Model {

    var $IDKindOfProduct;
    var $IDCaegoryParent;
    var $Name;
    var $Slug;
    var $OrderKindOfProduct;
    var $Description;

    public function __construct() {
        parent::__construct();
    }

    public function selectAll() {
        $query = "select * from kindofproduct";
        return $this->db->query($query);
    }

    public function selectByIDKindOfProduct($IDKindOfProduct) {
        if ($IDKindOfProduct == null) {
            return null;
        } else {
            $query = "select * from kindofproduct where IDKindOfProduct = {$IDKindOfProduct}";
            return $this->db->query($query);
        }
    }

    public function selectByIDKindOfProductParent($IDKindOfProductParent) {
        $query = "select * from kindofproduct where IDKindOfProductParent = {$IDKindOfProductParent}";
        return $this->db->query($query);
    }

    public function selectByStatus($Status) {
        $query = "select * from kindofproduct where Status = {$Status}";
        return $this->db->query($query);
    }

    public function selectBySlug($Slug) {
        $query = "select * from kindofproduct where Slug = '{$Slug}'";
        return $this->db->query($query);
    }

    public function insert($data, $r) {
        if ($r != 0) {
            $query = "insert into kindofproduct(IDKindOfProductParent, Name, Slug, OrderKindOfProduct, Description, Status) values ({$data['IDKindOfProductParent']},"
                    . "'{$data['Name']}', '{$data['Slug']}', '{$data['OrderKindOfProduct']}', '{$data['Description']}', {$data['Status']})";
            return $this->db->query($query);
        } else {
            throw new Exception("failed to add kindofproduct");
        }
    }

    public function update($data, $r) {
        if ($r != 0) {
            $query = "update kindofproduct set IDKindOfProductParent = {$data['IDKindOfProductParent']}, Name = '{$data['Name']}', Slug = '{$data['Slug']}',"
                    . "OrderKindOfProduct = {$data['OrderKindOfProduct']}, Description = '{$data['Description']}', Status = {$data['Status']} where IDKindOfProduct = {$data['IDKindOfProduct']}";
            return $this->db->query($query);
        } else {
            throw new Exception("failed to update kindofproduct");
        }
    }

    public function delete($data, $r) {
        if ($r != 0) {
            $query = "delete from kindofproduct where IDKindOfProduct = {$data}";
            return $this->db->query($query);
        } else {
            throw new Exception("failed to delete kindofproduct");
        }
    }

    public function countAllKindOfProduct() {
        $sql = "select count(*) as count from kindofproduct";
        $result = $this->db->query($sql);
        return $result[0]['count'];
    }

    public function paginate($page, $size) {
        $start = ($page - 1) * $size;
        $sql = "select * from kindofproduct limit {$start},{$size} ";
        return $this->db->query($sql);
    }

    public function selectAncestorByIDKindOfProduct($IDKindOfProduct) {
        $dataAncestor = array();
        while (true) {
            $data = $this->selectByIDKindOfProduct($IDKindOfProduct);
            $temp = array(
                '$IDKindOfProduct' => $data[0]['IDKindOfProduct'],
                'Name' => $data[0]['Name']
            );
            array_push($dataAncestor, $temp);
            if ($data[0]['IDKindOfProductParent'] == null) {
                break;
            } else {
                $IDKindOfProduct = $data[0]['IDKindOfProductParent'];
            }
        }
        return $dataAncestor;
    }

    public function processAncestorByIDKindOfProduct($IDKindOfProduct) {
        $str = "";
        $data = $this->selectAncestorByIDKindOfProduct($IDKindOfProduct);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            if ($i != 0) {
                $str = $str . $data[$i]['Name'] . " > ";
            } else {
                $str = $str . $data[$i]['Name'];
            }
        }
        return $str;
    }

    public function selectFormalNameByStatus($Status) {
        $data = $this->selectByStatus($Status);
        $dataName = array();
        foreach ($data as $temp) {
            $dataTemp = array(
                'IDKindOfProduct' => $temp['IDKindOfProduct'],
                'Name' => $this->processAncestorByIDKindOfProduct($temp['IDKindOfProduct'])
            );
            array_push($dataName, $dataTemp);
        }
        return $dataName;
    }

    public function getIDKindOfProduct() {
        return $this->IDKindOfProduct;
    }

    public function getIDCaegoryParent() {
        return $this->IDCaegoryParent;
    }

    public function getName() {
        return $this->Name;
    }

    public function getSlug() {
        return $this->Slug;
    }

    public function getOrderKindOfProduct() {
        return $this->OrderKindOfProduct;
    }

    public function getDescription() {
        return $this->Description;
    }

    public function setIDKindOfProduct($IDKindOfProduct) {
        $this->IDKindOfProduct = $IDKindOfProduct;
    }

    public function setIDCaegoryParent($IDCaegoryParent) {
        $this->IDCaegoryParent = $IDCaegoryParent;
    }

    public function setName($Name) {
        $this->Name = $Name;
    }

    public function setSlug($Slug) {
        $this->Slug = $Slug;
    }

    public function setOrderKindOfProduct($OrderKindOfProduct) {
        $this->OrderKindOfProduct = $OrderKindOfProduct;
    }

    public function setDescription($Description) {
        $this->Description = $Description;
    }

}
