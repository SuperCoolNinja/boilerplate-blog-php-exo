<?php

    //Load Config
    require_once '../app/config/config.php';

    //Load Helpers
    require_once '../app/helpers/url_helper.php';
    
    //Load Session Helper
    require_once '../app/helpers/session_helper.php';

    //AUTOLOAD CORE LIB
    spl_autoload_register(function($className){
        require_once 'lib/' . $className . '.php';
    });
?>