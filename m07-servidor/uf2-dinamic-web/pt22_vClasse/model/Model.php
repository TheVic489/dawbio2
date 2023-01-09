<?php
require_once 'persist/UserPersistFileDao.php';
require_once 'model/User.php';

class Model {
    
    private string $userFile;
    private string $userFileDelimiter;
    
    private UserPersistFileDao $userDao;
    
    public function __construct() {
        $this->userFile = "files/users.txt";
        $this->userFileDelimiter = ";";
        $this->userDao = 
            new UserPersistFileDao($this->userFile, $this->userFileDelimiter);
    }

    /**
     * searches all products from data source 
     * or an empty array if not found or in case or error 
     */
    public function searchAllProducts(): ?array {
        //TODO
        //return array();
        return null;
    }
    
    /**
     * searches all users from data source 
     * or an empty array if not found or in case or error 
     */
    public function searchAllUsers(): ?array {
        $data = null;
        $data = $this->userDao->selectAll();
        return $data;
    }
    
    /**
     * searches user with given credentials
     * @param string $username the username
     * @param string $password the password
     * @return User found or null in case of error
     */
    public function searchUserByUsernameAndPassword(
            string $username, string $password
    ): ?User  {
        $found = $this->userDao->selectWhereUsername($username);
        if (!is_null($found)) {
            if ($password !== $found->getPassword()) {
                $found = null;
            }
        }
        return $found;
    }
}
