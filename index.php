<?php
include_once 'controllers/posts.php';
include_once 'controllers/users.php';
class Router
{
    public function __construct()
    {
        $this->controllerPosts = new ControllerPosts();
        $this->controllerUsers = new ControllerUsers();
    }
    
    public function run()
    {
        // Get the parameters from the URL
        $page = isset($_GET['page']) ? $_GET['page'] : 'index';
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        // Check if the page exists
        switch($page)
        {
            case 'index':
                $this->controllerPosts->getPosts();
                break;
            case 'login':
                $this->controllerUsers->login();
                break;
            case 'logout':
                $this->controllerUsers->logout();
                break;
            case 'register':
                $this->controllerUsers->register();
                break;
            case 'admin':
                $this->controllerUsers->admin();
                break;
         
            default:
                echo 'Page not found';
                break;
        }

        // Check the action
        switch($action)
        {
            case 'comment':
                $this->controllerPosts->commentPost();
                break;
            case 'add':
                $this->controllerPosts->addPost();
                break;
            case 'edit':
                $this->controllerPosts->editPost();
                break;
            case 'delete':
                $this->controllerPosts->deletePost();
                break;
            case 'like':
                $this->controllerPosts->likePost();
                break;
            case 'logout':
                    $this->controllerUser->logout();
                break;
            default:
                echo 'Action not found';
                break;
        }
        

    }
}

$router = new Router();
$router->run();
?>