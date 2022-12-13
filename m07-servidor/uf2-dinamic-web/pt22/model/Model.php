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
        //TODO
        return $data;
    }
    
}