<?php

class TagPostController extends Controller {

    public function __construct($data = array()) {
        parent::__construct($data);
        $this->model = new TagPost();
    }

    public function admin_list() {
        $currentPage = $this->params[1];
        if (!$currentPage) {
            $currentPage = 1;
        }
        $maxSize = 10;
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
        $this->data['item'] = $this->model->paginateJoin($currentPage, $maxSize);
//        echo '<pre>';
//        print_r($this->data['item']);
//        echo '</pre>';
//        die;
        $this->data['currentPage'] = $currentPage;
    }

    public function getTag($idPost) {
        return $this->model->selectByIDPost($idPost);
    }

}
