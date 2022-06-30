<?php
include_once 'db.php';
class UsersModel
{
    // Create Instance of DB Class
    public function __construct()
    {
        $this->db = new DB();
    }

    /***
     * Get all data from users table
     * @return array
     */
    public function queryAllFromUsers()
    {
        $connexion = $this->db->connexion();
        $sql = "SELECT * FROM users";
        $result = $connexion->query($sql);
        return $result;
    }

    /**
     * Get all data of a user by id.
     * @return array
     */
    public function queryUserByID()
    {
        $connexion = $this->db->connexion();
        $sql = "SELECT * FROM users WHERE id = :id";
        $result = $connexion->prepare($sql);
        $result->bindParam(':id', $_GET['id']);
        $result->execute();
        return $result;
    }

    /**
     * Insert a new user in the database.
     * @param $pseudo
     */
    public function queryInsertNewUser($pseudo)
    {
        $connexion = $this->db->connexion();
        $sql = "INSERT INTO users (pseudo) VALUES (:pseudo)";
        $result = $connexion->prepare($sql);
        $result->bindParam(':pseudo', $pseudo);
        $result->execute();
        return $result;
    }
}
?>