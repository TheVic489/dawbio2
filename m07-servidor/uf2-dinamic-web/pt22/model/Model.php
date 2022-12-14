<?php
require_once 'lib/ViewLoader.php';
require_once 'persist/UserPersistFileDao.php';
require_once 'persist/ProductPersistFileDao.php';

/**
 * searches all products from data source
 * or an empty list if not found or error
 */
class Model
{
    private string $userFile;
    private string $userFileDelimiter;
    private UserPersistFileDao $userDao;

    private string $productFile;
    private string $productFileDelimiter;
    private ProductPersistFileDao $productDao;
    
    public function __construct()
    {
        $this->userFile = "files/users.txt";
        $this->userFileDelimiter = ";";
        $this->userDao = new UserPersistFileDao($this->userFile, $this->userFileDelimiter);
        
        $this->productFile = "files/products.txt";
        $this->productFileDelimiter = ";";
        $this->productDao = new ProductPersistFileDao($this->productFile, $this->productFileDelimiter);
    }

    public function searchAllProducts()
    {
        $data = null;
        $data = $this->productDao->selectAll();
        return $data;
    }
    public function addItem(User $user): int {
        $numAffected = 0;
        if ($user !== null) {
            $numAffected = $this->userDao->insert($user);            
        }
        return $numAffected;
    }
    public function addProduct(Product $product): int {
        $numAffected = 0;
        if ($product !== null) {
            $numAffected = $this->productDao->insert($product);            
        }
        return $numAffected;
    }
    public function searchAllUsers(): ?array
    {
        $data = null;
        $data = $this->userDao->selectAll();
        return $data;
    }

    public function getRole($username) {
        $user = $this->userDao->getUserbyUsername($username);
        $role = $user->getRole();
        return $role;
    }

    public function searchUsertById(int $id): ?User {  //nullable return.
        $item = $this->userDao->select(new User($id, null, null,null, null, null));
        return $item;
    }
    

    public function searchProductById(int $id): ?Product {  //nullable return.
        $item = $this->productDao->select(new Product($id, null, null, null));
        return $item;
    }

    public function removeProduct(Product $product): int {
        $numAffected = 0;
        if ($product != null) {
            $numAffected = $this->productDao->delete($product);
        }
        return $numAffected;
    }  


    public function modifyProduct(Product $product): int {
        $numAffected = 0;
        if ($product != null) {
            $numAffected = $this->productDao->update($product);
        }
        return $numAffected;
    }
    


    public function removeUser(User $user): int {
        $numAffected = 0;
        if ($user != null) {
            $numAffected = $this->userDao->delete($user);
        }
        return $numAffected;
    }  


    public function modifyUser(User $user): int {
        $numAffected = 0;
        if ($user != null) {
            $numAffected = $this->userDao->update($user);
        }
        return $numAffected;
    }
    /**
     * Validate user from datasource with given credentials, 
     * @param string $username
     * @param string $password
     * @return number ($valid = 0) -> Wrong Password ($valid = -1) -> User doesn't exists  ($valid = 1) -> Login Success
     */
    public function validateLogin(string $username, string $password): int
    {
        $valid = 0;
        $user2validate = $this->userDao->getUserbyUsername($username);

        if (($user2validate !== -1)) {
            if ($user2validate->getPassword() == $password) {
                $valid = 1;
            }
        }elseif (($user2validate == -1)){
            $valid = -1;
        }
        return $valid;
    }
    
}