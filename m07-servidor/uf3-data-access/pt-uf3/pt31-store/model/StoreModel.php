<?php
namespace proven\store\model;

require_once 'model/persist/UserDao.php';
require_once 'model/User.php';

require_once 'model/persist/CategoryDao.php';
require_once 'model/Category.php';

require_once 'model/persist/ProductDao.php';
require_once 'model/Product.php';

require_once 'model/persist/WarehouseDao.php';
require_once 'model/Warehouse.php';

require_once 'model/persist/WarehouseProductsDao.php';
require_once 'model/WarehouseProducts.php';

use proven\store\model\persist\CategoryDao;
use proven\store\model\persist\UserDao;
use proven\store\model\persist\ProductDao;
use proven\store\model\persist\WarehouseDao;
use proven\store\model\persist\WarehouseProductsDao;
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
    public function findAllWarehouses(): array {
        $dbHelper = new WarehouseDao();
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
    public function modifyWarehouse(Warehouse $warehouse): int {
        $dbHelper = new WarehouseDao();
        return $dbHelper->update($warehouse);
    }

    public function removeUser(User $user): int {
        $dbHelper = new UserDao();
        return $dbHelper->delete($user);
    }
    public function removeProduct(Product $product): int {
        $dbHelper = new ProductDao();
        return $dbHelper->delete($product);
    }
    public function removeCategory(Category $category): int {
        $dbHelper = new CategoryDao();
        return $dbHelper->delete($category);
    }
    

    public function findUserById(int $id): ?User {
        $dbHelper = new UserDao();
        $u = new User($id);
        return $dbHelper->select($u);
    }
    public function findUserByUsernamePassword(string $username, string $password): ?User {
        $dbHelper = new UserDao();
        $u = new User(0, $username, $password);
        return $dbHelper->selectWhereUsernamePassword($u);
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
    public function findWarehouseById(int $id): ?Warehouse {
        $dbHelper = new WarehouseDao();
        $p = new Warehouse($id);
        return $dbHelper->select($p);
    }

    public function findWarehouseProductbyProduct(object $prodcut): ?array {
        $dbHelper = new WarehouseProductsDao();
        $p = $prodcut;
        return $dbHelper->selectWhereProduct($p);

    }
    public function selectWhereProduct(object $prodcut): ?array {
        $dbHelper = new WarehouseProductsDao();
        $p = $prodcut;
        return $dbHelper->selectWhereProduct($p);

    }
    
    }

