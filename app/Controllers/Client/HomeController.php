<?php

namespace App\Controllers\Client;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Auth\Authenication;
class HomeController{
  public $cate;
  public $products;


  public function __construct() {
     
      $this->cate = new Category();
      $this->products = new Product();
      
  }
  public function index(){
    $listPro=$this->products->listProduct();
    $listCate=$this->cate->listcate();
    require_once __DIR__ . "/../../Views/client/home.php";
  }


}