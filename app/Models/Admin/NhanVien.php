<?php
namespace App\Models\Admin;
use App\Commons\Database;

class NhanVien{
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Lấy danh sách danh mục
    public function getList() {
        $sql = "SELECT * FROM `users` WHERE `role` IN (:role1, :role2)";
        $stmt = $this->db->pdo->prepare($sql);
        
        $role1 = 1;
        $role2 = 2;
    
        $stmt->execute([
            'role1' => $role1,
            'role2' => $role2
        ]);
    
        return $stmt->fetchAll();
    }
    

   
    public function add( $email,$role,$name) {
        $pass = "11111111";

        $pdo = $this->db->pdo;
        $now = date("Y-m-d H:i:s");
        
      
      
        
       
        $sql = "INSERT INTO users (name, email, pass, role, created_at, updated_at) 
                VALUES (:name, :email, :password, :role, :created_at, :updated_at)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $pass, 
            ':role' => $role,
            ':created_at' => $now,
            ':updated_at' => $now
        ]);
        
    }

 

    // Xóa danh mục
    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
 
}
