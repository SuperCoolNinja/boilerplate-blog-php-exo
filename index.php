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
        $pseudo = null;

        // Check if the user is logged in
        if(!empty($_COOKIE['user']))
            $pseudo = $_COOKIE['user'];

        // Check if the url contains a page parameter
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            switch($page) 
            {
            case 'home':
                $this->controllerPosts->getPosts();
                break;
            case 'read-post':
                $this->controllerPosts->getPostByID();
                break;
            case 'create-post':

                // Check if we send a post request
                if(isset($_POST['submit'])) {
                    $title = htmlentities($_POST['title']);
                    $content = htmlentities($_POST['content']);
                    $image = $_POST['image'];
                    $author = htmlentities($pseudo);
                    $date = $_POST['date'];

                    // Insert the new post and redirect to the home page if all the fields are filled :
                    if($title != '' && $content != '' && $image != '' && $author != '' && $date != '')
                    {
                        $this->controllerPosts->insertNewPostBlog($title, $content, $image, $author, $date);      
                        header('Location: ?page=home');
                    }
                    else 
                    {
                        $submitError = '<p class="text-danger">Please fill all the fields.</p>';
                        include_once 'views/postform.php';
                    }
                }
                else include_once 'views/postform.php';
                break;
            case 'login':    

                // Check if the pseudo is not empty :
                if(!empty($_POST['pseudo']))
                {
                    // send the pseudo to the cookie and redirect to the postform page else display the login page :
                    setcookie('user', $_POST['pseudo']);
                    $pseudo = $_POST['pseudo'];
                    header('Location: ?page=create-post');
                }
                else 
                {
                    include_once 'views/login.php';
                }
                break;
            default:
                echo '404';
                break;
            }
        }
        else
        {
            //Check the action parameter
            if(isset($_GET['action'])) 
            {
                $action = $_GET['action'];
                switch($action) 
                {
                    case 'checkIsLogged':
                        // Check if the user is logged in then we redirect to the create-post page else we display the login page :
                        if($pseudo != null)
                             header('Location: ?page=create-post');
                        else header('Location: ?page=login');
                    break;
                case 'delete':
                    $this->controllerPosts->deletePost();
                    break;
                }
            }

            // If no page parameter, show the home page
            $this->controllerPosts->getPosts();
            include_once 'views/home.php';
        }
    }
}

$router = new Router();
$router->run();
?>