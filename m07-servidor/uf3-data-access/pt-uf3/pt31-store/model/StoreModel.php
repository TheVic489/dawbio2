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
 * @author Victor Piñana
 */
class StoreModel
{

    // private string $userFile;
    // private string $userFileDelimiter;
    // private UserPersistFileDao $userDao;


    public function __construct()
    {
    }

    public function findAllUsers(): array
    {
        $dbHelper = new UserDao();
        return $dbHelper->selectAll();
    }
    public function findAllCategories(): array
    {
        $dbHelper = new CategoryDao();
        return $dbHelper->selectAll();
    }
    public function findAllProducts(): array
    {
        $dbHelper = new ProductDao();
        return $dbHelper->selectAll();
    }
    public function findAllWarehouses(): array
    {
        $dbHelper = new WarehouseDao();
        return $dbHelper->selectAll();
    }


    public function findUsersByRole(string $role): array
    {
        $dbHelper = new UserDao();
        return $dbHelper->selectWhere("role", $role);
    }


    public function addUser(User $user): int
    {
        $dbHelper = new UserDao();
        return $dbHelper->insert($user);
    }

    public function addProduct(Product $product): int
    {
        $dbHelper = new ProductDao();
        return $dbHelper->insert($product);
    }


    public function modifyUser(User $user): int
    {
        $dbHelper = new UserDao();
        return $dbHelper->update($user);
    }
    public function modifyCategory(Category $category): int
    {
        $dbHelper = new CategoryDao();
        return $dbHelper->update($category);
    }
    public function modifyProduct(Product $product): int
    {
        $dbHelper = new ProductDao();
        return $dbHelper->update($product);
    }
    public function modifyWarehouse(Warehouse $warehouse): int
    {
        $dbHelper = new WarehouseDao();
        return $dbHelper->update($warehouse);
    }

    public function removeUser(User $user): int
    {
        $dbHelper = new UserDao();
        return $dbHelper->delete($user);
    }
    public function removeProduct(Product $product): int
    {
        $dbHelper = new ProductDao();
        return $dbHelper->delete($product);
    }
    public function removeCategory(Category $category): int
    {
        $dbHelper = new CategoryDao();
        return $dbHelper->delete($category);
    }

    /**
     * findUserById
     * @param int $id
     * @return User|null
     */
    public function findUserById(int $id): ?User
    {
        $dbHelper = new UserDao();
        $u = new User($id);
        return $dbHelper->select($u);
    }

    /**
     * findUserByUsernamePassword
     * @param string $username
     * @param string $password
     * @return User|null
     */
    public function findUserByUsernamePassword(string $username, string $password): ?User
    {
        $dbHelper = new UserDao();
        $u = new User(0, $username, $password);
        return $dbHelper->selectWhereUsernamePassword($u);
    }
    /**
     * findCategoryById
     * @param int $id
     * @return Category|null
     */
    public function findCategoryById(int $id): ?Category
    {
        $dbHelper = new CategoryDao();
        $c = new Category($id);
        return $dbHelper->select($c);
    }

    /**
     * Summary of findCategoryByCode
     * @param string $code Code of the category to search
     * @return array|null Array of categories or null otherwise
     */
    public function findCategoryByCatCode(string $code): ?array{
        $dbHelper = new CategoryDao();
        return $dbHelper->selectWhere("code", $code);
    }

    /**
     * Summary of findProductByCatId
     * @param string $id Category id to search
     * @return array of category found or empty array otherwise
     */
    public function findProductByCatId(string $id): array {
        $dbHelper = new ProductDao();
        return $dbHelper->selectWhere("category_id", $id);
    }
    /**
     * findProductById
     * @param int $id
     * @return Product|null
     */
    public function findProductById(int $id): ?Product
    {
        $dbHelper = new ProductDao();
        $p = new Product($id);
        return $dbHelper->select($p);
    }

    /**
     * find product by categorycode 
     * @param string $code is the code of the category
     * @return array of products or null array if not found
     */
    public function findProductByCategoryCode(string $code): ?array
    {
        $dbHelper = new CategoryDao();
        $categoriesFound = $this->findCategoryByCatCode($code);

        if (!empty($categoriesFound)) {
            $cat = $categoriesFound[0];
            $id  = $cat->getId();
            return $this->findProductByCatId($id);
        } else {
            return array();
        }
    }
    
    /**
     * findWarehouseById
     * @param int $id
     * @return Warehouse|null
     */
    public function findWarehouseById(int $id): ?Warehouse
    {
        $dbHelper = new WarehouseDao();
        $p = new Warehouse($id);
        return $dbHelper->select($p);
    }

    /**
     * findWarehouseProductbyProduct
     * @param Product $prodcut
     * @return array|null
     */
    public function findWarehouseProductbyProduct(object $prodcut): ?array
    {
        $dbHelper = new WarehouseProductsDao();
        $p = $prodcut;
        return $dbHelper->selectWhereProduct($p);

    }

    /**
     * selectWhereProduct
     * @param object $prodcut
     * @return array|null
     */
    public function selectWhereProduct(object $prodcut): ?array
    {
        $dbHelper = new WarehouseProductsDao();
        $p = $prodcut;
        return $dbHelper->selectWhereProduct($p);

    }


    /**
     * remove stock of a product
     * @param Product $product 
     * @return int rows affected
     */
    public function removeProductStock(Product $product): int
    {
        $dbHelper = new WarehouseProductsDao();
        return $dbHelper->deleteProductStock($product);
    }
}