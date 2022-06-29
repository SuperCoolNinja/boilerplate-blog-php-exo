<?php
include_once 'controllers/posts.php';

class Router
{
    public function __construct()
    {
        $this->controllerPosts = new ControllerPosts();
    }
    
    public function run()
    {

        // Check if the url contains a page parameter
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 'home') {
                $this->controllerPosts->getPosts();
                include_once 'views/home.php';
            } elseif ($page == 'post') {
                $this->controllerPosts->getPostsByID();
                include_once 'views/post.php';
            } else {
                echo '404';
            }
        }
        else
        {
            $this->controllerPosts->getPosts();
            include_once 'views/home.php';
        }
    }
}

$router = new Router();
$router->run();
?>