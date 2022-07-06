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
    public function queryGetAllPosts() 
    {
        $connection = $this->db->getConnexion();  
        $sql = "SELECT * FROM posts";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * Create a new post
     * @param int $id_user
     * @param string $content
     * @param string $author
     * @param string $status
     */
    public function queryCreatePost(int $id_user, string $content, string $author, string $status) 
    {
        $connection = $this->db->getConnexion();  
        $date = date('d/m/Y');
        $sql = "INSERT INTO posts (id_user, content, author, status, created_at) VALUES (:id_user, :content, :author, :status, :created_at)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':created_at', $date);
        $stmt->execute();
    }
}
?>