<?php

namespace App\Controllers\Admin;
use App\Models\Admin\Category;

class CategoriesController {

    public $cate;
    
    public function __construct() {
        $this->cate = new Category();
    }
    
    public function index() {
      $listCate=$this->cate->getList();
     
        require_once __DIR__ . "/../../Views/admin/danhmuc/list.php";
    }
    
    public function create() {
        require_once __DIR__ . "/../../Views/admin/danhmuc/add.php";
    }
    
    public function store() {
        $name = $_POST['name_categories'];
        $status=$_POST['status'];
        $messageError = $this->validate($name);
        if(count($messageError) == 0){
        
            
            
            $this->cate->addCate($name,$status);
            header('location: ' . BASE_URL . 'admins/categories'); 
        }else{
          
            require_once __DIR__ . "/../../Views/admin/danhmuc/add.php";
        }
    }
    
    public function edit($id) {
      $detailCate = $this->cate->detailCate($id);
      require_once __DIR__ . "/../../Views/admin/danhmuc/edit.php";
    }
    
    public function update($id) {
        $name = $_POST['name_categories'];
        $status= $_POST['status'];
        

        $messageError = $this->validate($name);

        if(count($messageError) == 0){
           
           
            

            $this->cate->updateCate($id,$name,$status);
            header('location: ' . BASE_URL . 'admins/categories'); 
        }else{
            $detailCate = $this->cate->detailCate($id);
              require_once __DIR__ . "/../../Views/admin/danhmuc/edit.php";
        }
    }
    
    public function delete($id) {
        $this->cate->deleteCate($id);
        header('location: ' . BASE_URL . 'admins/categories'); 
    }
    public function validate($name){
        $messageError = [];

        if($name == ''){
            array_push($messageError, 'Không được để trống tên danh mục');
        }
       

        return $messageError;
    }
}
