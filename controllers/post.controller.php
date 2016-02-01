<?php

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
        $data = array();
        $r = 1;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "POST") {
            $Title = $_POST['Title'];
            $Content = $_POST['Content'];
            $Slug = $_POST['Slug'];
            $Image = '';
            if (!empty($_FILES["uploadedimage"]["name"])) {
                $file_name = $_FILES["uploadedimage"]["name"];
                $temp_name = $_FILES["uploadedimage"]["tmp_name"];
                $imgtype = $_FILES["uploadedimage"]["type"];
                $target_path = "./img/upload/";
                $file_path = "./img/upload/" . $file_name;
                move_uploaded_file($temp_name, $file_path);
                $Image = $file_name;
            }
            $Status = $_POST['Status'] == 'enable' ? 1 : 0 ;

            $data = array(
                'Title' => $Title,
                'Content' => $Content,
                'Slug' => $Slug,
                'Image' => $Image,
                'Status' => $Status,
                'r' => $r,
            );

            $isAddedPost = $this->model->insert($data, $r);
            if(is_array($isAddedPost)){
                $aTagPost = new TagPost();
                foreach ($_POST['Tags'] as $Tag){
                    $data = array(
                        'IDTag' => $Tag,
                        'IDPost' => $isAddedPost[0]['LastPost']
                    );
                    $isAddedTagPost = $aTagPost->insert($data, $r);
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
            $Image = $post['Image'];
            if (!empty($_FILES["uploadedimage"]["name"])) {
                $file_name = $_FILES["uploadedimage"]["name"];
                $temp_name = $_FILES["uploadedimage"]["tmp_name"];
                $imgtype = $_FILES["uploadedimage"]["type"];
                $target_path = "./img/upload/";
                $file_path = "./img/upload/" . $file_name;
                move_uploaded_file($temp_name, $file_path);
                $Image = $file_name;
            }
            $Status = $_POST['Status'] == 'enable' ? 1 : 0 ;

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
    public function admin_delete(){
        $id = $this->params[0];
        $isDelete = $this->model->delete($id);
        if($isDelete){
            Router::redirect(ADMIN_ROOT . "/post/list/page/1");
        }
        else{
            Session::setFlash("unable to delete user");
        }
    }
}
