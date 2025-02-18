<?php
namespace App\Models\Admin;

use App\Commons\Database;

class Product {
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function listProduct() {
        $sql = "SELECT categories.category_name, products.* 
                FROM products 
                JOIN categories ON products.category_id = categories.id
                ORDER BY products.id DESC";
        $query = $this->db->pdo->query($sql);
        return $query->fetchAll();
    }

    public function addProduct($name, $category_id, $product_code, $linkImage, $quantity, $description, $content, $status, $price, $price_sale) {
        $now = date("Y-m-d H:i:s"); 
       $sql = "INSERT INTO products (name, category_id, product_code, img_thumbnail, quantity, description, content, stastus, price, price_sale,created_at,update_at) 
                VALUES ('$name', '$category_id', '$product_code', '$linkImage', '$quantity', '$description', '$content', '$status', '$price', '$price_sale','$now','$now')";
        $query = $this->db->pdo->query($sql);
       
    }

    public function detailProduct($id) {
        $sql = "SELECT * FROM products WHERE id = $id";
        $query = $this->db->pdo->query($sql);
        return $query->fetch();
    }

    public function updateProduct($id, $name, $category_id, $product_code, $image, $quantity, $description, $content, $status, $price, $price_sale) {
        $now = date("Y-m-d H:i:s");
        $sql="
       UPDATE `products` SET `name`='$name',
                            `category_id`='$category_id',
                            `product_code`='$product_code',
                            `price`='$price',
                            `img_thumbnail`='$image',
                            `description`='$description',
                            `content`='$content',
                            `price_sale`='$price_sale',
                            `stastus`=' $status',
                            `quantity`='$quantity',
                            
                            `update_at`='$now' 
                           WHERE id=".$id;
                           $query = $this->db->pdo->query($sql);
       
     

    }
    

    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = $id";
        $query = $this->db->pdo->query($sql);
        return $query;
    }
}
