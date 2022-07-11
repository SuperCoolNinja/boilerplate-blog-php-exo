<?php
 require_once('views/View.php');
 class ControllerPosts 
 {
    private $post_manager;
    private $view;

    public function __construct($url)
    {
        if(isset($$url) && count($url) > 1)
            throw new Exception('url not found');
        else
            $this->posts();
    }

    /**
     * Display the list of posts
     */
    private function posts()
    {
        $this->post_manager = new PostManager();
        $posts = $this->post_manager->getPosts();
        $this->view = new View('Home');
        $this->view->generate(array('posts' => $posts));
    }
 }
?>