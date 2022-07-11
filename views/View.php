<?php
class View{
    private $_file;

    public function __construct($action){
        $this->_file = 'views/view'.$action.'.php';
    }

    /**
     * Display the view associated with the action
     * @param array $data
     */
    public function generate($data){
        $content = $this->generateFile($this->_file, $data);
        $view = $this->generateFile('views/templates/templateHome.php', array('content' => $content));
        echo $view;
    }


    /**
     * Generate a view file and return it as a string
     * @param string $file
     * @param array $data
     * @return string
     */
    private function generateFile($file, $data){
        if(file_exists($file)){
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        throw new Exception('File not found.');
    }
}
?>