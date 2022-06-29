<?php
include_once 'db.php';
class ModelPosts {
    
    // Create Instance of DB Class
    public function __construct() {
        $this->db = new DB();
    }

    // Get all posts
    public function queryAllFromPosts() {
        $connexion = $this->db->connexion();
        $sql = "SELECT * FROM posts ORDER BY date DESC";
        $result = $connexion->query($sql);
        return $result;
    }

    // Get one post by id
    public function queryPostsByID()
    {
        $connexion = $this->db->connexion();
        $sql = "SELECT * FROM posts WHERE id = :id";
        $result = $connexion->prepare($sql);
        $result->bindParam(':id', $_GET['id']);
        $result->execute();
        return $result;
    }


    public function queryInsertNewBlog()
    {
        $connexion = $this->db->connexion();
        $sql = "INSERT INTO posts (title, content, date, image, author) VALUES (:title, :content, :date, :image, :author)";
        $result = $connexion->prepare($sql);
        $result->bindParam(':title', $_POST['title']);
        $result->bindParam(':content', $_POST['content']);
        $result->bindParam(':date', $_POST['date']);
        $result->bindParam(':image', $_POST['image']);
        $result->bindParam(':author', $_POST['author']);
        $result->execute();
        return $result;
    }
}
?>