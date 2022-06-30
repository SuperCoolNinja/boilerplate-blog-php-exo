<?php
include_once 'db.php';
class UsersModel
{
    // Create Instance of DB Class
    public function __construct()
    {
        $this->db = new DB();
    }

    /**
     * Login
     * @param string $pseudo
     * @param string $password
     */
    public function queryLogin(string $pseudo, string $password)
    {
        $sql = "SELECT * FROM users WHERE pseudo = '$pseudo' AND password = '$password'";
        $this->db->query($sql);
    }

  
    /***
     * Register user
     * @param $pseudo
     * @param $password
     * @param $email
     */
    public function queryRegister(string $pseudo, string $password, string $email)
    {
        $sql = "INSERT INTO users (pseudo, password, email) VALUES ('$pseudo', '$password', '$email')";
        $this->db->query($sql);
    }

    /**
     * Update user
     * @param $id
     * @param $pseudo
     * @param $password
     * @param $email
     */
    public function queryUpdateUser(int $id, string $pseudo, string $password, string $email)
    {
        $sql = "UPDATE users SET pseudo = '$pseudo', password = '$password', email = '$email' WHERE id = $id";
        $this->db->query($sql);
    }

    
    /**
     * Delete user by ID
     * @param $id
     */
    public function queryDeleteUserByID(int $id)
    {
        $sql = "DELETE FROM users WHERE id = $id";
        $this->db->query($sql);
    }


    // Query Logout 
    public function queryLogout()
    {
        unset($_COOKIE['pseudo']);
        setcookie('pseudo', '', time() - 3600);
        header('Location: /blog/');
    }

    /***
     * Get all users
     * @return array
     */
    public function queryGetAllUsers()
    {
        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);
        return $result;
    }

    /**
     * Get user by pseudo
     * @param $pseudo
     * @return array
     */
    public function queryGetUserByPseudo(string $pseudo)
    {
        $sql = "SELECT * FROM users WHERE pseudo = '$pseudo'";
        $result = $this->db->query($sql);
        return $result;
    }

    /**
     * Get user by id
     * @param $id
     * @return array
     */
    public function queryGetUserById(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $this->db->query($sql);
        return $result;
    }

    /**
     * Get user by email
     * @param $email
     * @return array
     */
    public function queryGetUserByEmail(string $email)
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->db->query($sql);
        return $result;
    }

    /**
     * Check if user is admin by pseudo
     * @param $pseudo
     * @return bool
     */
    public function queryCheckIsAdminByPseudo(string $pseudo)
    {
        $sql = "SELECT pseudo, role FROM users WHERE pseudo = '$pseudo' AND role = 'admin'";
        $result = $this->db->query($sql);
        return $result;
    }

}
?>