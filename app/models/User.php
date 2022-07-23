<?php

    class User extends Database
    {
        private $db;
        public function __construct(){
            $this->db = new Database;
        }


        /**
         * Find user by email
         * @param string $email
         */
        public function findUserByEmail(string $email)
        {
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            if($this->db->rowCount() > 0)
                return true;

            return false;
        }

        /**
         * Find user by pseudo
         * @param string $pseudo
         */
        public function findUserByPseudo(string $pseudo)
        {
            $this->db->query('SELECT * FROM users WHERE pseudo = :pseudo');
            $this->db->bind(':pseudo', $pseudo);

            $row = $this->db->single();

            if($this->db->rowCount() > 0)
                return true;

            return false;
        }

        /**
         * Find user by id
         * @param int $id
         */
        public function findUserByID(int $id)
        {
            $this->db->query('SELECT * FROM users WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            if($this->db->rowCount() > 0)
                return true;

            return false;
        }

        /**
         * Register User
         * @param array $data
         * @return bool
         */
        public function register(array $data) : bool
        {
            // Prepare query
            $this->db->query('INSERT INTO users (pseudo, password, email, isLoggedIn, created_at) VALUES (:pseudo, :password, :email, :isLoggedIn, :created_at)');

            // Bind values
            $this->db->bind(':pseudo', $data['pseudo']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':isLoggedIn', 1);
            $this->db->bind(':created_at', date('d/m/Y'));

            // Execute query
            if($this->db->execute())
                return true;

            return false;
        }

        /**
         * Login User
         * @param string $email
         * @param string $password
         * @return bool
         */
        public function login(string $email, string $password)
        {
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            if($this->db->rowCount() > 0)
                if(password_verify($password, $row->password))
                    return $row;
            return false;
        }

        /*
            Get User data by ID
            @param int $id
        */
        public function getUserDataByID(int $id)
        {
            $this->db->query('SELECT * FROM users WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            if($this->db->rowCount() > 0)
                return $row;

            return false;
        }

        /**
         * Is user logged in
         * @param int $id
         * @return bool
        */
        public function isLoggedIn(int $id)
        {
            $this->db->query('SELECT * FROM users WHERE id = :id AND isLoggedIn = 1');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            if($this->db->rowCount() > 0)
                return true;

            return false;
        }

        /**
         * Update role of user
         * @param int $id
         * @param string $role
         */
        public function updateRole(int $id, string $role)
        {
            $this->db->query('UPDATE users SET role = :role WHERE id = :id');
            $this->db->bind(':id', $id);
            $this->db->bind(':role', $role);

            $this->db->execute();
        }

        /**
         * isAdmin
         * @param int $id
         * @return bool
         */
        public function isAdmin(int $id)
        {
            $this->db->query('SELECT id, role FROM users WHERE id = :id AND role = "admin"');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            if($this->db->rowCount() > 0)
                return true;

            return false;
        }

        /**
         * updateStatus
         * @param int $id
         * @param string $status
         */
        public function updateStatus(int $id, string $status)
        {
            //Update user status 
            $this->db->query('UPDATE users SET status = :status WHERE id = :id');
            $this->db->bind(':id', $id);
            $this->db->bind(':status', $status);
            $this->db->execute();
        }
    }

?>