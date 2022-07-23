<?php


/*
    TODO : UPDATE USER ROLE.
*/
    class Users extends Controller
    {
        public function __construct(){
            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }

        /**
         * Register User
         */
        public function register()
        {
           if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $data = array(
                    'pseudo' => trim($_POST['pseudo']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['password-confirm']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                );

                // Validate Name
                if(empty($data['pseudo']))
                    $data['name_err'] = 'Please enter pseudo';
                elseif(strlen($data['pseudo']) < 3)
                    $data['name_err'] = 'Pseudo must be at least 3 characters';
                else
                {
                    // Check if name exists
                    if($this->userModel->findUserByPseudo($data['pseudo']))
                        $data['name_err'] = 'Pseudo is already taken';
                }

                // Validate Email
                if(empty($data['email']))
                    $data['email_err'] = 'Please enter email';
                elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
                    $data['email_err'] = 'Please enter a valid email';
                else
                {
                    if($this->userModel->findUserByEmail($data['email']))
                        $data['email_err'] = 'Email is already taken';
                }


                // Validate Password
                if(empty($data['password']))
                    $data['password_err'] = 'Please enter password';
                elseif(strlen($data['password']) < 6)
                    $data['password_err'] = 'Password must be at least 6 characters';

                // Validate Confirm Password
                if(empty($data['confirm_password']))
                    $data['confirm_password_err'] = 'Please confirm password';
                elseif($data['password'] != $data['confirm_password'])  
                    $data['confirm_password_err'] = 'Passwords do not match';


                // Make sure errors are empty
                if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
                {
                    // Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register User
                    if($this->userModel->register($data))
                    {
                        flash('register_success', 'You are registered and can log in');
                        redirect('users/login');
                    }
                    else die('Something went wrong');
                }
                else $this->view('users/register', $data);
            }
            else
            {
                // Init data
                $data = [
                    'pseudo' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                //Load View
                $this->view('users/register', $data);
            }
        }

        /**
         * Query Login User
         * @param  string $email
         * @param  string $password
         */
       
        public function login()
        {
           if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                //Init data
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',
                ];

                // Validate Email
                if(empty($data['email']))
                    $data['email_err'] = 'Please enter email';
                elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
                    $data['email_err'] = 'Please enter a valid email';

                // Validate Password
                if(empty($data['password']))
                    $data['password_err'] = 'Please enter password';
                elseif(strlen($data['password']) < 6)
                    $data['password_err'] = 'Password must be at least 6 characters';

                // Check for user/email
                if(!$this->userModel->findUserByEmail($data['email']))
                    $data['email_err'] = 'No user found';

                // Make sure errors are empty
                if(empty($data['email_err']) && empty($data['password_err']))
                {
                    // Authenticate User
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    if($loggedInUser)
                    {
                        // Create Session
                        $this->createUserSession($loggedInUser);
                        flash('login_success', 'You are logged in');
                    }
                    else
                    {
                        $data['password_err'] = 'Password incorrect';
                        $this->view('users/login', $data);
                    }
                }
                else
                {
                    // Load view with errors
                    $this->view('users/login', $data);
                }
            }
            else
            {
                // Init data
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '',
                ];

                //Load View
                $this->view('users/login', $data);
            }
        }

        /**
         * Create User Session
         * @param object $user
        */
        public function createUserSession($user)
        {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_pseudo'] = $user->pseudo;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_role'] = $user->role;
            $_SESSION['user_avatar'] = $user->avatar;
            $_SESSION['user_created_at'] = $user->created_at;
            $_SESSION['user_updated_at'] = $user->updated_at;
            $_SESSION['user_logged_in'] = true;

            redirect('posts/index');
        }

        /**
         * Logout User
        */
        public function logout()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_pseudo']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_role']);
            unset($_SESSION['user_avatar']);
            unset($_SESSION['user_created_at']);
            unset($_SESSION['user_updated_at']);
            unset($_SESSION['user_logged_in']);

            session_destroy();
            redirect('users/login');
        }
    }

?>