<?php

include_once '../models/receiptdetail.php';

class ReceiptController extends Controller {

    public function __construct($data = array()) {
        parent::__construct($data);
        $this->model = new Receipt();
    }

    public function admin_index() {
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
        $this->data['item'] = $this->model->paginate($currentPage, $maxSize);
        $this->data['currentPage'] = $currentPage;
    }

    public function admin_detail() {
        $receiptDetailModel = new ReceiptDetail();
        $idReceipt = intval($this->params[0]);

        $currentPage = intval($this->params[2]);

        if (!$currentPage) {
            $currentPage = 1;
        }
        $maxSize = 10;
        $maxShowPaging = 10;
        $countRecord = intval($receiptDetailModel->selectByIDReceipt($idReceipt));
        $totalPage = ceil($countRecord / $maxSize);
        if ($totalPage == 0) {
            $totalPage = 1;
        }
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
        $this->data['item'] = $receiptDetailModel->paginate($idReceipt,$currentPage, $maxSize);
        $this->data['params'] = $this->params[0];
        $this->data['currentPage'] = $currentPage;
    }

}
