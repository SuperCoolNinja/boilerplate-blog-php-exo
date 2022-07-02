<?php
include_once 'db.php';
class UsersModel
{
    // Create Instance of DB Classf
    public function __construct()
    {
        $this->db = new DB();
    }

    /**
     * Login
     * @param string $email
     */
    public function queryLogin(string $email)
    {
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('SELECT * FROM users WHERE email = :email');

        $query->execute([
            'email' => $email,
        ]);
        $result = $query->fetchAll();
        if($result)
        {
            //update isLoggedIn db to one : 
            $query = $connexion->prepare('UPDATE users SET isLoggedIn = 1 WHERE email = :email');
            foreach($result as $user)
            {
                $_SESSION['id'] = $user['id'];
                $query->execute([
                    'email' => $user['email']
                ]);
                break;
            }
            $_SESSION['loggedIn'] = true;
        }
    }

  
    /***
     * Register user
     * @param $pseudo
     * @param $password
     * @param $email
     */
    public function queryRegister(string $pseudo, string $password, string $email)
    {
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('INSERT INTO users (pseudo, password, email, isLoggedIn) VALUES (:pseudo, :password, :email, :isLoggedIn)');
        $query->execute([
            'pseudo' => $pseudo,
            'password' => $password,
            'email' => $email,
            'isLoggedIn' => 1
        ]);
        if($query)
        {
            $_SESSION['loggedIn'] = true;
            $_SESSION['id'] = $connexion->lastInsertId();
            header('Location: ?page=index');
        }
        else{
            echo '<div class="alert alert-danger" role="alert">';
            echo '<strong>Error!</strong> The email, password, or pseudo is not valid.';
            echo '</div>';
        }
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
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('UPDATE users SET pseudo = :pseudo, password = :password, email = :email WHERE id = :id');
        $query->execute([
            'id' => $id,
            'pseudo' => $pseudo,
            'password' => $password,
            'email' => $email
        ]);

    }

    
    /**
     * Delete user by ID
     * @param $id
     */
    public function queryDeleteUserByID(int $id)
    {
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('DELETE FROM users WHERE id = :id');
        $query->execute([
            'id' => $id
        ]);
        $_SESSION['loggedIn'] = false;
        $_SESSION['id'] = null;
        session_unset();
        session_destroy();
        header('Location: /blog/');
    }


    /**
     * Logout the user with his id.
     * @param $id
     */
    public function queryLogout(int $id)
    {
        $connexion = $this->db->getConnexion();
        //Set isLoggedIn from db to false : 
        $query = $connexion->prepare('UPDATE users SET isLoggedIn = 0 WHERE id = :id');
        $query->execute([
            'id' => $id
        ]);

        //Unset session :
        $_SESSION['loggedIn'] = false;
        $_SESSION['id'] = null;
        session_unset();
        session_destroy();
        header('Location: /blog/');
    }

    /***
     * Get all users
     * @return array
     */
    public function queryGetAllUsers()
    {
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('SELECT * FROM users');
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    /**
     * Get user by pseudo
     * @param $pseudo
     * @return array
     */
    public function queryGetUserByPseudo(string $pseudo)
    {
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
        $query->execute([
            'pseudo' => $pseudo
        ]);
        $result = $query->fetchAll();
        return $result;
    }

    /**
     * Get user by id
     * @param $id
     * @return array
     */
    public function queryGetUserById(int $id)
    {
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('SELECT * FROM users WHERE id = :id');
        $query->execute([
            'id' => $id
        ]);
        $result = $query->fetchAll();
        return $result;
    }

    /**
     * Get user by email
     * @param $email
     * @return array
     */
    public function queryGetUserByEmail(string $email)
    {
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute([
            'email' => $email
        ]);
        $result = $query->fetchAll();
        return $result;
    }

    /**
     * Check if user is admin by pseudo
     * @param $pseudo
     * @return bool
     */
    public function queryCheckIsAdminByPseudo(string $pseudo)
    {
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('SELECT is_admin FROM users WHERE pseudo = :pseudo');
        $query->execute([
            'pseudo' => $pseudo
        ]);
        $result = $query->fetch();
        if($result['is_admin'] == 1)
        {
            return true;
        }
        return false;
    }

    /**
     * Check if the email is valid : if it's already used
     * @param $email
     * @return bool
     */
    public function queryCheckEmail(string $email)
    {
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute([
            'email' => $email
        ]);
        $result = $query->fetch();
        if($result)
        {
            return true;
        }
        return false;
    }

    /**
     * Check if the pseudo is valid 
     * @param $pseudo
     * @return bool
     */
    public function queryCheckPseudo(string $pseudo) {
        $connection = $this->db->getConnexion();  
        $sql = "SELECT pseudo FROM users WHERE pseudo = '$pseudo'";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    /**
     * Check if the password is valid 
     * @param $password
     * @return bool
     */
    public function queryCheckPassword(string $password) {
        $connection = $this->db->getConnexion();  
        $sql = "SELECT password FROM users WHERE password = '$password'";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

}
?>