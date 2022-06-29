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
            switch($page) 
            {
            case 'home':
                $this->controllerPosts->getPosts();
                include_once 'views/home.php';
                break;
            case 'post':
                $this->controllerPosts->getPostsByID();
                include_once 'views/post.php';
                break;
                case 'postform':
                include_once 'views/postform.php';
                break;
            default:
                echo '404';
                break;
            }

            if(isset($_POST['submit'])) {
                $this->controllerPosts->insertNewPostBlog();
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