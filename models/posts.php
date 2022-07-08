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
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('SELECT * FROM posts ORDER BY created_at DESC');
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    /**
     * Get a post by ID
     * @param int $id_post
     * @return array
     */
    public function queryGetPostByID(int $id_post)
    {
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('SELECT * FROM posts WHERE id = :id_post');
        $query->bindParam(':id_post', $id_post);
        $query->execute();
        $result = $query->fetchAll();
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
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO posts (id_user, content, author, status, created_at) VALUES (:id_user, :content, :author, :status, :created_at)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':created_at', $date);
        $stmt->execute();
    }

    /**
     * Update Like of a post
     * @param int $id_post
     * @param int $like
     */
    public function queryUpdateLike(int $id_post, int $like)
    {
        $connection = $this->db->getConnexion();
        $sql_insert = "INSERT INTO `likes` (`user_id`, `post_id`) VALUES (:user_id, :post_id)";
        $stmt_insert = $connection->prepare($sql_insert);
        $stmt_insert->bindParam(':user_id', $_SESSION['id']);
        $stmt_insert->bindParam(':post_id', $id_post);
        $stmt_insert->execute();

        $sql_update = "UPDATE `posts` SET `likes` = :like WHERE id = :id_post";
        $stmt_update = $connection->prepare($sql_update);
        $stmt_update->bindParam(':like', $like);
        $stmt_update->bindParam(':id_post', $id_post);
        $stmt_update->execute();
    }

    /**
     * Check if the user has already liked the post
     * @param int $id_post
     * @return boolean
     */
    public function queryCheckLike(int $id_post) : bool
    {
        $connection = $this->db->getConnexion();
        $sql = "SELECT * FROM `likes` WHERE `user_id` = :user_id AND `post_id` = :post_id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':user_id', $_SESSION['id']);
        $stmt->bindParam(':post_id', $id_post);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * queryGetLikesByIDPost
     * @param int $id_post
     * @return array
     */
    public function queryGetLikesByIDPost(int $id_post)
    {
        $connection = $this->db->getConnexion();
        $sql = "SELECT * FROM `likes` WHERE `post_id` = :post_id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':post_id', $id_post);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
?>