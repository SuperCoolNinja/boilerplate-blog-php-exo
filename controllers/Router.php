<?php
 require_once('views/View.php');
class Router
{
    private $_ctrl;
    private $view;

    public function routeReq() : void 
    {
        try
        {
            //Autoload our controllers for us :
            spl_autoload_register(function($class){
                include_once('models/' . $class . '.php');
            });

            $url = "";

            if (isset($_GET['url']))
            {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = 'Controller'.$controller;
                $controllerFile = 'controllers/'.$controllerClass.'.php';

                if(file_exists($controllerFile))
                {
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                }
                else throw new Exception('url not found');
            }else
            {
                require_once('controllers/ControllerPosts.php');
                $this->_ctrl = new ControllerPosts($url);
            }
        }
        catch(Exception $e)
        {
            $errorMsg = $e->getMessage();
            $this->view = new View('Error');
            $this->view->generate(array('errorMsg' => $errorMsg));
        }
    }
    
    // public function run()
    // {
    //     session_start();

    //     // Get the parameters from the URL
    //     $page = isset($_GET['page']) ? $_GET['page'] : 'index';

    //     // Check if the page exists
    //     switch($page)
    //     {
    //         case 'index':
    //             // Check if the user have have session storage then it means he already created an account :
    //             if(isset($_SESSION['loggedIn']) && isset($_SESSION['id']))
    //             {
    //                 //Check if the user as an account register in db as well : 
    //                 if($this->controllerUsers->getUserByID($_SESSION['id']))
    //                 {
    //                     //Check if the user is logged in :
    //                     if($this->controllerUsers->checkLoggedIn($_SESSION['id']))
    //                     {
    //                         if(isset($_POST['submit-status']))
    //                         {
    //                             $new_status = htmlspecialchars($_POST['status']);
    //                             $this->controllerUsers->setStatus($_SESSION['id'], $new_status);
    //                         }

    //                         if(isset($_POST['submit-post']))
    //                         {
    //                             $new_post = htmlspecialchars($_POST['post']);
    //                             $daata =  $this->controllerUsers->getUserByID($_SESSION['id']);
    //                             foreach($daata as $user)
    //                                 $this->controllerPosts->createPost($user['id'], $new_post, $user['pseudo'], $user['status']);
    //                         }

                           
    //                         if(isset($_POST['submit-like']))
    //                         {
    //                             $id_post = htmlspecialchars($_GET['id_post']);
    //                             $data = $this->controllerPosts->getPostByID($id_post);

    //                             $isPostAlreadyLiked = $this->controllerPosts->isPostAlreadyLiked($id_post);

    //                             if(!$isPostAlreadyLiked)
    //                             {
    //                                 foreach($data as $post)
    //                                     $this->controllerPosts->updateLike(intval($id_post), intval($post['likes']));
    //                             }
    //                         }

    //                         if(isset($_POST['submit-delete']))
    //                         {
    //                             $id_post = htmlspecialchars($_GET['id_post']);
    //                             $this->controllerPosts->deletePost($id_post);
    //                         }

    //                         $userProfilData =  $this->controllerUsers->getUserByID($_SESSION['id']);
    //                         $usersPostsData = $this->controllerPosts->getPosts();
    //                         $this->controllerPosts->showPosts($usersPostsData, $userProfilData);
    //                     }else header('Location: ?page=login');
    //                 }else header('Location: ?page=register');
    //             }else header('Location: ?page=login');
    //             break;
    //         case 'login':
    //             include_once './views/users/login.php';
                
    //             if(isset($_POST['submit']))
    //             {
    //                 if(isset($_POST['email']) && isset($_POST['password']))
    //                 {
    //                     //Secure input :
    //                     $email = htmlspecialchars($_POST['email']);
    //                     $password = htmlspecialchars($_POST['password']);
    //                     $this->controllerUsers->login($email, $password);
    //                     break;
    //                 }

    //                 echo '<div class="alert alert-danger" role="alert">
    //                 Please fill all the fields.
    //                 </div>';
    //                 break;
    //             }
    //             break;
    //         case 'register':
    //             include_once './views/users/register.php';
    //             if(isset($_POST['submit']))
    //             {
    //                 $isInputSet = (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password-confirm']) && !empty($_POST['pseudo']));
    //                 if($isInputSet)
    //                 {
    //                     // Secure input :
    //                     $email = htmlspecialchars($_POST['email']);
    //                     $password = htmlspecialchars($_POST['password']);
    //                     $passwordConfirm = htmlspecialchars($_POST['password-confirm']);
    //                     $pseudo = htmlspecialchars($_POST['pseudo']);

    //                     $errors = array();

    //                     // Check if the email, pseudo does not exist in the db :
    //                     if($this->controllerUsers->checkEmail($email))
    //                         $errors['email'] = 'Email already exists';

    //                     if($this->controllerUsers->checkPseudo($pseudo))
    //                         $errors['pseudo'] = 'Pseudo already exists';

    //                     if($password !== $passwordConfirm) 
    //                         $errors['password'] = 'Passwords do not match';

    //                     if(count($errors) > 0)
    //                         header('Location: ?page=register&errors='.json_encode($errors).'&email='.$email.'&pseudo='.$pseudo);
    //                     else $this->controllerUsers->register($pseudo, $password, $email);
    //                     break;
    //                 }

    //                 echo '<div class="alert alert-danger" role="alert">
    //                 Please fill all the fields.
    //                 </div>';
    //             }
    //             break;
    //             case 'logout':
    //                 $this->controllerUsers->logout($_SESSION['id']);
    //                 header('Location: ?page=index');
    //             break;
    //         case 'admin':
    //             $this->controllerUsers->admin();
    //             break;
    //         default:
    //             echo 'Page not found';
    //             break;
    //     }

    //     if(isset($_GET['action']))
    //     {

    //         $action = isset($_GET['action']) ? $_GET['action'] : '';

    //         // Check the action
    //         switch($action)
    //         {
                
    //             default:
    //                 break;
    //         }
    //     }

    // }
}
?>