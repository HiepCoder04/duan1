<?php

namespace App\Controllers\Client;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Auth\Authenication;
use App\Midderware\loginMidderware;
use App\Models\Client\User;
use App\Models\Client\Order;
use App\Models\Client\Custommer;

class OrderController
{
    public $user;
    public $cus;
    public $products;
    public $check;
    public $cate;
    public $oder;

    public function __construct()
    {
        $this->check = new loginMidderware();
        $this->check->checklogin();
        $this->cus = new Custommer();
        $this->oder = new Order();
        $this->user = new User();
        $this->products = new Product();
        $this->cate = new Category();
    }

    public function order()
    {

        $cart = $_SESSION['cart'] ?? [];



        $id_user = $_SESSION['user_id'];
        $email = $this->user->detailUser($id_user);

        if (isset($_POST['id_cus'])) {
            $id_cus = $_POST['id_cus'];

            $user_information = $this->cus->getCusById($id_cus, $id_user);
        }

        $listCate = $this->cate->listcate();

        require_once __DIR__ . "/../../Views/client/order.php";
    }

    public function store()
    {
        $orderData = $_POST;
        $cart = $_SESSION['cart'] ?? [];
    
        $messageError = $this->validate($orderData);
        if (empty($messageError)) {
    
            $id_user = $_SESSION['user_id'];
            $id_cus = $this->cus->getOrAddCus($orderData['name'], $orderData['address'], $orderData['tel'], $id_user);
            $payment = $orderData['payment'];
            $total_price = $orderData['total'];
    
            $today = date("Y-m-d");
            $orderCount = $this->oder->countOrdersToday($today); // Thêm hàm này trong model
            $order_code = "ORD" . date("Ymd") . "-" . str_pad($orderCount + 1, 5, "0", STR_PAD_LEFT);
    
         
            $order_id = $this->oder->order($id_user, $id_cus, $total_price, $payment, $order_code);
    
            if ($order_id) {
                $total_price = 0;
                foreach ($cart as $item) {
                    $stook = $item['so_luong_con'];
                    $quantity = $item['so_luong_dat'];
                    $total = $item['price'] * $quantity;
                    $total_price += $total;
    
                    if ($stook >= $quantity) {
                        $this->oder->addOrderDetail($order_id, $item['product_id'], $quantity, $item['price'], $total);
                        $this->products->reduceStock($item['product_id'], $quantity);
                    } else {
                        $_SESSION['message_error'] = "Số lượng trong kho không đủ vui lòng cập nhật lại giỏ hàng";
                        $cart = $_SESSION['cart'] ?? [];
                        $listCate = $this->cate->listcate();
                        require_once __DIR__ . "/../../Views/client/cart.php";
                    }
                }
    
                unset($_SESSION['cart']);
                $_SESSION['message_success'] = "Đặt hàng thành công! Mã đơn: $order_code";
                header('Location: ' . BASE_URL . 'order/list');
                exit();
            }
        } else {
            $cart = $_SESSION['cart'] ?? [];
            $id_user = $_SESSION['user_id'];
            $email = $this->user->detailUser($id_user);
    
            if (isset($_POST['id_cus'])) {
                $id_cus = $_POST['id_cus'];
                $user_information = $this->cus->getCusById($id_cus, $id_user);
            }
            $listCate = $this->cate->listcate();
    
            require_once __DIR__ . "/../../Views/client/order.php";
        }
    }
    

    public function list()
    {
        $listCate = $this->cate->listcate();
        $id_user = $_SESSION['user_id'];
        $listOrder = $this->oder->listOderByUser($id_user);
        require_once __DIR__ . "/../../Views/client/oderlist.php";
    }
    public function detail($order_id) {
        // Lấy danh sách sản phẩm của đơn hàng
        $orderDetails = $this->oder->detailListOrder($order_id);
    
        // Kiểm tra nếu đơn hàng không tồn tại
        if (empty($orderDetails)) {
            $_SESSION['message_error'] = "Không tìm thấy đơn hàng.";
            header("Location: " . BASE_URL . "admins/order");
            exit();
        }
    
        // Lấy thông tin chung của đơn hàng (từ dòng đầu tiên)
        $orderInfo = [
            'order_id'            => $orderDetails[0]['order_id'],
            'order_code'          => $orderDetails[0]['order_code'],
            'total_price'         => $orderDetails[0]['total_price'],
            'payment_method'      => $orderDetails[0]['payment_method'],
            'order_status'        => $orderDetails[0]['order_status'],
            'order_created_at'    => $orderDetails[0]['order_created_at'],
            'order_payment_status'=> $orderDetails[0]['order_payment_status'],
            'customer_name'       => $orderDetails[0]['customer_name'],
            'customer_address'    => $orderDetails[0]['customer_address'],
            'customer_telephone'  => $orderDetails[0]['customer_telephone']
        ];
    
        // Lấy danh sách sản phẩm trong đơn hàng
        $products = [];
        foreach ($orderDetails as $item) {
            $products[] = [
                'product_identifier'  => $item['product_identifier'],
                'product_name'        => $item['product_name'],
                'product_image'       => $item['product_image'], // Không sửa BASE_URL, giữ nguyên theo cách bạn xử lý trong View
                'product_quantity'    => $item['product_quantity'],
                'product_unit_price'  => $item['product_unit_price'],
                'product_subtotal'    => $item['product_subtotal']
            ];
        }
    
        // Truyền dữ liệu sang View
        require_once __DIR__ . "/../../Views/client/oderdetail.php";
    }
    public function huy($id_order) {
        if (isset($id_order)) {
            $id_user = $_SESSION['user_id']; 
            $detailOrder = $this->oder->detailListOrder($id_order);
    
            
            if (empty($detailOrder)) {
                $_SESSION['message_error'] = "Đơn hàng không tồn tại!";
                header('Location: ' . BASE_URL . 'order/list');
                exit();
            }
    
            // Lấy thông tin trạng thái đơn hàng từ phần tử đầu tiên
            $order_status = $detailOrder[0]['order_status'];
    
            // Chỉ có thể hủy nếu đơn hàng đang ở trạng thái "Chờ xác nhận" hoặc "Đang chuẩn bị hàng"
            if ($order_status == 1 || $order_status == 2) {
               
                $this->oder->updateStatus($id_order, 5);
    
            
                foreach ($detailOrder as $item) {
                    $product_id = $item['product_identifier'];
                    $quantity = $item['product_quantity']; 
                    $this->products->addStock($product_id, $quantity);
                }
    
                $_SESSION['message_success'] = "Đơn hàng đã được hủy!";
            } else {
                $_SESSION['message_error'] = "Không thể hủy đơn hàng lúc này!";
            }
    
            // Chuyển hướng về danh sách đơn hàng
            header('Location: ' . BASE_URL . 'order/list');
            exit();
        }
    }
    
    public function complate($id_order) {
        if (isset($id_order)) {
            $id_user = $_SESSION['user_id']; 
            $detailOrder = $this->oder->detailListOrder($id_order);
    
            // Kiểm tra xem đơn hàng có tồn tại và có thuộc về user hay không
            if (!$detailOrder) {
                $_SESSION['message_error'] = "Đơn hàng không tồn tại hoặc không thuộc về bạn!";
                header('Location: ' . BASE_URL . 'order/list');
                exit();
            }
            $order_status = $detailOrder[0]['order_status'];
    
           
            if ($order_status== 6) {
                $status=4;
                $this->oder->updateStatus($id_order, $status); // Cập nhật trạng thái thành "Giao hàng thành công"
                $_SESSION['message_success'] = "Đơn hàng đã giao thành công!";
            } else {
                $_SESSION['message_error'] = "Không thể xác nhận hoàn thành đơn hàng này!";
            }
    
            // Chuyển hướng về danh sách đơn hàng
            header('Location: ' . BASE_URL . 'order/list');
            exit();
        }
    }
    

    // 🟢 Hàm kiểm tra dữ liệu trước khi đặt hàng
    public function validate($order)
    {
        $messageError = [];

        if (empty($order['name'])) {
            $messageError['name'] = "Tên người nhận không được để trống.";
        }
        if (empty($order['email']) || !filter_var($order['email'], FILTER_VALIDATE_EMAIL)) {
            $messageError['email'] = "Email không hợp lệ.";
        }
        if (empty($order['tel']) || !preg_match('/^[0-9]{10,11}$/', $order['tel'])) {
            $messageError['tel'] = "Số điện thoại không hợp lệ.";
        }
        if (empty($order['address'])) {
            $messageError['address'] = "Địa chỉ không được để trống.";
        }
        if (!isset($order['payment']) || !in_array($order['payment'], ['1', '2'])) {
            $messageError['payment'] = "Hình thức thanh toán không hợp lệ.";
        }

        return $messageError;
    }
}
?>