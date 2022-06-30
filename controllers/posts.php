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

    public function getPostByID()
    {
        $postsByID = $this->modelPosts->queryPostByID();
        include_once './views/post.php';
    }

    public function insertNewPostBlog($title, $content, $image, $author, $date)
    {
        $this->modelPosts->queryInsertNewBlog($title, $content, $image, $author, $date);
        $this->getPosts();
    }

    public function deletePost()
    {
        $this->modelPosts->queryDeletePost();
    }
}
?>