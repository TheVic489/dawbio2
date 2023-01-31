<?php
namespace proven\store\model;

require_once 'model/persist/UserDao.php';
require_once 'model/User.php';

require_once 'model/persist/CategoryDao.php';
require_once 'model/Category.php';

require_once 'model/persist/ProductDao.php';
require_once 'model/Product.php';

use proven\store\model\persist\CategoryDao;
use proven\store\model\persist\UserDao;
use proven\store\model\persist\ProductDao;
//use proven\store\model\User;

/**
 * Service class to provide data.
 * @author ProvenSoft
 */
class StoreModel {

    // private string $userFile;
    // private string $userFileDelimiter;
    // private UserPersistFileDao $userDao;


    public function __construct() {
    }
   
    public function findAllUsers(): array {
        $dbHelper = new UserDao();
        return $dbHelper->selectAll();
    }
    public function findAllCategories(): array {
        $dbHelper = new CategoryDao();
        return $dbHelper->selectAll();
    }
    public function findAllProducts(): array {
        $dbHelper = new ProductDao();
        return $dbHelper->selectAll();
    }
    
    
    public function findUsersByRole(string $role): array {
        $dbHelper = new UserDao();
        return $dbHelper->selectWhere("role", $role);
    }


    public function addUser(User $user): int {
        $dbHelper = new UserDao();
        return $dbHelper->insert($user);
    }

    public function addProduct(Product $product): int {
        $dbHelper = new ProductDao();
        return $dbHelper->insert($product);
    }


    public function modifyUser(User $user): int {
        $dbHelper = new UserDao();
        return $dbHelper->update($user);
    }
    public function modifyCategory(Category $category): int {
        $dbHelper = new CategoryDao();
        return $dbHelper->update($category);
    }
    public function modifyProduct(Product $product): int {
        $dbHelper = new ProductDao();
        return $dbHelper->update($product);
    }

    public function removeUser(User $user): int {
        $dbHelper = new UserDao();
        return $dbHelper->delete($user);
    }
    public function removeProduct(Product $product): int {
        $dbHelper = new ProductDao();
        return $dbHelper->delete($product);
    }
    

    public function findUserById(int $id): ?User {
        $dbHelper = new UserDao();
        $u = new User($id);
        return $dbHelper->select($u);
    }
    public function findCategoryById(int $id): ?Category {
        $dbHelper = new CategoryDao();
        $c = new Category($id);
        return $dbHelper->select($c);
    }
    public function findProductById(int $id): ?Product {
        $dbHelper = new ProductDao();
        $p = new Product($id);
        return $dbHelper->select($p);
    }

        /**
     * Validate user from datasource with given credentials, 
     * @param string $username
     * @param string $password
     * @return number ($valid = 0) -> Wrong Password ($valid = -1) -> User doesn't exists  ($valid = 1) -> Login Success
     */
    // public function validateLogin(string $username, string $password): int
    // {
    //     $valid = 0;
    //     $user2validate = $this->userDao->getUserbyUsername($username);

    //     if (($user2validate !== -1)) {
    //         if ($user2validate->getPassword() == $password) {
    //             $valid = 1;
    //         }
    //     }elseif (($user2validate == -1)){
    //         $valid = -1;
    //     }
    //     return $valid;
    // }
}

