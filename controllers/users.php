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
     * @param string $email
     * @param string $password
     */
    public function login(string $email, string $password)
    {
        $this->modelUsers->queryLogin($email, $password);
    }


    /**
     * Register user
     * @param $pseudo
     * @param $password
     * @param $email
     */
    public function register(string $pseudo, string $password, string $email)
    {
        $this->modelUsers->queryRegister($pseudo, $password, $email);
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
        $result = $this->modelUsers->queryGetAllUsers();
        return $result;
    }

    /**
     * Get user by ID
     * @param $id
     * @return array
     */
    public function getUserByID(int $id)
    {
        $result = $this->modelUsers->queryGetUserByID($id);
        return $result;
    }

    /**
     * Get user by email
     * @param $email
     * @return array
     */
    public function getUserByEmail(string $email)
    {
        $result = $this->modelUsers->queryGetUserByEmail($email);
        return $result;
    }

    /**
     * Get user by pseudo
     * @param $pseudo
     * @return array
     */
    public function getUserByPseudo(string $pseudo)
    {
        $result = $this->modelUsers->queryGetUserByPseudo($pseudo);
        return $result;
    }


    /**
     * Check if the email is valid
     * @param $email
     * @return bool
     */
    public function checkEmail(string $email)
    {
        return $this->modelUsers->queryCheckEmail($email);
    }

    /**
     * Check if the pseudo is valid
     * @param $pseudo
     * @return bool
     */
    public function checkPseudo(string $pseudo)
    {
        return $this->modelUsers->queryCheckPseudo($pseudo);
    }

    /**
     * Check if the password is valid
     * @param $password
     * @return bool
     */
    public function checkPassword(string $password)
    {
        return $this->modelUsers->queryCheckPassword($password);
    }

    /**
     * Check if the user is loggedIn
     * @param $id
     * @return bool
     */
    public function checkLoggedIn(int $id)
    {
        return $this->modelUsers->queryCheckIsLoggedIn($id);
    }
}
?>