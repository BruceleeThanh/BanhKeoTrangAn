<?php

class Tag extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function selectAll() {
        $query = "select * from tag ";
        return $this->db->query($query);
    }

    public function selectByIdStatus($id, $Status) {
        $query = "select * from tag where Status = {$Status} and IDTag = '{$id}' ";
        return $this->db->query($query);
    }

    public function selectByStatus($Status) {
        $query = "select * from tag where Status = {$Status}";
        return $this->db->query($query);
    }

    public function selectByID($id) {
        $query = "select * from tag where IDTag = '{$id}' ";
        $id = $this->db->query($query);
        return $id[0];
    }

    public function selectIdInArray($array = array()) {
        $sql = "SELECT * FROM tag WHERE IDTag IN ('" . implode(',', array_map('intval', $array)) . "')";
        return $this->db->query($sql);
    }

    public function countAllRecord() {
        $query = "select count(*) as count from tag";
        $result = $this->db->query($query);
        return $result[0]['count'];
    }

    public function paginate($page, $size) {
        $start = ($page - 1) * $size;
        $sql = "select * from tag limit {$start},{$size} ";
        return $this->db->query($sql);
    }

    public function insert($data, $r) {
        if ($r != 0) {
            $query = "insert into tag(Name,Slug,Description,Status) values ('{$data['Name']}','{$data['Slug']}','{$data['Description']}','{$data['Status']}')";
            return $this->db->query($query);
        } else {
            throw new Exception("failed to insert tag");
        }
    }

    public function update($data, $r) {
        if ($r != 0) {
            $sql = "update tag set Name = '{$data['Name']}' , Slug = '{$data['Slug']}', Description = '{$data['Description']}', Status = '{$data['Status']}' "
                    . "where IDTag = '{$data['IDTag']}' ";
            return $this->db->query($sql);
        } else {
            throw new Exception("failed to edit tag");
        }
    }

    public function delete($id) {
        $sql = "delete from tag where IDTag = '{$id}' ";
        return $this->db->query($sql);
    }

}
