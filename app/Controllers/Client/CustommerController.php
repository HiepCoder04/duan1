<?php

namespace App\Controllers\Client;
use App\Models\Admin\Category;
use App\Models\Client\Custommer;
use App\Models\Auth\Authenication;
use App\Midderware\loginMidderware;

class CustommerController
{
   public $cus;
    public $check;
    public $cate;
    

    public function __construct()
    {
        $this ->cus = new Custommer();
        $this->check =new loginMidderware();
        $this->check ->checklogin();
      $this->cate = new Category();
       
    }

   
 
    public function index(){
        $id=$_SESSION['user_id'];
        $listCus=$this->cus->getListCus($id);
        require_once __DIR__ . "/../../Views/client/cus.php";
    }
    public function store()
    {
        $id=$_SESSION['user_id'];
     require_once __DIR__ . "/../../Views/client/cus/addCus.php";
    }

    public function create()
    {
        $data=$_POST;
        $messageError = $this->validate($data); 
       
           

            if (empty($messageError)) {
                $this->cus->addCus($data['name'], $data['tel'], $data['address']);
                $_SESSION['message_success'] = "Thêm địa chỉ thành công!";
                header('Location: ' . BASE_URL . '/custommer/list');
                exit();
            }else{
                $id=$_SESSION['user_id'];
                require_once __DIR__ . "/../../Views/client/cus/addCus.php";
            }
        
    }
    public function list(){
        $listCate = $this->cate->listcate();
        $id=$_SESSION['user_id'];
        $listCus=$this->cus->getListCus($id);
        require_once __DIR__ . "/../../Views/client/cus/list.php";
    }
    public function edit($id)
    {
        $id_user=$_SESSION['user_id'];
        $detailCus =$this ->cus->getCusById($id,$id_user);
        require_once __DIR__ . "/../../Views/client/cus/edit.php";
    }
    public function update($id)
{
    $data = $_POST;
    $id_user = $_SESSION['user_id'];
    
    // Lấy thông tin khách hàng cần sửa
    $detailCus = $this->cus->getCusById($id, $id_user);

    // Kiểm tra lỗi dữ liệu đầu vào
    $messageError = $this->validate($data);

    if (empty($messageError)) {
        // Gọi hàm updateCus với dữ liệu hợp lệ
        $this->cus->updateCus($id, $data['name'], $data['tel'], $data['address']);

        $_SESSION['message_success'] = "Sửa địa chỉ thành công!";
        header('Location: ' . BASE_URL . '/custommer/list');
        exit();
    } else {
        // Hiển thị lại trang sửa với thông tin lỗi
        require_once __DIR__ . "/../../Views/client/cus/edit.php";
    }
}

public function delete($id)
{
    $id_user = $_SESSION['user_id']; // Lấy ID user đang đăng nhập

    // Kiểm tra khách hàng có tồn tại và thuộc về user không
    $detailCus = $this->cus->getCusById($id, $id_user);
    if (!$detailCus) {
        $_SESSION['message_error'] = "Khách hàng không tồn tại hoặc bạn không có quyền xóa!";
    } else {
        $this->cus->deleteCus($id);
        $_SESSION['message_success'] = "Xóa khách hàng thành công!";
    }

    // Chuyển hướng về danh sách khách hàng
    header('Location: ' . BASE_URL . '/custommer/list');
    exit();
}


    public function validate($data) {
        $messageError = [];

        if (empty($data['name'])) {
            $messageError['name'] = "Không được để trống tên.";
        }
        if (empty($data['tel'])) {
            $messageError['tel'] = "Không được để trống số điện thoại.";
        }
        if (empty($data['address'])) {
            $messageError['address'] = "Địa chỉ không được để trống.";
        }
       
        

        return $messageError;
    }
}