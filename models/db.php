<?php

    class DB {
        //Declare private variables to hold connection information :
        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $dbname = "blog";


        //Methode to connect to the database :
        public function connexion()
        {
            try {
                $db = new PDO("mysql:host={$this->host};dbname={$this->dbname}" , $this->user, $this->pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->exec("set names utf8");
                return $db;
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }
    }
?>