<?php

namespace App\Controllers\Auth;
use App\Models\Auth\Authenication;

class AuthController {
    protected $auth;

    public function __construct() {
        $this->auth = new Authenication();
    }

    // Hiển thị form đăng ký
    public function registerForm() {
        require_once __DIR__ . "/../../Views/auth/register.php";
    }

   
    public function register() {
        $data = $_POST;
        $messageError = $this->validate($data);
    
        if (empty($messageError)) {
            $this->auth->register($data['email'], $data['pass'], $data['name']);
            $_SESSION['message_success'] = "Đăng ký thành công!";
            header('Location: ' . BASE_URL . 'login');
            exit();
        }
    
        // Gọi lại form register và truyền lỗi về view
        require_once 'app/Views/auth/register.php';
    }

  
    public function loginForm() {
        require_once __DIR__ . "/../../Views/auth/login.php";
    }


    public function login() {
        $data = $_POST;
        $messageError = $this->validateLogin($data);
    
        if (empty($messageError)) {
            $user = $this->auth->check($data['email']);
    
            if ($user) {
              
                if ($user->ban == 1) {
                    $_SESSION['message_error'] = "Tài khoản của bạn đã bị khóa! Vui lòng liên hệ quản trị viên.";
                    header('Location: ' . BASE_URL . 'home');
                    exit();
                }
    
                if ($data['pass'] === $user->pass) { 
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['user_name'] = $user->name;
                    $_SESSION['user_role'] = $user->role;
    
                    $_SESSION['message_success'] = "Đăng nhập thành công!";
                    if ($user->role != 0) {
                        header('Location: ' . BASE_URL . 'admins');
                    } else {
                        header('Location: ' . BASE_URL . 'home');
                    }
                    exit();
                } else {
                    $messageError['general'] = "Email hoặc mật khẩu không chính xác!";
                }
            } else {
                $messageError['general'] = "Email hoặc mật khẩu không chính xác!";
            }
        }
    
        require_once 'app/Views/auth/login.php';
    }
    

   
    public function logout() {
        session_start();
    
       
        $message_success = "Đăng xuất thành công!";
    
        session_unset(); 
        session_destroy(); 
    
        session_start();
        $_SESSION['message_success'] = $message_success;
    
        header('Location: ' . BASE_URL . 'home');
        exit();
    }
    

   
    public function validateLogin($data) {
        $messageError = [];

        if (empty(trim($data['email']))) {
            $messageError['email'] = "Không được để trống email.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $messageError['email'] = "Email không hợp lệ.";
        }

        if (empty($data['pass'])) {
            $messageError['pass'] = "Không được để trống mật khẩu.";
        }

        return $messageError;
    }
    
    
public function ban($id){
    $user = $this->auth->detailUser($id);
    $ban=1;
    $this->auth->ban($id,$ban);
    
    $_SESSION['message_success'] = "Tài khoản đã bị cấm hoạt động";
    header('Location: ' . BASE_URL . '/admins/listUser');
    exit();

}
public function active($id){
    $user = $this->auth->detailUser($id);
    $ban=0;
    $this->auth->ban($id,$ban);
    
    $_SESSION['message_success'] = "Tài khoản đã được mở";
    header('Location: ' . BASE_URL . '/admins/listUser');
    exit();

}
    // Kiểm tra dữ liệu đăng ký
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

        if (empty($data['pass'])) {
            $messageError['pass'] = "Không được để trống mật khẩu.";
        }

        return $messageError;
    }
}
