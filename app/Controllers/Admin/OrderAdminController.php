<?php

namespace App\Controllers\Admin;
use App\Midderware\Midderware;
use App\Models\Auth\Authenication;
use App\Models\Admin\OrderAdmin;

class OrderAdminController{
  public $midderlware;
  public $auth;
  public $order;

  public function __construct(){
  

  $this-> midderlware = new Midderware;
  $this-> midderlware->checkadmin();
  $this->order =new OrderAdmin();
  }
    public function index(){
      $statusComplate = 4;
      $countComplate=$this->order->countOrdersByStatus($statusComplate);
      //đơn hàng đang chờ xác nhận
      $statusOder = 1;
      $countoder=$this->order->countOrdersByStatus($statusOder);
      //đơn hàng đã xác nhận
      $statusPending = 2;
      $countPending=$this->order->countOrdersByStatus($statusPending);
      //đơn hàng đang giao hàng
      $statusship = 3;
      $countShip=$this->order->countOrdersByStatus($statusship);
      //đơn hàng đã hủy
      $statusfail= 5;
      $countfail=$this->order->countOrdersByStatus($statusfail);
      //đơn hàng đã giao
      $statusdagiao = 6;
      $countdagiao=$this->order->countOrdersByStatus($statusdagiao);
       $status=1;
    $a=$this->order->getlistOrder($status);

    require_once __DIR__ . "/../../Views/admin/order/order-ful.php";
        
      }
      public function detail($order_id) {
        // Lấy danh sách sản phẩm của đơn hàng
        $orderDetails = $this->order->detailListOrder($order_id);
    
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
        require_once __DIR__ . "/../../Views/admin/order/detail-order.php";
    }
    
    
    
      public function confirm($id_oder){
        if(isset($id_oder)){
            
          $detailOder=$this->order->detailListOrder($id_oder);
          
                $detailOder['order_status']=2;
                $this->order->updateStatus($id_oder,$detailOder['order_status']);
               
            
            $_SESSION['message_success'] = " Đơn hàng đã được xác nhận!";
            header('Location: ' . BASE_URL . 'admins/order/');
            exit();
           
          
        }
    }
    public function ship(){
        //đếm số lượng 
//đơn hàng thành công
  $statusComplate = 4;
  $countComplate=$this->order->countOrdersByStatus($statusComplate);
  //đơn hàng đang chờ xác nhận
  $statusOder = 1;
  $countoder=$this->order->countOrdersByStatus($statusOder);
  //đơn hàng đã xác nhận
  $statusPending = 2;
  $countPending=$this->order->countOrdersByStatus($statusPending);
  //đơn hàng đang giao hàng
  $statusship = 3;
  $countShip=$this->order->countOrdersByStatus($statusship);
  //đơn hàng đã hủy
  $statusfail= 5;
  $countfail=$this->order->countOrdersByStatus($statusfail);
  //đơn hàng đã giao
  $statusdagiao = 6;
  $countdagiao=$this->order->countOrdersByStatus($statusdagiao);
      $status=2;
   $a=$this->order->getlistOrder($status);

   require_once __DIR__ . "/../../Views/admin/order/order-ful.php";
       
     }
     public function confirmShip($id_oder){
      if(isset($id_oder)){
          
        $detailOder=$this->order->detailListOrder($id_oder);
        
              $detailOder['order_status']=3;
              $this->order->updateStatus($id_oder,$detailOder['order_status']);
             
          
          $_SESSION['message_success'] = " Đơn hàng được chuyển qua đơn vị vận chuyển!";
          header('Location: ' . BASE_URL . 'admins/order/ship');
          exit();
         
        
      }
  }
  public function confirmShipNow($id_oder){
    if(isset($id_oder)){
        
      $detailOder=$this->order->detailListOrder($id_oder);
      
            $detailOder['order_status']=6;
            $detailOder['order_payment_status']=2;
            $this->order->updateStatus($id_oder,$detailOder['order_status']);
            $this->order->updatePaymenStatus($id_oder,$detailOder['order_payment_status']);
           
        
        $_SESSION['message_success'] = " Đơn hàng đã được giao thành công!";
        header('Location: ' . BASE_URL . 'admins/order/shipnow');
        exit();
       
      
    }
}
public function ful(){
  //đếm số lượng 
//đơn hàng thành công
  $statusComplate = 4;
  $countComplate=$this->order->countOrdersByStatus($statusComplate);
  //đơn hàng đang chờ xác nhận
  $statusOder = 1;
  $countoder=$this->order->countOrdersByStatus($statusOder);
  //đơn hàng đã xác nhận
  $statusPending = 2;
  $countPending=$this->order->countOrdersByStatus($statusPending);
  //đơn hàng đang giao hàng
  $statusship = 3;
  $countShip=$this->order->countOrdersByStatus($statusship);
  //đơn hàng đã hủy
  $statusfail= 5;
  $countfail=$this->order->countOrdersByStatus($statusfail);
  //đơn hàng đã giao
  $statusdagiao = 6;
  $countdagiao=$this->order->countOrdersByStatus($statusdagiao);
  
 $a=$this->order->getAllOrders();


   require_once __DIR__ . "/../../Views/admin/order/order-ful.php";
}

  public function complate(){
    //đếm số lượng 
     //đếm số lượng 
//đơn hàng thành công
  $statusComplate = 4;
  $countComplate=$this->order->countOrdersByStatus($statusComplate);
  //đơn hàng đang chờ xác nhận
  $statusOder = 1;
  $countoder=$this->order->countOrdersByStatus($statusOder);
  //đơn hàng đã xác nhận
  $statusPending = 2;
  $countPending=$this->order->countOrdersByStatus($statusPending);
  //đơn hàng đang giao hàng
  $statusship = 3;
  $countShip=$this->order->countOrdersByStatus($statusship);
  //đơn hàng đã hủy
  $statusfail= 5;
  $countfail=$this->order->countOrdersByStatus($statusfail);
  //đơn hàng đã giao
  $statusdagiao = 6;
  $countdagiao=$this->order->countOrdersByStatus($statusdagiao);
    
    $status=4;
  $a=$this->order->getlistOrder($status);
 

  require_once __DIR__ . "/../../Views/admin/order/order-ful.php";
     
   }
   
   public function fail(){
      //đếm số lượng 
//đơn hàng thành công
  $statusComplate = 4;
  $countComplate=$this->order->countOrdersByStatus($statusComplate);
  //đơn hàng đang chờ xác nhận
  $statusOder = 1;
  $countoder=$this->order->countOrdersByStatus($statusOder);
  //đơn hàng đã xác nhận
  $statusPending = 2;
  $countPending=$this->order->countOrdersByStatus($statusPending);
  //đơn hàng đang giao hàng
  $statusship = 3;
  $countShip=$this->order->countOrdersByStatus($statusship);
  //đơn hàng đã hủy
  $statusfail= 5;
  $countfail=$this->order->countOrdersByStatus($statusfail);
  //đơn hàng đã giao
  $statusdagiao = 6;
  $countdagiao=$this->order->countOrdersByStatus($statusdagiao);
    $status=5;
 $a=$this->order->getlistOrder($status);
count($a);
require_once __DIR__ . "/../../Views/admin/order/order-ful.php";
     
   }
   public function shipnow(){
      //đếm số lượng 
//đơn hàng thành công
  $statusComplate = 4;
  $countComplate=$this->order->countOrdersByStatus($statusComplate);
  //đơn hàng đang chờ xác nhận
  $statusOder = 1;
  $countoder=$this->order->countOrdersByStatus($statusOder);
  //đơn hàng đã xác nhận
  $statusPending = 2;
  $countPending=$this->order->countOrdersByStatus($statusPending);
  //đơn hàng đang giao hàng
  $statusship = 3;
  $countShip=$this->order->countOrdersByStatus($statusship);
  //đơn hàng đã hủy
  $statusfail= 5;
  $countfail=$this->order->countOrdersByStatus($statusfail);
  //đơn hàng đã giao
  $statusdagiao = 6;
  $countdagiao=$this->order->countOrdersByStatus($statusdagiao);
    $status=3;
 $a=$this->order->getlistOrder($status);

 require_once __DIR__ . "/../../Views/admin/order/order-ful.php";
     
   }

    
     
}
