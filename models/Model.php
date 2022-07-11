<?php declare(strict_types = 1);

abstract class Model 
{
    private static $bdd;

    /**
     * Method to connect to the database :
     * @return PDO
     */
    private static function setDB() : void
    {
        //Declare private variables to hold connection information :
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "blog";

        self::$bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8" , $user, $pass);
        self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    /**
     * Method to get the connection to the database :
     * @return PDO
     */
    protected function getDB() : PDO
    {
        if(self::$bdd == null) 
            self::setDB();

        return self::$bdd;
    }


    /**
     * Method to get all data from a particular table from the database :
     * @param string $table
     * @param array $objName
     * @return array
     */
    protected function getAll(string $table, string $objName) : array
    {
        $db = $this->getDB();
        $query = $db->prepare("SELECT * FROM $table ORDER BY id DESC");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $obj = [];
        foreach($data as $row)
            $obj[] = new $objName($row);
        return $obj;
    }
}

?>