<?php
include_once 'controllers/posts.php';
include_once 'controllers/users.php';
include_once 'models/db.php';
class Router
{
    public function __construct()
    {
        $this->controllerPosts = new ControllerPosts();
        $this->controllerUsers = new ControllerUsers();
        $this->db = new DB();
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
                if(isset($_SESSION['loggedIn']) && isset($_SESSION['id']))
                    if($_SESSION['loggedIn'] === true)
                    {
                        $userProfilData =  $this->controllerUsers->getUserByID($_SESSION['id']);
                        $usersPostsData = $this->controllerPosts->getPosts();
                        $this->controllerPosts->showPosts($usersPostsData, $userProfilData);
                    }else header('Location: ?page=login');
                else header('Location: ?page=register');
                break;
            case 'login':
                include_once './views/users/login.php';
                if(isset($_POST['submit']))
                {
                    //Check if input are set :
                    if(isset($_POST['email']) && isset($_POST['password']))
                    {
                        //Secure input :
                        $email = htmlspecialchars($_POST['email']);
                        $password = htmlspecialchars($_POST['password']);

                        // Check if the user exists
                        $bdd = $this->db->getConnexion();
                        $check = $bdd->prepare('SELECT id, password FROM users WHERE email = ?');
                        $check->execute(array($email));
                        $data = $check->fetch();
                        $row = $check->rowCount();

                        if($row > 0)
                        {
                            
                            if(password_verify($password, $data['password']))
                            {
                                // Set the user as logged in
                                $_SESSION['loggedIn'] = true;
                                $_SESSION['id'] = $data['id'];
                                header('Location: /blog/');
                            }
                            else
                            {
                                // Display an error message
                                echo '<div class="alert alert-danger" role="alert">
                                Wrong password
                                </div>';
                            }
                        }
                        else 
                        {
                            //show message errror : 
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Error!</strong> Wrong email or password.
                                </div>';
                        }
                    }
                    else 
                    {
                        echo '<div class="alert alert-danger" role="alert">
                        Please fill all the fields.
                        </div>';
                    }
                }
                break;
            case 'logout':
                $this->controllerUsers->logout();
                break;
            case 'register':
                include_once './views/users/register.php';
                if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password-confirm']) && !empty($_POST['pseudo']))
                {
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    $passwordConfirm = htmlspecialchars($_POST['password-confirm']);
                    $pseudo = htmlspecialchars($_POST['pseudo']);


                    // Check if the email, pseudo exist :
                    if(!$this->controllerUsers->checkEmail($email) && !$this->controllerUsers->checkPseudo($pseudo))
                    {
                        if($password === $passwordConfirm)
                        {
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            $this->controllerUsers->register($pseudo, $password, $email);
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