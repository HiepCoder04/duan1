<?php
namespace App\Models\Admin;
use App\Commons\Database;

class Category
{
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getList()
    {
        $pdo = $this->db->pdo;
        $sql = "
                select * from categories 
            ";
        $query = $pdo->query($sql);
        return $query->fetchAll();
    }
    public function addCate($name, $status)
    {
        $now = date("Y-m-d H:i:s"); 
        $pdo = $this->db->pdo;

        $sql = "
    INSERT INTO `categories` (`category_name`, `status`, `created_at`, `updated_at`) 
    VALUES ('$name', '$status', '$now', '$now')
"; 

        $pdo->query($sql);

    }
    public function detailCate($id){
        $sql = "select * from categories where id=$id";
            $pdo = $this->db->pdo;
            $query = $pdo->query($sql);
            return $query->fetch();
    }
    public function updateCate($id,$name,$status){
        $pdo = $this->db->pdo;
        $now = date("Y-m-d h:i:s", time());
        $sql = "UPDATE `categories` SET `category_name`='$name',`status`='$status',`updated_at`='$now' WHERE id=".$id;
        $pdo->query($sql);
    }
    public function deleteCate($id){
        $sql = "delete from categories where id = '$id'";
        $this->db->pdo->query($sql);
    }
  
}