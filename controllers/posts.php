<?php
include_once './models/posts.php';
class ControllerPosts{
    public function __construct()
    {
       $this->modelPosts = new ModelPosts();
    }

    /**
     * Get all posts
     * @return array
     */
    public function getPosts()
    {
        $posts = $this->modelPosts->getAllPosts();
        include_once './views/posts/index.php';
    }

    /**
     * Show all posts
     * @param array $posts
     */
    public function showPosts($posts)
    {
        include_once './views/posts/index.php';
    }
    
}
?>