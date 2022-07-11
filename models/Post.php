<?php

class Post
{
    private $content;
    private $author;
    private $status;
    private $likes;
    private $comments;


    public function __construct(array $data) 
    {
        $this->hydrate($data);
    }

    /**
     * hydrate function
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }


    /**
     * Set the post content
     * @param string $content
     */
    public function setContent(string $content) : void
    {
        if(!empty($content))
            $this->content = $content;
    }

    /**
     * Set the post author
     * @param string $author
     */
    public function setAuthor(string $author) : void
    {
        if(!empty($author))
            $this->author = $author;
    }


    /**
     * Set the post status
     * @param string $status
     */
    public function setStatus(string $status) : void
    {
        if(!empty($status))
            $this->status = $status;
    }


    /**
     * Set the post likes
     * @param int $likes
     */
    public function setLikes(int $likes) : void
    {
        $likes = (int) $likes;
        if($likes > 0)
            $this->likes = $likes;
    }


    /**
     * Set the post comments
     * @param int $comments
     */
    public function setComments(int $comments) : void
    {
        $comments = (int) $comments;
        if($comments > 0)
            $this->comments = $comments;
    }


    /**
     * Get the post id
     * @return int
     */
    public function getID() : int
    {
        return $this->id;
    }


    /**
     * Get the post user id
     * @return int
     */
    public function getIDUser() : int
    {
        return $this->id_user;
    }


    /**
     * Get the post content
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }


    /**
     * Get the post author
     * @return string
     */
    public function getAuthor() : string
    {
        return $this->author;
    }


    /**
     * Get the post status
     * @return string
     */
    public function getStatus() : string
    {
        return $this->status;
    }


    /**
     * Get the post likes
     * @return int
     */
    public function getLikes() : int
    {
        return $this->likes;
    }


    /**
     * Get the post comments
     * @return int
     */
    public function getComments() : int
    {
        return $this->comments;
    }
}

?>