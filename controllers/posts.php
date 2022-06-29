<?php
include_once './models/posts.php';
class ControllerPosts{
    public function __construct()
    {
       $this->modelPosts = new ModelPosts();
    }

   
    public function getPosts()
    {
        $posts = $this->modelPosts->queryAllFromPosts();
        include_once './views/home.php';
    }

    public function getPostsByID()
    {
        $postsByID = $this->modelPosts->queryPostsByID();
        include_once './views/post.php';
    }
}
?>