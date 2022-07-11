<?php
require_once __DIR__ . '/../config/DB.php';

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
     * @param string $password
     */
    public function queryLogin(string $email, string $password)
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
            foreach($result as $data)
            {
                if(password_verify($password, $data['password']))
                {
                    // Set the data as logged in
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['id'] = $data['id'];
                    header('Location: /blog/');
                    $query = $connexion->prepare('UPDATE users SET isLoggedIn = 1 WHERE email = :email');
                    $query->execute([
                        'email' => $data['email']
                    ]);
                    break;
                }

                // Display an error message
                echo '<div class="alert alert-danger" role="alert">
                Wrong password
                </div>';
                break;
            }
        }
        else
        {
            //show message errror : 
            echo '<div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> Wrong email or password.
                </div>';
        }
    }

  
    /**
     * Register user
     * @param string $pseudo
     * @param string $password
     * @param string $email
     */
    public function queryRegister(string $pseudo, string $password, string $email)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('INSERT INTO users (pseudo, password, email, isLoggedIn, created_at) VALUES (:pseudo, :password, :email, :isLoggedIn, :created_at)');
        $query->execute([
            'pseudo' => $pseudo,
            'password' => $password,
            'email' => $email,
            'isLoggedIn' => 1,
            'created_at' => date('d/m/Y')
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
     * @param int $id
     * @param string $pseudo
     * @param string $password
     * @param string $email
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
     * @param int $id
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
     * @param int $id
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
        // $_SESSION['id'] = null;
        // session_unset();
        // session_destroy();
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
     * @param string $pseudo
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
     * @param int $id
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
     * @param string $email
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
     * @param string $pseudo
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
     * @param string $email
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
     * @param string $pseudo
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
     * @param string $password
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

    /**
     * Check if the user isLoggedIn == 1
     * @param int $id
     * @return bool
     */
    public function queryCheckIsLoggedIn(int $id) {
        $connection = $this->db->getConnexion();  
        $sql = "SELECT isLoggedIn FROM users WHERE id = '$id'";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result['isLoggedIn'] == 1)
            return true;
        return false;
    }


    /**
     * Update the status
     * @param int $id
     * @param string $status
     */
    public function querySetStatus(int $id, string $status)
    {
        $connexion = $this->db->getConnexion();
        $query = $connexion->prepare('UPDATE users SET status = :status WHERE id = :id');
        $query->execute([
            'id' => $id,
            'status' => $status
        ]);
    }
}
?>