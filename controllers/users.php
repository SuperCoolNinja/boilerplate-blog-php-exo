<?php
include_once './models/users.php';
class UsersControllers
{
    public function __construct()
    {
        $this->modelUsers = new UsersModel();
    }

    /**
     * Get all data from users table
     * @return array
     */
    public function getUsers()
    {
        $users = $this->modelUsers->queryAllFromUsers();
        include_once './views/users.php';
    }

    /**
     * Get all data of a user by id.
     * @return array
     */
    public function getUserByID()
    {
        $usersByID = $this->modelUsers->queryUserByID();
        include_once './views/user.php';
    }


    /**
     * Insert a new user in the database.
     * @param $pseudo
     */
    public function insertNewUser($pseudo)
    {
        $this->modelUsers->queryInsertNewUser($pseudo);
        $this->getUsers();
    }
}
?>