<?php
include_once './models/UsersModel.php';
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
    public function login(string $email, string $password) : void
    {
        $this->modelUsers->queryLogin($email, $password);
    }


    /**
     * Register user
     * @param string $pseudo
     * @param string $password
     * @param string $email
     */
    public function register(string $pseudo, string $password, string $email) : void
    {
        $this->modelUsers->queryRegister($pseudo, $password, $email);
    }

    /**
     * Update user
     * @param int $id
     * @param string $username
     * @param string $password
     * @param string $email
     */
    public function updateUser(int $id, string $username, string $password, string $email) : void
    {
        $this->modelUsers->queryUpdateUser($id, $username, $password, $email);
    }

    /**
     * Delete user by ID
     * @param int $id
     */
    public function deleteUserByID(int $id) : void
    {
        $this->modelUsers->queryDeleteUserByID($id);
    }

    /**
     * Logout
     * @param int $id
     */
    public function logout(int $id) : void
    {
        $this->modelUsers->queryLogout($id);
    }

    /**
     * Get all users
     */
    public function getAllUsers() : array
    {
        $result = $this->modelUsers->queryGetAllUsers(); 
        return $result;
    }

    /**
     * Get user by ID
     * @param string $id
     * @return array
     */
    public function getUserByID(int $id) : array
    {
        $result = $this->modelUsers->queryGetUserByID($id);
        return $result;
    }

    /**
     * Get user by email
     * @param string $email
     * @return array
     */
    public function getUserByEmail(string $email) : array
    {
        $result = $this->modelUsers->queryGetUserByEmail($email);
        return $result;
    }

    /**
     * Get user by pseudo
     * @param string $pseudo
     * @return array
     */
    public function getUserByPseudo(string $pseudo) : array
    {
        $result = $this->modelUsers->queryGetUserByPseudo($pseudo);
        return $result;
    }


    /**
     * Check if the email is valid
     * @param string $email
     * @return bool
     */
    public function checkEmail(string $email) : bool
    {
        return $this->modelUsers->queryCheckEmail($email);
    }

    /**
     * Check if the pseudo is valid
     * @param string $pseudo
     * @return bool
     */
    public function checkPseudo(string $pseudo) : bool
    {
        return $this->modelUsers->queryCheckPseudo($pseudo);
    }

    /**
     * Check if the password is valid
     * @param string $password
     * @return bool
     */
    public function checkPassword(string $password) : bool
    {
        return $this->modelUsers->queryCheckPassword($password);
    }

    /**
     * Check if the user is loggedIn
     * @param int $id
     * @return bool
     */
    public function checkLoggedIn(int $id) : bool
    {
        return $this->modelUsers->queryCheckIsLoggedIn($id);
    }

    /**
     * setStatus
     * @param int $id
     * @param string $status
     */
    public function setStatus(int $id, string $status) : void
    {
        $this->modelUsers->querySetStatus($id, $status);
    }
   
}
?>