<?php

    /**
     * Redirect to a different page
     * @param string $url
     */
    function redirect($url)
    {
        header('Location: ' . URL_ROOT . '/' . $url);
    }
?>