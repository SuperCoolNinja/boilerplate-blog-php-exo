<?php
 require_once('views/View.php');
 class ControllerLogin
 {
    private $post_manager;
    private $view;

    public function __construct($url)
    {
        if(isset($$url) && count($url) > 1)
            throw new Exception('url not found');
        else
            $this->loginPage();
    }

    /**
     * Display the login page
     */
    private function loginPage()
    {
        $this->view = new View('Login');
        $this->view->generate('login', array());
    }

}
?>