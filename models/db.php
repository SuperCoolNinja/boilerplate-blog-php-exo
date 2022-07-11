<?php

    class DB {
        //Declare private variables to hold connection information :
        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $dbname = "blog";


        //Methode to connect to the database :
        public function getConnexion()
        {
            try {
                $db = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8" , $this->user, $this->pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $db;
            } catch (PDOException $e) {
                echo "Error : " . $e->getMessage();
            }
        }
    }
?>