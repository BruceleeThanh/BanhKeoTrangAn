<?php

include_once '../models/tagproduct.php';
include_once '../models/productdetail.php';
include_once '../models/kindofproduct_product.php';
include_once '../models/kindofproduct.php';

class ProductController extends Controller {

    public function __construct($data = array()) {
        parent::__construct($data);
        $this->model = new Product();
    }

    public function index() {
        $this->data['categoryLeftbar'] = $this->categoryLeftbar();
        $this->data['kindofproductLeftbar'] = $this->kindofproductLeftbar();
        $currentPage = $this->params[1];
        if (!$currentPage) {
            $currentPage = 1;
        }
        $maxSize = 9;
        $maxShowPaging = 10;
        $countRecord = intval($this->model->countAllRecordEnable());
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

    public function kindofproduct() {
        $this->data['categoryLeftbar'] = $this->categoryLeftbar();
        $this->data['kindofproductLeftbar'] = $this->kindofproductLeftbar();
        $slugKindOfProduct = $this->params[0];
        $currentPage = $this->params[2];
        if (!$currentPage) {
            $currentPage = 1;
        }
        $maxSize = 9;
        $maxShowPaging = 10;
        $countRecord = intval($this->model->countAllRecordEnable());
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

        $this->data['slugPage'] = $slugKindOfProduct;
        $this->data['totalPage'] = $totalPage;
        $this->data['paging'] = $paging;
        $this->data['item'] = $this->kindofproductShow($slugKindOfProduct, $currentPage, $maxSize);
        $this->data['currentPage'] = $currentPage;
    }

    public function detail() {
        $productDetail = new ProductDetail();
        $Slug = $this->params[0];
        $this->data['categoryLeftbar'] = $this->categoryLeftbar();
        $this->data['kindofproductLeftbar'] = $this->kindofproductLeftbar();
        $homeController = new HomeController();
        $this->data['recommend'] = $homeController->showProduct();
        $this->data['product'] = $this->model->selectBySlug($Slug);
        $this->data['item'] = $productDetail->selectByIDProduct($this->model->selectIDBySlug($Slug)[0]['IDProduct']);
        $tagModel = new TagProduct();

        $exp = explode("-", $Slug);
        $id = end($exp); //get last element in array
        $tag_product = $tagModel->selectByIDProduct($id);

        if ($tag_product !== null) {
            $tagModel = new Tag();
            foreach ($tag_product as $key => $value) {
                $this->data['tag'] = $tagModel->selectByIdStatus($value['IDTag'], 1);
            }
        }
//         checkData($this->data['tag']);
    }

    public function categoryLeftbar() {
        $category = new Category();
        $data = $category->selectByStatus(1);
        $result = $this->createCategoryNested($data);
        return $result;
    }

    public function kindofproductShow($slugKindOfProduct, $currentPage, $maxSize) {
        $result = [];
        $start = ($currentPage - 1) * $maxSize;
        $input = $this->model->selectBySlugKindOfProduct($slugKindOfProduct);
        for ($i = $start; $i < $start + $maxSize; $i++) {
            if (isset($input[$i]))
                array_push($result, $input[$i]);
        }
        return $result;
    }

    function createCategoryNested($categories, $parentId = null) {
        $results = [];
        foreach ($categories as $category) {
            if ($parentId == $category['IDCategoryParent']) {
                $nextParentId = $category['IDCategory'];
                $category['children'] = $this->createCategoryNested($categories, $nextParentId);
                $results[] = $category;
            }
        }
        return $results;
    }

    public function kindofproductLeftbar() {
        $kindofproduct = new KindOfProduct();
        $data = $kindofproduct->selectByStatus(1);
        $result = $this->createKindOfProductNested($data);
        return $result;
    }

    function createKindOfProductNested($kindofproduct, $parentID = null) {
        $results = [];
        foreach ($kindofproduct as $item) {
            if ($parentID == $item['IDKindOfProductParent']) {
                $nextParentID = $item['IDKindOfProduct'];
                $item['children'] = $this->createKindOfProductNested($kindofproduct, $nextParentID);
                $results[] = $item;
            }
        }
        return $results;
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
        $this->data['item'] = $this->model->paginate($currentPage, $maxSize);

        $this->data['currentPage'] = $currentPage;
    }

    public function admin_add() {
        $aTag = new Tag();
        $this->data['listTag'] = $aTag->selectAll();
        $aKindOfProduct = new KindOfProduct();
        $listKop = $aKindOfProduct->selectAll();
        $this->data['listKop'] = $aKindOfProduct->selectFormalNameByStatus(1);
        $aKindOfProduct_Product = new KindOfProduct_Product();
        $data = array();
        $r = 1;

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "POST") {


            $Name = $_POST['Name'];
            $Slug = strval($_POST['Slug']);
            $Model = $_POST['Model'];
            $UnitPrice = $_POST['UnitPrice'];
            $Description = $_POST['Description'];
            $Image = $_POST['uploadedimage'];
            $Rate = $_POST['Rate'];
            $RatePeople = $_POST['RatePeople'];
            $Status = $_POST['Status'] == 'enable' ? 1 : 0;
            $data = array(
                'Name' => $Name,
                'Slug' => $Slug,
                'Model' => $Model,
                'UnitPrice' => $UnitPrice,
                'Description' => $Description,
                'Image' => $Image,
                'Rate' => $Rate,
                'RatePeople' => $RatePeople,
                'Status' => $Status,
                'r' => $r,
            );
            $isAdded = $this->model->insert($data, $r);
            if (is_array($isAdded)) {
                $ExtraSlugID = strval($this->model->getLastID());
                $SlugExt = strval(trim($Slug . "-" . $ExtraSlugID));
//                var_dump($SlugExt);
//                die;
                $dataUpdate = array(
                    'id' => intval($ExtraSlugID),
                    'Name' => $Name,
                    'Slug' => $SlugExt,
                    'Model' => $Model,
                    'UnitPrice' => $UnitPrice,
                    'Description' => $Description,
                    'Image' => $Image,
                    'Rate' => $Rate,
                    'RatePeople' => $RatePeople,
                    'Status' => $Status,
                    'r' => $r,
                );

                $isUpdate = $this->model->update($dataUpdate, $r);

                $aTag = new TagProduct();
                foreach ($_POST['Tags'] as $Tag) {
                    $data = array(
                        'IDTag' => $Tag,
                        'IDProduct' => $isAdded[0]['LastPost']
                    );
                    $isAddedTagProduct = $aTag->insert($data, $r);
                }
                $aKindOfProduct_Product = new KindOfProduct_Product();

                foreach ($_POST['Kop'] as $row) {
                    $data = array(
                        'IDKindOfProduct' => $row,
                        'IDProduct' => $isAdded[0]['LastPost'],
                    );
                    $isAddedKopProduct = $aKindOfProduct_Product->insert($data, $r);
                }

                Router::redirect(ADMIN_ROOT . "/product/list/page/1");
            }
        }
    }

    public function admin_edit() {
        $id = $this->params[0];
        $item = $this->model->selectByIDProduct($id);
        $this->data['item'] = $item;

        $aTagProduct = new TagProduct();
        $aTag = new Tag();
        $aKindOfProduct = new KindOfProduct();
        $listKop = $aKindOfProduct->selectAll();
        $this->data['listKop'] = $aKindOfProduct->selectFormalNameByStatus(1);

        $aKindOfProduct_Product = new KindOfProduct_Product();
        $this->data['listKopExist'] = $aKindOfProduct_Product->getProductNameByKind(intval($id));

        $IDByProduct = $aTagProduct->selectByIDProduct($id);

        if (!empty($IDByProduct)) {
            $IDTag = intval($IDByProduct[0]['IDTag']);
            $TagEN = $aTag->selectByIdStatus($IDTag, 1);
        } else {
            $TagEN = array(
                0 => array(
                    'IDTag' => '',
                    'Name' => '',
                )
            );
        }
        $this->data['listTagExist'] = $TagEN;
        $this->data['listTag'] = $aTag->selectAll();

        $data = array();
        $r = 1;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "POST") {
            $valid_formats = array("jpg", "png", "gif", "zip", "bmp");
            $max_file_size = 1024 * 300; //300 kb
            $path = "./img/upload/"; // Upload directory

            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == "POST") {
                $Name = $_POST['Name'];
                $Slug = $_POST['Slug'];
                $Model = $_POST['Model'];
                $UnitPrice = $_POST['UnitPrice'];
                $Description = $_POST['Description'];
                $Image = $_POST['uploadedimage'];
                $Rate = $_POST['Rate'];
                $RatePeople = $_POST['RatePeople'];
                $Status = $_POST['Status'];
                $data = array(
                    'id' => $id,
                    'Name' => $Name,
                    'Slug' => $Slug,
                    'Model' => $Model,
                    'UnitPrice' => $UnitPrice,
                    'Description' => $Description,
                    'Image' => $Image,
                    'Rate' => $Rate,
                    'RatePeople' => $RatePeople,
                    'Status' => $Status,
                    'r' => $r,
                );

                $isEdit = $this->model->update($data, $r);
                if ($isEdit) {

                    foreach ($_POST['Tags'] as $Tag) {
                        $dataEdit = array(
                            'IDTag' => intval($Tag),
                            'IDProduct' => $id,
                            'r' => $r,
                        );
                        $isEditTag = $aTagProduct->update($dataEdit, $r);
                    }
                    if (!$isEditTag) {
                        Session::setFlash("unable to update tag_product");
                    }
                    foreach ($_POST['Kop'] as $row) {
                        $data = array(
                            'IDKindOfProduct' => $row,
                            'IDProduct' => $this->params[0],
                        );
                        $isAddedKopProduct = $aKindOfProduct_Product->update($data, $r);
                        if (!$isAddedKopProduct) {
                            Session::setFlash("unable to update kindofproduct_product");
                        }
                    }
                    Router::redirect(ADMIN_ROOT . "/product/list/page/1");
                }
            }
        }
    }

    public function admin_delete() {
        $id = $this->params[0];
        $isDelete = $this->model->delete($id);
        if ($isDelete) {
            Router::redirect(ADMIN_ROOT . "/product/list/page/1");
        } else {
            Session::setFlash("unable to delete product");
        }
    }

    /* Detail  */

    public function admin_detail() {
        $ProductDetail = new ProductDetail();
        $idProduct = intval($this->params[0]);

        $currentPage = intval($this->params[2]);

        if (!$currentPage) {
            $currentPage = 1;
        }
        $maxSize = 5;
        $maxShowPaging = 10;
        $countRecord = intval($ProductDetail->countRecordWithID($idProduct));
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
        $this->data['item'] = $ProductDetail->paginateByIDProduct($idProduct, $currentPage, $maxSize);
        $this->data['params'] = $this->params[0];
        $this->data['currentPage'] = $currentPage;
    }

    public function admin_AddDetail() {
        $idProduct = intval($this->params[0]);
        $id = $this->params[0];
        $ProductDetailModel = new ProductDetail();
        $this->data['ProductName'] = $this->model->selectByIDProduct($id);

        $r = 1;
        $data = array();

        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
            $IDProduct = $idProduct;
            $Caption = $_POST['Caption'];
            $Image = $_POST['uploadedimage'];
            $data = array(
                'IDProduct' => $IDProduct,
                'Image' => $Image,
                'Caption' => $Caption,
                'r' => $r,
            );
            $isInsert = $ProductDetailModel->insert($data, $r);
            if (!$isInsert) {
                Session::setFlash("$Image can't insert");
            }
            Router::redirect(ADMIN_ROOT . "/product/detail/{$id}/page/1");
        }
    }

    public function admin_EditDetail() {
        $idProduct = intval($this->params[0]);
        $id = $this->params[0];
        $this->data['ProductName'] = $this->model->selectByIDProduct($id);
        $ProductDetailModel = new ProductDetail();
        // id productdetail
        $IDProductDetail = $this->params[2];
        $this->data['ProductDetail'] = $ProductDetailModel->selectByID($IDProductDetail);

        $data = array();

        $r = 1;
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
            $IDProduct = $idProduct;
            $Caption = $_POST['Caption'];
            $Image = $_POST['uploadedimage'];
            $data = array(
                'IDProductDetail' => $IDProductDetail,
                'IDProduct' => $IDProduct,
                'Image' => $Image,
                'Caption' => $Caption,
                'r' => $r,
            );
            $isUpdate = $ProductDetailModel->update($data, $r);
            if (!$isUpdate) {
                Session::setFlash("$Image can't update");
            }
            $count++; // Number of successfully uploaded file
            Router::redirect(ADMIN_ROOT . "/product/detail/{$id}/page/1");
        }
    }

//    public function admin_EditDetail() {
//        $IdProductDetail = intval(($this->params[2]));
//        $ProductDetailModel = new ProductDetail();
//        $ProductDetailEN = $ProductDetailModel->selectByID($IdProductDetail);
//        $this->data['ProductName'] = $this->model->selectByID($this->params[0]);
//        $IDProduct = $ProductDetailEN[0]['IDProduct'];
//
//        $data = array();
//        die;
//        $valid_formats = array("jpg", "png", "gif", "zip", "bmp");
//        $max_file_size = 1024 * 300; //300 kb
//        $path = "./img/upload/"; // Upload directory
//        $count = 0;
//        $r = 1;
//        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
//            $IDProduct = $idProduct;
//            $Caption = $_POST['Caption'];
//            // Loop $_FILES to exeicute all files
//            foreach ($_FILES['files']['name'] as $f => $name) {
//                if ($_FILES['files']['error'][$f] == 4) {
//                    continue; // Skip file if any error found
//                }
//                if ($_FILES['files']['error'][$f] == 0) {
//                    if ($_FILES['files']['size'][$f] > $max_file_size) {
//                        Session::setFlash("$name is too large!.");
//                        $r = 0;
//                        continue; // Skip large files
//                    } elseif (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats)) {
//                        Session::setFlash("$name is not a valid format");
//                        $r = 0;
//                        continue; // Skip invalid file formats
//                    } else { // No error found! Move uploaded files 
//                        if (move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path . $name)) {
//
//                            $data = array(
//                                'id' => $ProductDetailEN[0]['IDProductDetail'],
//                                'IDProduct' => $IDProduct,
//                                'Image' => $name,
//                                'Caption' => $Caption,
//                                'r' => $r,
//                            );
//                            $isInsert = $ProductDetailModel->update($data, $r);
//                            if (!$isInsert) {
//                                Session::setFlash("$name can't insert");
//                            }
//
//                            $count++; // Number of successfully uploaded file
//                            Router::redirect(ADMIN_ROOT . "/product/detail/{$IDProduct}/page/1");
//                        }
//                    }
//                }
//            }
//        }
//    }

    public function admin_DeleteDetail() {
        $IdProductDetail = intval($this->params[2]);
        $ProductDetailModel = new ProductDetail();
        $ProductDetailEN = $ProductDetailModel->selectByIDProduct($IdProductDetail);
        $IDProduct = $ProductDetailEN[0]['IDProduct'];
        $isDelete = $ProductDetailModel->delete($IdProductDetail);
        if ($isDelete) {
            Router::redirect(ADMIN_ROOT . "/product/detail/{$IDProduct}/page/1");
        } else {
            Session::setFlash("unable to delete detail product");
        }
    }

}
