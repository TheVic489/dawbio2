<?php
require_once 'lib/ViewLoader.php';
require_once 'persist/UserPersistFileDao.php';
/**
 * Model for store application.
 *
 * @author ProvenSoft
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

    /** methods related to user **/

    /**
     * searches all users in data source.
     * @return array with all users found or null in case of error.
     */
    public function searchAllUsers(): ?array
    {
        $data = null;
        $data = $this->userDao->selectAll();
        return $data;
    }

    /**
     * adds a new user to data source preventing username duplicated and null
     * objects
     * @param User $user the user to add
     * @return int number of users added
     */
    public function addUser(User $user): int
    {
        $numAffected = 0;
        if ($user !== null) {
            $numAffected = $this->userDao->insert($user);            
        }
        return $numAffected;
    }

    /** methods related to product **/

    /**
     * Search a User by username and password
     * @param string $username
     * @param string $password
     * @return User found or null if not exists
     */
    public function searchUserByUsernameAndPassword(
        string $username,
        string $password
    ): ?User
    {
        $found = null;
        $user2search = $this->userDao->selectWhereUsername($username);

        if ($user2search !== null) {
            if ($user2search->getPassword() == $password) {
                $found = $user2search;
            }
        }
        return $found;
    }
    public function getAge($username)
    {
        $user = $this->userDao->selectWhereUsername($username);
        $role = $user->getAge();
        return $role;
    }
    /**
     * searches a user with the given username
     * @param string $username the username to search
     * @return the user searched or null if not found
     */
    public function searchUserByUsername(string $username): ?User
    {
        
        $found = null;
        $user2search = $this->userDao->selectWhereUsername($username);
        if ($user2search !== null) {
            $found = $user2search;
        }
        return $found;
    }
}