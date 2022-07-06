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
        $posts = $this->modelPosts->queryGetAllPosts();
        return $posts;
    }

    /**
     * Show all posts
     * array $usersPostsData
     * array $userProfilData
     */
    public function showPosts(array $usersPostsData, array $userProfilData)
    {
        include_once './views/posts/index.php';
    }

    /**
     * Create a new post
     * @param int $id_user
     * @param string $content
     * @param string $author
     * @param string $status
     */
    public function createPost(int $id_user, string $content, string $author, string $status)
    {
        $this->modelPosts->queryCreatePost($id_user, $content, $author, $status);
    }
}
?>