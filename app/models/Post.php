<?php
    class Post extends Database
    {
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }


        /**
         * Get all posts
         * @return array
         */
        public function getPosts()
        {
            $this->db->query('SELECT * FROM posts ORDER BY created_at DESC');
            $results = $this->db->resultSet();
            return $results;
        }
        

        /***
         * getLikesPostByID
         * @param $id
         * @return array
         */
        public function getLikesPostByID($id)
        {
            $this->db->query('SELECT * FROM likes WHERE post_id = :id');
            $this->db->bind(':id', $id);
            $results = $this->db->resultSet();
            return $results;
        }

         /**
         * is Post Already liked by the user id
         * @param int $post_id
         * @param int $user_id
         * @return boolean
         */
        public function isPostLikedByUser(int $post_id, int $user_id)
        {
            $this->db->query('SELECT * FROM likes WHERE post_id = :post_id AND user_id = :user_id');
            $this->db->bind(':post_id', $post_id);
            $this->db->bind(':user_id', $user_id);
            $row = $this->db->single();
            if($this->db->rowCount() > 0)
                return true;
            return false;
        }

        /**
         * Add a post
         * @param $data
         */
        public function addPost($data)
        {
            $sql = "INSERT INTO posts (id_user, content, author, status, created_at) VALUES (:id_user, :content, :author, :status, :created_at)";
            $this->db->query($sql);


            $this->db->bind(':id_user', $data['user_id']);
            $this->db->bind(':content', $data['content']);
            $this->db->bind(':author', $data['author']);
            $this->db->bind(':status', $data['status'] );
            $this->db->bind(':created_at', date('Y-m-d H:i:s'));

            if($this->db->execute())
                return true;
            else
                return false;
        }


        /**
         * Like a post
         * @param int $post_id
         * @param int $user_id
         */
        public function addLike(int $post_id, int $user_id)
        {
            //Insert data to the like table then update the like from the posts table
            $sql = "INSERT INTO likes (post_id, user_id) VALUES (:post_id, :user_id)";
            $this->db->query($sql);

            $this->db->bind(':post_id', $post_id);
            $this->db->bind(':user_id', $user_id);

            if($this->db->execute())
            {
                $sql = "UPDATE posts SET likes = likes + 1 WHERE id = :post_id";
                $this->db->query($sql);
                $this->db->bind(':post_id', $post_id);
                $this->db->execute();
            }
        }

        /**
         * Delete a post
         * @param int $post_id
         */
        public function deletePost(int $post_id)
        {
            //Delelete all likes related of the post and the post itself
            $sql = "DELETE FROM likes WHERE post_id = :post_id";
            $this->db->query($sql);
            $this->db->bind(':post_id', $post_id);

            if($this->db->execute())
            {
                $sql = "DELETE FROM posts WHERE id = :post_id";
                $this->db->query($sql);
                $this->db->bind(':post_id', $post_id);
                $this->db->execute();
            }
        }
    }
?>