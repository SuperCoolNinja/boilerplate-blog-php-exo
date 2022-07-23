<?php
    class Posts extends Controller
    {
        public function __construct()
        {
            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');

            //Check if the player is logged in
            if(!isSessionLoggedIn())
                redirect('users/login');
            
            if(!$this->userModel->isLoggedIn($_SESSION['user_id']))
                redirect('users/login');

            //Check if the player is an admin
            if($this->userModel->isAdmin($_SESSION['user_id']))
                $_SESSION['user_role'] = "admin";
            else $_SESSION['user_role'] = "user";
        }


        /**
         * Display the posts index page
         */
        public function index()
        {
            $posts = $this->postModel->getPosts();
            $userData = $this->userModel->getUserDataByID($_SESSION['user_id']);

            $likes = array();
            foreach($posts as $post)
                $likes[] = $this->postModel->getLikesPostByID($post->id);

            $data = [
                'posts' => $posts,
                'likes' => $likes,
                'user_id' => $_SESSION['user_id'],
                'userData' => $userData,
                'author' => $userData->pseudo,
                'status' => $userData->status,
                'content' => '',
                'content_err'=> ''
            ];

            if(isset($_POST['submit-post']))
            {
                $data['content'] = $_POST['content'];

                if(empty($data['content']))
                    $data['content_err'] = 'Please enter content';
                else if(strlen($data['content']) > 255)
                    $data['content_err'] = 'Content must be less than 255 characters';
                else
                {
                    $data['content'] = htmlspecialchars($data['content']);
                    $this->postModel->addPost($data);
                    redirect('posts');
                }
            }

            if(isset($_POST['submit-like']))
            {
                $liked = $this->postModel->isPostLikedByUser($_GET['post_id'], $_SESSION['user_id']);
                if(!$liked)
                    $this->postModel->addLike($_GET['post_id'], $_SESSION['user_id']);
                
                redirect('posts');
            }

            if(isset($_POST['submit-delete']))
            {
                $this->postModel->deletePost($_GET['post_id']);
                redirect('posts');
            }

            if(isset($_POST['submit-status']))
            {
                $this->userModel->updateStatus($_SESSION['user_id'], $_POST['status']);
                redirect('posts');
            }

           $this->view('posts/index', $data);
        }
       
    }
?>