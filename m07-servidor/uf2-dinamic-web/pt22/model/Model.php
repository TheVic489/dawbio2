<?php
require_once 'lib/ViewLoader.php';
require_once 'persist/UserPersistFileDao.php';

/**
 * searches all products from data source
 * or an empty list if not found or error
 */
class Model
{
    private string $userFile;
    private string $userFileDelimiter;
    private UserPersistFileDao $userDao;
    
    public function __construct()
    {
        $this->userFile = "files/users.txt";
        $this->userFileDelimiter = ";";
        $this->userDao = new UserPersistFileDao($this->userFile, $this->userFileDelimiter);
    }

    public function searchAllProducts()
    {
        //TODO
        return array();
    }
    public function addItem(User $user): int {
        $numAffected = 0;
        if ($user !== null) {
            $numAffected = $this->userDao->insert($user);            
        }
        return $numAffected;
    }

    public function searchAllUsers(): ?array
    {
        $data = null;
        $data = $this->userDao->selectAll();
        return $data;
    }

    /**
     * Validate user
     * @param string $username
     * @param string $password
     * @return bool true if 
     */
    public function validateLogin(string $username, string $password): bool
    {
        $valid = false;
        $user2validate = $this->userDao->getUserbyUsername($username);
        if (!is_null($user2validate)) {
            if ($user2validate->getPassword() == $password) {
                $valid = true;
            }
        }
        return $valid;
    }
    
}