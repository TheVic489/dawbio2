<?php

namespace proven\store\controllers;

require_once 'lib/ViewLoader.php';
require_once 'lib/Validator.php';
require_once 'lib/UserLoginForm.php';

require_once 'model/StoreModel.php';
require_once 'model/User.php';
require_once 'model/Category.php';


use proven\store\model\StoreModel as Model;
use proven\lib\ViewLoader as View;

use proven\lib\views\Validator as Validator;
use UserLoginForm;

/**
 * Main controller
 * @author ProvenSoft
 */
class MainController {
    /**
     * @var ViewLoader
     */
    private $view;
    /**
     * @var Model 
     */
    private $model;
    /**
     * @var string  
     */
    private $action;
    /**
     * @var string  
     */
    private $requestMethod;

    public function __construct() {
        //instantiate the view loader.
        $this->view = new View();
        //instantiate the model.
        $this->model = new Model();
    }

    /* ============== HTTP REQUEST FUNCTIONS ============== */

    /**
     * processes requests from client, regarding action command.
     */
    public function processRequest() {
        $this->action = "";
        //retrieve action command requested by client.
        if (\filter_has_var(\INPUT_POST, 'action')) {
            $this->action = \filter_input(\INPUT_POST, 'action');
        } else {
            if (\filter_has_var(\INPUT_GET, 'action')) {
                $this->action = \filter_input(\INPUT_GET, 'action');
            } else {
                $this->action = "home";
            }
        }
        //retrieve request method.
        if (\filter_has_var(\INPUT_SERVER, 'REQUEST_METHOD')) {
            $this->requestMethod = \strtolower(\filter_input(\INPUT_SERVER, 'REQUEST_METHOD'));
        }
        //process action according to request method.
        switch ($this->requestMethod) {
            case 'get':
                $this->doGet();
                break;
            case 'post':
                $this->doPost();
                break;
            default:
                $this->handleError();
                break;
        }
    }

    /**
     * processes get requests from client.
     */
    private function doGet() {
        //process action.
        switch ($this->action) {
            case 'home':
                $this->doHomePage();
                break;
            case 'user':
                $this->doUserMng();
                break;
            case 'user/edit':
                $this->doUserEditForm("edit");
                break;
            case 'category':
                $this->doCategoryMng();
                break;
            case 'category/edit':
                $this->doCategoryEditForm("edit");
                break;
            case 'product':
                $this->doProductMng();
                break;
            case 'product/edit':
                $this->doProductEditForm("edit");
                break;
            case 'product/formremove':
                $this->doProductRemoveForm("remove");
                break;
            case 'category/formremove':
                $this->doCategoryRemoveForm("remove");
                break;
            case 'warehouse':
                $this->doWareHouseMng();
                break;
            case 'warehouse/edit':
                $this->doWarehouseEditForm("edit");
                break;
            case 'loginform':
                $this->doLoginForm();
                break;
            default:  //processing default action.
                $this->handleError();
                break;
        }
    }

    /**
     * processes post requests from client.
     */
    private function doPost() {
        //process action.
        switch ($this->action) {
            case 'user/role':
                $this->doListUsersByRole();
                break;
            case 'user/form':
                $this->doUserEditForm("add");
                break;
            case 'product/form':
                $this->doProductEditForm("add");
                break;         
            case 'user/add': 
                $this->doUserAdd();
                break;
            case 'product/add': 
                $this->doProductAdd();
                break;
            case 'user/modify': 
                $this->doUserModify();
                break;
            case 'category/modify': 
                $this->doCategoryModify();
                break;
            case 'product/modify': 
                $this->doProductModify();
                break;
            case 'warehouse/modify': 
                $this->doWarehouseModify();
                break;
            case 'user/remove': 
                $this->doUserRemove();
                break;
            case 'product/remove': 
                $this->doProductRemove();
                break;
            case 'category/remove': 
                $this->doCategoryRemove();
                break;
            case 'product/searchbycategory': 
                $this->doProductSearchByCategory();
                break;
            case 'login/submit':
                $this->doLoginUser(); 
                break;
            default:  //processing default action.
                $this->doHomePage();
                break;
        }
    }

    /* ============== NAVIGATION CONTROL METHODS ============== */

    /**
     * handles errors.
     */
    public function handleError() {
        $this->view->show("message.php", ['message' => 'Something went wrong!']);
    }

    /**
     * displays home page content.
     */
    public function doHomePage() {
        $this->view->show("home.php", []);
    }

    /* ============== SESSION CONTROL METHODS ============== */

    /**
     * displays login form page.
     */
    public function doLoginForm() {
        $this->view->show("login/loginform.php", []);  //initial prototype version;
    }
    /**
     * Do the login service
     * @return void
     */
    public function doLoginUser()
    {
        // $result = "";
        // $userCredentials = UserLoginForm::getFormCredentials();
        // list($user, $pass) = $userCredentials;
        // $userFound = $this->model->validateLogin($user, $pass);
        // if ($userFound == 1) {
        //     $role = $this->model->getRole($user);

        //     $_SESSION['role'] = $role;
        //     $_SESSION['username'] = $user;

        //     $result = 'Logged succesfuly';
        //     header("Location: index.php");
        // } elseif ($userFound == -1) {
        //     $result = 'User not found';

        // } elseif ($userFound == 0) {
        //     $result = 'Wrong Password';
        // }
        // $data['message'] = $result;
        // $this->view->show("login-form.php", $data);

    }

    /* ============== USER MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays user management page.
     */
    public function doUserMng() {
        //get all users.
        $result = $this->model->findAllUsers();
        //pass list to view and show.
        $this->view->show("user/usermanage.php", ['list' => $result]);        
        //$this->view->show("user/user.php", [])  //initial prototype version;
    }   

    public function doListUsersByRole() {
        //get role sent from client to search.
        $roletoSearch = \filter_input(INPUT_POST, "search");
        if ($roletoSearch !== false) {
            //get users with that role.
            $result = $this->model->findUsersByRole($roletoSearch);
            //pass list to view and show.
            $this->view->show("user/usermanage.php", ['list' => $result]);   
        }  else {
            //pass information message to view and show.
            $this->view->show("user/usermanage.php", ['message' => "No data found"]);   
        }
    }

    public function doUserEditForm(string $mode) {
        $data = array();
        if ($mode != 'user/add') {
            //fetch data for selected user
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (($id !== false) && (!is_null($id))) {
                $user = $this->model->findUserById($id);
                if (!is_null($user)) {
                    $data['user'] = $user;
                }
             }
             $data['mode'] = $mode;
        }
        $this->view->show("user/userdetail.php", $data);  //initial prototype version.
    }

    public function doUserAdd() {
        //get user data from form and validate
        $user = Validator::validateUser(INPUT_POST);
        //add user to database
        if (!is_null($user)) {
            $result = $this->model->addUser($user);
            $message = ($result > 0) ? "Successfully added":"Error adding";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        }
    }
    
    public function doUserModify() {
        //get user data from form and validate
        $user = Validator::validateUser(INPUT_POST);
        //add user to database
        if (!is_null($user)) {
            $result = $this->model->modifyUser($user);
            $message = ($result > 0) ? "Successfully modified":"Error modifying";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        }
    }    

    public function doUserRemove() {
        //get user data from form and validate
        $user = Validator::validateUser(INPUT_POST);
        //add user to database
        if (!is_null($user)) {
            $result = $this->model->removeUser($user);
            $message = ($result > 0) ? "Successfully removed":"Error removing";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("user/userdetail.php", ['mode' => 'add', 'message' => $message]);
        }
    } 
    
    /* ============== CATEGORY MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays category management page.
     */
    public function doCategoryMng() {
        //get all users.
        $result = $this->model->findAllCategories();
        //pass list to view and show.
        $this->view->show("category/categorymanage.php", ['list' => $result]);        
        //$this->view->show("user/user.php", [])  //initial prototype version;
    }

    public function doCategoryEditForm(string $mode) {
        $data = array();
        if ($mode != 'category/add') {
            //fetch data for selected category
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (($id !== false) && (!is_null($id))) {
                $category = $this->model->findCategoryById($id);
                if (!is_null($category)) {
                    $data['category'] = $category;
                }
             }
             $data['mode'] = $mode;
        }
        $this->view->show("category/categorydetail.php", $data);  //initial prototype version.
    }
    
    public function doCategoryModify() {
        //get category data from form and validate
        $category = Validator::validateCategory(INPUT_POST);
        //add category to database
        if (!is_null($category)) {
            $result = $this->model->modifyCategory($category);
            $message = ($result > 0) ? "Successfully modified":"Error modifying";
            $this->view->show("category/categorydetail.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("category/categorydetail.php", ['mode' => 'add', 'message' => $message]);
        }
    }    

    public function doCategoryRemove() {
        //get category data from form and validate
        $category = Validator::validateCategory(INPUT_POST);
        //add category to database
        if (!is_null($category)) {
            $result = $this->model->removeCategory($category);
            $message = ($result > 0) ? "Successfully removed":"Error removing";
            $this->view->show("category/categoryremoveform.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("category/categoryremoveform.php", ['mode' => 'add', 'message' => $message]);
        }
    } 
    public function doCategoryRemoveForm(string $mode) {
        $data = array();
        if ($mode != 'category/add') {
            //fetch data for selected category
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (($id !== false) && (!is_null($id))) {
                $category = $this->model->findCategoryById($id);
                if (!is_null($category)) {
                    $data['category'] = $category;
                }
             }
             $data['mode'] = $mode;
        }
        $this->view->show("category/categoryre  moveform.php", $data);  //initial prototype version.
    }
    /* ============== PRODUCT MANAGEMENT CONTROL METHODS ============== */

    /**
     * displays product management page.
     */
    public function doProductMng() {
        //get all products.
        $result = $this->model->findAllProducts();
        //pass list to view and show.
        $this->view->show("product/productmanage.php", ['list' => $result]);        
        //$this->view->show("user/user.php", [])  //initial prototype version;
    }
    public function doProductAdd() {
        //get product data from form and validate
        $product = Validator::validateProduct(INPUT_POST);
        //add product to database
        if (!is_null($product)) {
            $result = $this->model->addProduct($product);
            $message = ($result > 0) ? "Successfully added":"Error adding";
            $this->view->show("product/productdetail.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("product/productdetail.php", ['mode' => 'add', 'message' => $message]);
        }
    }
    public function doProductEditForm(string $mode) {
        $data = array();
        if ($mode != 'product/add') {
            //fetch data for selected product
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (($id !== false) && (!is_null($id))) {
                $product = $this->model->findProductById($id);
                if (!is_null($product)) {
                    $data['product'] = $product;
                }
             }
             $data['mode'] = $mode;
        }
        $this->view->show("product/productdetail.php", $data);  //initial prototype version.
    }
    public function doProductRemoveForm(string $mode) {
        $data = array();
        if ($mode != 'product/add') {
            //fetch data for selected product
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (($id !== false) && (!is_null($id))) {
                $product = $this->model->findProductById($id);
                if (!is_null($product)) {
                    $data['product'] = $product;
                }
             }
             $data['mode'] = $mode;
        }
        $this->view->show("product/productremoveform.php", $data);  //initial prototype version.
    }
    public function doProductRemove() {
        //get product data from form and validate
        $product = Validator::validateProduct(INPUT_POST);
        //add product to database
        if (!is_null($product)) {
            $result = $this->model->removeProduct($product);
            $message = ($result > 0) ? "Successfully removed":"Error removing";
            $this->view->show("product/productremoveform.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("product/productremoveform.php", ['mode' => 'add', 'message' => $message]);
        }
    } 
    public function doProductModify() {
        //get product data from form and validate
        $product = Validator::validateProduct(INPUT_POST);
        //add product to database
        if (!is_null($product)) {
            $result = $this->model->modifyProduct($product);
            $message = ($result > 0) ? "Successfully modified":"Error modifying";
            $this->view->show("product/productdetail.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("product/productdetail.php", ['mode' => 'add', 'message' => $message]);
        }
    }
    /**
     * displays product management page.
     */
    public function doWarehouseMng() {
         //get all users.
         $result = $this->model->findAllWarehouses();
         //pass list to view and show.
         $this->view->show("warehouse/warehousemanage.php", ['list' => $result]);     
    }
    public function doWarehouseEditForm(string $mode) {
        $data = array();
        if ($mode != 'warehouse/add') {
            //fetch data for selected warehouse
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (($id !== false) && (!is_null($id))) {
                $warehouse = $this->model->findWarehouseById($id);
                if (!is_null($warehouse)) {
                    $data['warehouse'] = $warehouse;
                }
             }
             $data['mode'] = $mode;
        }
        $this->view->show("warehouse/warehousedetail.php", $data);  //initial prototype version.
    }
    public function doWarehouseModify() {
        //get warehouse data from form and validate
        $warehouse = Validator::validateWarehouse(INPUT_POST);
        //add warehouse to database
        if (!is_null($warehouse)) {
            $result = $this->model->modifyWarehouse($warehouse);
            $message = ($result > 0) ? "Successfully modified":"Error modifying";
            $this->view->show("warehouse/warehousedetail.php", ['mode' => 'add', 'message' => $message]);
        } else {
            $message = "Invalid data";
            $this->view->show("warehouse/warehousedetail.php", ['mode' => 'add', 'message' => $message]);
        }
    }
}
