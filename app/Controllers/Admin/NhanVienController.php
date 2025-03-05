<?php

namespace App\Controllers\Admin;
use App\Controllers\Auth\AuthController;
use App\Models\Admin\Category;
use App\Midderware\Midderware;
use App\Models\Admin\NhanVien;
use App\Models\Auth\Authenication;

class NhanVienController extends AuthController{

    public $nv;
    public $midderlware;
    public function __construct() {
        $this-> midderlware = new Midderware;
        $this-> midderlware->checkrole();
        $this->nv = new NhanVien();
        $this->auth =new Authenication();

    }
    
    public function index() {
      $listNv=$this->nv->getList();
     
        require_once __DIR__ . "/../../Views/admin/nhanvien/list.php";
    }
    
    public function add() {
        require_once __DIR__ . "/../../Views/admin/nhanvien/add.php";
    }
   
        public function delete($id) {
            $this->nv->delete($id);
            $_SESSION['message_success']="Xóa nhân viên thành công";
            header('location: ' . BASE_URL . 'admins/nhanvien/'); 
        }
    
    
    public function store() {
        $data = $_POST;
        $messageError = $this->validate($data);
    
    
        if (empty($messageError)) {
         
    
            $this->nv->add($data['email'], $data['role'], $data['name']);
            $_SESSION['message_success'] = "Đăng ký thành công!";
            header('Location: ' . BASE_URL . 'admins/nhanvien/');
            exit();
        } else {
            require_once __DIR__ . "/../../Views/admin/nhanvien/add.php";
        }
    }
    
    
    
    
   
    
    public function validate($data) {
        $messageError = [];

        if (empty(trim($data['name']))) {
            $messageError['name'] = "Không được để trống tên.";
        }

        if (empty(trim($data['email']))) {
            $messageError['email'] = "Không được để trống email.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $messageError['email'] = "Email không hợp lệ.";
        } elseif ($this->auth->isEmailExists($data['email'])) {
            $messageError['email'] = "Email đã tồn tại, vui lòng chọn email khác.";
        }

      

        return $messageError;
    }
}
