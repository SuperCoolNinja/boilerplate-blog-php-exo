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
        session_start();

        // Get the parameters from the URL
        $page = isset($_GET['page']) ? $_GET['page'] : 'index';

        // Check if the page exists
        switch($page)
        {
            case 'index':
                // Check if the user is logged in
                if(isset($_SESSION['loggedIn']))
                    if($_SESSION['loggedIn'] === true)
                    {
                        $posts = $this->controllerPosts->getPosts();
                        $this->controllerPosts->showPosts($posts);
                    }else header('Location: ?page=login');
                else header('Location: ?page=register');
                break;
            case 'login':
                $isLoginSuccess = $this->controllerUsers->login();
                if($isLoginSuccess) 
                    header('Location: ?page=index');
                else 
                {
                    // Display the error message
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '<strong>Error!</strong> The email, password, or pseudo is not valid.';
                    echo '</div>';
                }
                break;
            case 'logout':
                $this->controllerUsers->logout();
                break;
            case 'register':
                include_once './views/users/register.php';
                if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-confirm']) && isset($_POST['pseudo']))
                {
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    $passwordConfirm = htmlspecialchars($_POST['password-confirm']);
                    $pseudo = htmlspecialchars($_POST['pseudo']);

                    if($password === $passwordConfirm)
                    {
                        // Check if the email, password, pseudo are valid
                        if(!$this->controllerUsers->checkEmail($email) && !$this->controllerUsers->checkPseudo($pseudo))
                        {
                            $this->controllerUsers->register($email, $password, $pseudo);
                        }
                        else
                        {
                            // Display if the email, password, or pseudo is not valid
                            echo '<div class="alert alert-danger" role="alert">';
                            echo '<strong>Error!</strong> The email, password, or pseudo is not valid.';
                            echo '</div>';
                        }
                    }
                    else
                    {
                        // Display if the password and the password confirmation are not the same
                        echo '<div class="alert alert-danger" role="alert">';
                        echo '<strong>Error!</strong> The passwords do not match.';
                        echo '</div>';
                    }
                }
                break;
            case 'admin':
                $this->controllerUsers->admin();
                break;
            default:
                echo 'Page not found';
                break;
        }

        if(isset($_GET['action']))
        {
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
}

$router = new Router();
$router->run();
?>