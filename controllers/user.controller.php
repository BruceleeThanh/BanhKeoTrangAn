<?php

class UserController extends Controller {

    public function __construct($data = array()) {
        parent::__construct($data);
        $this->model = new User();
    }

    public function admin_list() {
        $currentPage = $this->params[1];
        if (!$currentPage) {
            $currentPage = 1;
        }
        $maxSize = 5;
        $maxShowPaging = 10;
        $countUsers = intval($this->model->countAllUser());
        $totalPage = ceil($countUsers / $maxSize);
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
        $this->data['lstUsers'] = $this->model->paginate($currentPage, $maxSize);
        $this->data['currentPage'] = $currentPage;
    }

    public function admin_add() {
        $data = array();
        $r = 1;
        if ($_POST) {
            $Name = $_POST['Name'];
            $Name = validateName($Name);
            if (!$Name) {
                $r = 0;
            }
            $Password = md5(Config::get('salt') . $_POST['Password']);
            $Fullname = $_POST['Fullname'];
            $Gender = $_POST['Gender'];
            $Birthday = $_POST['Birthday'];
            $Address = $_POST['Address'];
            $Email = validateEmail($_POST['Email']);
            if (!$Email) {
                $r = 0;
            }
//            $Name = $this->model->selectByName($Name);
//            if($Name){
//                // Name exist
//                $error = "Name exist";
//                $r = 0;
//            }
            $PhoneNumber = $_POST['PhoneNumber'];
            $Status = $_POST['Status'];

            $data = array(
                'Name' => $Name,
                'Password' => $Password,
                'Fullname' => $Fullname,
                'Gender' => $Gender,
                'Birthday' => $Birthday,
                'Address' => $Address,
                'Email' => $Email,
                'PhoneNumber' => $PhoneNumber,
                'Status' => $Status,
                'r' => $r
            );

            $isAdd = $this->model->add($data, $r);
            if ($isAdd) {
                Router::redirect(ADMIN_ROOT . "/user/list/page/1");
            }
        }
    }

    public function admin_edit() {
        $data = array();
        $r = 1;
        $id = $this->params[0];
        $this->data['user'] = $this->model->selectByID($id);

        if ($_POST) {
            $Name = $_POST['Name'];
            $Name = validateName($Name);
            if (!$Name) {
                $r = 0;
            }
//            $Name = $this->model->selectByName($Name);
//            if($Name){
//                // Name exist
//                $error = "Name exist";
//                $r = 0;
//            }
            $Password = md5(Config::get('salt') . $_POST['Password']);
            $Fullname = $_POST['Fullname'];
            $Gender = $_POST['Gender'];
            $Birthday = $_POST['Birthday'];
            $Address = $_POST['Address'];
            $Email = validateEmail($_POST['Email']);
            if (!$Email) {
                $r = 0;
            }
            $PhoneNumber = $_POST['PhoneNumber'];
            $Status = $_POST['Status'];

            $data = array(
                'id' => $id,
                'Name' => $Name,
                'Password' => $Password,
                'Fullname' => $Fullname,
                'Gender' => $Gender,
                'Birthday' => $Birthday,
                'Address' => $Address,
                'Email' => $Email,
                'PhoneNumber' => $PhoneNumber,
                'Status' => $Status,
                'r' => $r
            );

            $isAdd = $this->model->edit($data, $r);
            if ($isAdd) {
                Router::redirect(ADMIN_ROOT . "/user/list/page/1");
            }
        }
    }

    public function admin_delete() {
        $id = $this->params[0];
        $isDelete = $this->model->delete($id);
        if ($isDelete) {
            Router::redirect(ADMIN_ROOT . "/user/list/page/1");
        } else {
            Session::setFlash("unable to delete user");
        }
    }

    public function admin_login() {
        if ($_POST && isset($_POST['username']) && isset($_POST['password'])) {
            $data = array();
            $user = $this->model->getByLogin($_POST['username']);
            $hash = md5(Config::get('salt') . $_POST['password']);
            if ($user && $user['Status'] == 1 && $hash == $user['Password']) {
                Session::set('Name', $user['Name']);
                Session::set('role', $user['Status']);

                $data = array(
                    'name' => $user['Name'],
                    'status' => 'success',
                );
                // role = 1 : admin
                // role = 0 : member --> cannot access
                Router::redirect(ADMIN_ROOT);
            }
            echo json_encode($data);
        }
    }

    public function admin_logout() {
        Session::destroy();
        Router::redirect(ADMIN_ROOT);
    }

    public function register($data = array(), $r = 1) {
        return $this->model->add($data, $r);
    }

    public function login($data) {
        return $this->model->getByLogin($data);
    }

}
