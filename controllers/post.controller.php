<?php

include_once '../models/productdetail.php';

class PostController extends Controller {

    public function __construct($data = array()) {
        parent::__construct($data);
        $this->model = new Post();
    }

    public function admin_list() {
        $currentPage = $this->params[1];
        if (!$currentPage) {
            $currentPage = 1;
        }
        $maxSize = 5;
        $maxShowPaging = 10;
        $countPost = intval($this->model->countAllPost());
        $totalPage = ceil($countPost / $maxSize);
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
        $this->data['lstPosts'] = $this->model->paginate($currentPage, $maxSize);
        $this->data['currentPage'] = $currentPage;
    }

    public function admin_add() {
        $aTag = new Tag();
        $this->data['listTag'] = $aTag->selectByStatus(1);
        $aCategory = new Category();
        $this->data['listCategory'] = $aCategory->selectFormalNameByStatus(1);
        $data = array();
        $r = 1;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "POST") {
            $Title = $_POST['Title'];
            $Content = $_POST['Content'];
            $Slug = $_POST['Slug'];
            $Image = $_POST['uploadedimage'];

            $Status = $_POST['Status'] == 'enable' ? 1 : 0;

            $data = array(
                'Title' => $Title,
                'Content' => $Content,
                'Slug' => $Slug,
                'Image' => $Image,
                'Status' => $Status,
                'r' => $r,
            );

            $isAddedPost = $this->model->insert($data, $r);
            if (is_array($isAddedPost)) {
                $aTagPost = new TagPost();
                foreach ($_POST['Tags'] as $Tag) {
                    $data = array(
                        'IDTag' => $Tag,
                        'IDPost' => $isAddedPost[0]['LastPost']
                    );
                    $isAddedTagPost = $aTagPost->insert($data, $r);
                }

                $aCategoryPost = new CategoryPost();
                foreach ($_POST['Categories'] as $Category) {
                    $data = array(
                        'IDCategory' => $Category,
                        'IDPost' => $isAddedPost[0]['LastPost']
                    );
                    $isAddedCategoryPost = $aCategoryPost->insert($data, $r);
                }
                Router::redirect(ADMIN_ROOT . "/post/list/page/1");
            }
        }
    }

    public function admin_edit() {
        $id = $this->params[0];
        $post = $this->model->selectByID($id);
        $this->data['post'] = $post;

        $data = array();
        $r = 1;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "POST") {
            $Title = $_POST['Title'];
            $Content = $_POST['Content'];
            $Slug = $_POST['Slug'];
            $Image = $_POST['uploadedimage'];
            $Status = $_POST['Status'] == 'enable' ? 1 : 0;

            $data = array(
                'id' => $id,
                'Title' => $Title,
                'Content' => $Content,
                'Slug' => $Slug,
                'Image' => $Image,
                'Status' => $Status,
                'r' => $r,
            );

            $isAdded = $this->model->update($data, $r);
            if ($isAdded) {
                Router::redirect(ADMIN_ROOT . "/post/list/page/1");
            }
        }
    }

    public function admin_delete() {
        $id = $this->params[0];
        $isDelete = $this->model->delete($id);
        if ($isDelete) {
            Router::redirect(ADMIN_ROOT . "/post/list/page/1");
        } else {
            Session::setFlash("unable to delete user");
        }
    }

    //
    public function index() {
        $homeController = new HomeController();
        // kind of product 
        $this->data['kindofproductLeftbar'] = $homeController->kindofproductLeftbar();
        // category
        $this->data['categoryLeftbar'] = $homeController->categoryLeftbar();
        // post
        $currentPage = $this->params[1];
        if (!$currentPage) {
            $currentPage = 1;
        }
        $maxSize = 3;
        $maxShowPaging = 10;
        $countPost = intval($this->model->countAllPost());
        $totalPage = ceil($countPost / $maxSize);
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
        $this->data['lstPosts'] = $this->model->paginate($currentPage, $maxSize);
        $this->data['currentPage'] = $currentPage;
    }

    public function detail() {
        $homeController = new HomeController();
        // kind of product 
        $this->data['kindofproductLeftbar'] = $homeController->kindofproductLeftbar();
        // category
        $this->data['categoryLeftbar'] = $homeController->categoryLeftbar();
        // post detail
        $idPost = $this->params[0];
        $exp = explode("-", $idPost);
        $idPost = end($exp); //get last element in array

        $this->data['post'] = $this->model->selectByID($idPost);
        // tag post
        $tagPostController = new TagPostController();
        $tagPost = $tagPostController->getTag($idPost);
        $IdTag = array();
        foreach ($tagPost as $key => $value) {
            $IdTag[] = $value['IDTag'];
        }
        $tagController = new TagController();
        $listTagName = $tagController->getTag($IdTag);

        $this->data['tag'] = $listTagName;
    }

    public function kindofpost() {
        $slugKindOfPost = $this->params[0];
        $exp = explode("-", $slugKindOfPost);
        $idPost = end($exp); //get last element in array

        $homeController = new HomeController();
        // kind of product 
        $this->data['kindofproductLeftbar'] = $homeController->kindofproductLeftbar();
        // category
        $this->data['categoryLeftbar'] = $homeController->categoryLeftbar();

        $currentPage = $this->params[2];
        if (!$currentPage) {
            $currentPage = 1;
        }
        $maxSize = 9;
        $maxShowPaging = 10;
        $countRecord = intval($this->model->countAllPost_id($idPost));
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

        $this->data['slugPage'] = $slugKindOfPost;
        $this->data['totalPage'] = $totalPage;
        $this->data['paging'] = $paging;
        $this->data['lstPosts'] = $this->model->paginate_id($idPost, $currentPage, $maxSize);
        $this->data['currentPage'] = $currentPage;
    }

}
