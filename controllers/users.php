<?php
include_once './models/users.php';
class ControllerUsers
{
    public function __construct()
    {
        $this->modelUsers = new UsersModel();
    }

    /**
     * Login
     * @param string $login
     * @param string $password
     */
    public function login(string $username, string $password)
    {
        $this->modelUsers->queryLogin($username, $password);
    }


    /**
     * Register user
     * @param $username
     * @param $password
     * @param $email
     */
    public function register(string $username, string $password, string $email)
    {
        $this->modelUsers->queryRegister($username, $password, $email);
    }

    /**
     * Update user
     * @param $id
     * @param $username
     * @param $password
     * @param $email
     */
    public function updateUser(int $id, string $username, string $password, string $email)
    {
        $this->modelUsers->queryUpdateUser($id, $username, $password, $email);
    }

    /**
     * Delete user by ID
     * @param $id
     */
    public function deleteUserByID(int $id)
    {
        $this->modelUsers->queryDeleteUserByID($id);
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->modelUsers->queryLogout();
    }

    /**
     * Get all users
     */
    public function getAllUsers()
    {
        $this->modelUsers->queryGetAllUsers();
    }

    /**
     * Get user by ID
     * @param $id
     */
    public function getUserByID(int $id)
    {
        $this->modelUsers->queryGetUserByID($id);
    }

    /**
     * Get user by email
     * @param $email
     */
    public function getUserByEmail(string $email)
    {
        $this->modelUsers->queryGetUserByEmail($email);
    }

    /**
     * Get user by pseudo
     * @param $pseudo
     */
    public function getUserByPseudo(string $pseudo)
    {
        $this->modelUsers->queryGetUserByPseudo($pseudo);
    }
}
?>