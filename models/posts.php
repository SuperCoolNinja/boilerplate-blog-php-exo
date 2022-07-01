<?php
include_once 'db.php';
class ModelPosts {
    
    // Create Instance of DB Class
    public function __construct() {
        $this->db = new DB();
    }
    
    /**
     * Get all posts
     * @return array
     */
    public function getAllPosts() {
        $connection = $this->db->getConnexion();  
        $sql = "SELECT * FROM posts";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
?>