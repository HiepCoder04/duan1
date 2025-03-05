<?php
namespace App\Midderware;
class Midderware{
    public function checkadmin(){
        if(empty($_SESSION['user_id'])){
          $_SESSION['message_error']="Vui lòng đăng nhập để tiếp tục";
          header('location: ' . BASE_URL . 'login'); 
        }else{

            if ($_SESSION['user_role']==0) {
              $_SESSION['message_error']="Bạn không đủ quyền";
                header('location: ' . BASE_URL . 'home'); 
               
            }
         
        
        }
      }
      public function checkrole(){
        if(empty($_SESSION['user_id'])){
          $_SESSION['message_error']="Vui lòng đăng nhập để tiếp tục";
          header('location: ' . BASE_URL . 'login'); 
        }else{

            if ($_SESSION['user_role']!=3) {
              $_SESSION['message_error']="Bạn không đủ quyền";
                header('location: ' . BASE_URL . 'home'); 
               
            }
         
        
        }
      }
     
}