<?php 
class PostManager extends Model
{
    /**
     * Get all posts
     * @return array
     */
    public function getPosts() : array
    {
        $posts = $this->getAll('posts', 'Post');
        return $posts;
    }

    /**
     * Get a post by ID
     * @param int $id_post
     * @return array
     */
    public function getPostByID(int $id_post) : array
    {
        $post = $this->modelPosts->queryGetPostByID($id_post);
        return $post;
    }

    /**
     * Show all posts
     * array $usersPostsData
     * array $userProfilData
     */
    public function showPosts(array $usersPostsData, array $userProfilData) : void
    {
        $likes = array();
        foreach($usersPostsData as $posts)
            $likes[] = $this->modelPosts->queryGetLikesByIDPost($posts['id']);
       
        //get id of all posts
        include_once './views/posts/index.php';
    }

    /**
     * Create a new post
     * @param int $id_user
     * @param string $content
     * @param string $author
     * @param string $status
     */
    public function createPost(int $id_user, string $content, string $author, string $status) : void
    {
        $this->modelPosts->queryCreatePost($id_user, $content, $author, $status);
    }

    /**
     * Update Like of a post
     * @param int $id_post
     * @param int $like
     */
    public function updateLike(int $id_post, int $like) : void
    {
        $like = $like + 1;
        $this->modelPosts->queryUpdateLike($id_post, $like);
    }
    
    /**
     * Check if the user has already liked the post
     * @param int $id_post
     * @return boolean
     */
    public function isPostAlreadyLiked(int $id_post) : bool
    {
        return $this->modelPosts->queryCheckLike($id_post);
    }

    /**
     * Delete a post
     * @param int $id_post
     */
    public function deletePost(int $id_post) : void
    {
        $this->modelPosts->queryDeletePost($id_post);
    }
}
?>