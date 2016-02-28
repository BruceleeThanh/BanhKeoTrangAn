<?php

class TagController extends Controller {

    public function __construct($data = array()) {
        parent::__construct($data);
        $this->model = new Tag();
    }

    public function admin_list() {
        $currentPage = $this->params[1];
        if (!$currentPage) {
            $currentPage = 1;
        }
        $maxSize = 5;
        $maxShowPaging = 10;
        $countRecord = intval($this->model->countAllRecord());
        $totalPage = ceil($countRecord / $maxSize);
        $paging = array();
        $i = 1;
        if ($currentPage >= $maxShowPaging) {
            do {
                $i = $i + $maxShowPaging - 1;
            } while ($i + $maxShowPaging - 1 <= $currentPage);
        }
        for (; $i <= $totalPage; $i++) {
            if (count($paging) >= $maxShowPaging) {
                break;
            }
            $paging[] = $i;
        }
        $this->data['totalPage'] = $totalPage;
        $this->data['paging'] = $paging;
        $this->data['lstTag'] = $this->model->paginate($currentPage, $maxSize);
        $this->data['currentPage'] = $currentPage;
    }

    public function admin_add() {
        $data = array();
        $r = 1;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "POST") {
            $Name = $_POST['Name'];
            $Slug = $_POST['Slug'];
            $Description = $_POST['Description'];
            $Status = $_POST['Status'] == 'enable' ? 1 : 0;
            $data = array(
                'Name' => $Name,
                'Slug' => $Slug,
                'Description' => $Description,
                'Status' => $Status,
                'r' => $r,
            );

            $isAdded = $this->model->insert($data, $r);
            if ($isAdded) {
                Router::redirect(ADMIN_ROOT . "/tag/list/page/1");
            }
        }
    }

    public function admin_edit() {
        $id = $this->params[0];
        $item = $this->model->selectByID($id);
        $this->data['item'] = $item;

        $data = array();
        $r = 1;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "POST") {
            $Name = $_POST['Name'];
            $Slug = $_POST['Slug'];
            $Description = $_POST['Description'];
            $Status = $_POST['Status'] == 'enable' ? 1 : 0;
            $data = array(
                'IDTag' => $id,
                'Name' => $Name,
                'Slug' => $Slug,
                'Description' => $Description,
                'Status' => $Status,
                'r' => $r,
            );

            $isEdit = $this->model->update($data, $r);
            if ($isEdit) {
                Router::redirect(ADMIN_ROOT . "/tag/list/page/1");
            }
        }
    }

    public function admin_delete() {
        $id = $this->params[0];
        $isDelete = $this->model->delete($id);
        if ($isDelete) {
            Router::redirect(ADMIN_ROOT . "/tag/list/page/1");
        } else {
            Session::setFlash("unable to delete tag");
        }
    }

    public function getTag($IDTagArray) {
        return $this->model->selectIdInArray($IDTagArray);
    }

}
