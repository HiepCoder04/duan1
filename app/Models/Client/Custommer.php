<?php
namespace App\Models\Client;

use App\Commons\Database;
use PDO;
use PDOException;

class Custommer {
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getListCus($id_user) {
        $sql = "SELECT * FROM `cus` WHERE id_user = :id_user";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getOrAddCus($name, $address, $tel, $id_user) {
        // Kiểm tra khách hàng đã tồn tại chưa
        $sql_check = "SELECT id FROM cus WHERE name = :name AND address = :address AND tel = :tel LIMIT 1";
        $stmt_check = $this->db->pdo->prepare($sql_check);
        $stmt_check->execute([
            ':name'    => $name,
            ':address' => $address,
            ':tel'     => $tel
        ]);
        
        $cus = $stmt_check->fetch(PDO::FETCH_ASSOC);
        
        if ($cus) {
            // Nếu tồn tại, trả về id của khách hàng đó
            return $cus['id'];
        } else {
            // Nếu chưa tồn tại, thêm mới khách hàng
            $now = date("Y-m-d H:i:s");
            $sql_insert = "INSERT INTO `cus` (`id_user`, `name`, `address`, `tel`, `created_at`, `updated_at`) 
                           VALUES (:id_user, :name, :address, :tel, :created_at, :updated_at)";
            
            $stmt_insert = $this->db->pdo->prepare($sql_insert);
            $result = $stmt_insert->execute([
                ':id_user'    => $id_user,
                ':name'       => $name,
                ':address'    => $address,
                ':tel'        => $tel,
                ':created_at' => $now,
                ':updated_at' => $now
            ]);
            
            if ($result) {
                return $this->db->pdo->lastInsertId();
            }
            return false;
        }
    }
    public function getCusById($id, $id_user){
        $sql = "SELECT * FROM `cus` WHERE id = :id AND id_user = :id_user";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addCus( $name, $address, $tel){
        $id_user=$_SESSION['user_id'];
        $sql = "INSERT INTO cus (id_user, name, address, tel, created_at, updated_at) 
                VALUES (:id_user, :name, :address, :tel, NOW(), NOW())";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
        
        $stmt->execute();
    }
    public function updateCus($id, $name, $tel, $address){
        $sql = "UPDATE cus SET name = :name, tel = :tel, address = :address, updated_at = NOW() 
                WHERE id = :id";
    
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    
        return $stmt->execute();
    }
    public function deleteCus($id) {
        $sql = "DELETE FROM cus WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    
    
    
    
    
    


}
?>
