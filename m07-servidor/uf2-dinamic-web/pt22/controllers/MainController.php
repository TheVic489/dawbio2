<?php
require_once 'lib/ViewLoader.php';
require_once 'lib/UserFormValidator.php';
require_once 'lib/ProductFormValidator.php';
require_once 'lib/UserLoginForm.php';
require_once 'model/Model.php';
require_once 'model/persist/UserPersistFileDao.php';
/**
 * Main controller for store application.
 *
 * @author TheVic489
 */
class MainController
{

    private ViewLoader $view;
    private Model $model;

    private string $action;

    public function __construct()
    {
        $this->view = new ViewLoader();
        $this->model = new Model();
    }

    public function processRequest()
    {
        $requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        switch ($requestMethod) {
            case 'get':
            case 'GET':
                $this->processGET();
                break;
            case 'post':
            case 'POST':
                $this->proccesPOST();
                break;
            default:
                break;
        }
    }

    public function processGET()
    {
        $this->action = "";
        if (filter_has_var(INPUT_GET, 'action')) {
            $this->action = filter_input(INPUT_GET, 'action');
        }
        switch ($this->action) {
            case 'home':
                $this->doHomePage();
                break;
            case 'product/listAll':
                $this->doListAllProducts();
                break;
            case 'user/listAll':
                $this->doListAllUsers();
                break;
            case 'product/form':
                $this->doProductForm(); //show product form.
                break;
            case 'user/form':
                $this->doFormUser(); //show product form.
                break;
            case 'login/form':
                $this->doLoginForm(); //show product form.
                break;
            case 'logout':
                $this->doLogout(); //show product form.
                break;
            case 'logout/form':
                $this->doLogoutForm(); //show product form.
                break;
            default:
                break;
        }
    }

    public function proccesPOST()
    {
        $this->action = "";
        if (filter_has_var(INPUT_POST, 'action')) {
            $this->action = filter_input(INPUT_POST, 'action');
        }
        switch ($this->action) {
            case 'home':
                $this->doHomePage();
                break;
            case 'product/add':
                $this->doAddProduct();
                break;
            case 'prduct/find':
                $this->doFindProduct(); 
                break;
            case 'user/add':
                $this->doAddUser(); //show product form.
                break;
            case 'login/submit':
                $this->doLoginUser(); 
                break;
            case 'user/find':
                $this->doFindUser(); 
                break;
            case 'user/modify':
                $this->doModifyUser();
                break;
            case 'product/modify':
                $this->doModifyProduct();
                break;
            case 'user/remove':
                $this->doRemoveUser();
                break;
            case 'product/remove':
                $this->doRemoveProduct();
                break;
            default:
                break;

        }
    }

    private function doHomePage()
    {
        $this->view->show('home.php');
    }

    private function doListAllProducts()
    {
        $productLists = $this->model->searchAllProducts();
        $data['products_list'] = $productLists;
        $this->view->show('list-products.php', $data);
    }
    private function doFormUser()
    {
        if (!isset($_SESSION['role'])) {
            $data['message'] = "You don't have enough permisions";
            $this->view->show("insufficient-permissions.php", $data);
        // Check roles permitted
        } else {
            $user = UserFormValidation::getData();
            $data['user'] = $user;
            $data['action'] = $this->action;
            $this->view->show('form-users.php', $data);
        }
    }

    /**
     *  List all users from data source
     */
    private function doListAllUsers()
    {
        // Handle if not logged
        if (!isset($_SESSION['role'])) {
            $data['message'] = "You don't have enough permisions";
            $this->view->show("insufficient-permissions.php", $data);
        // Check roles permitted
        } elseif (($_SESSION['role'] == 'admin') || ($_SESSION['role'] == 'staff')){
            $userList = $this->model->searchAllUsers();
            if (!is_null($userList)) {
                $data['userList'] = $userList;
                $this->view->show("list-users.php", $data);
            } else {
                $data['userList'] = array();
                $data['message'] = "Data is null";
                $this->view->show("list-users.php", $data);
            }
        }else {
            $data['message'] = "You don't have enough permisions";
            $this->view->show("insufficient-permissions.php", $data);
        }
    }

    /**
     * Displays page with product form
     */
    private function doProductForm()
    {
        if (!isset($_SESSION['role'])) {
            $data['message'] = "You don't have enough permisions";
            $this->view->show("insufficient-permissions.php", $data);
        // Check roles permitted
        } else {
            $product = ProductFormValidation::getData();
            $data['product'] = $product;
            $data['action'] = $this->action;
            $this->view->show('form-products.php');
        }
    }
    private function doLoginForm()
    {
        $this->view->show('login-form.php');
    }
    private function doAddProduct()
    {
        $product = ProductFormValidation::getData();
        $result = null;
        if (is_null($product)) {
            $result = "Error adding product";
        } else {
            $numAffected = $this->model->addProduct($product);
            if ($numAffected > 0) {
                $result = "Item successfully added";
            } else {
                $result = "Error reading item";
            }
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("form-products.php", $data);
    }

    public function doAddUser()
    {
        $user = UserFormValidation::getData();
        $result = null;
        if (is_null($user)) {
            $result = "User already exists";
        } else {
            $numAffected = $this->model->addItem($user);
            if ($numAffected > 0) {
                $result = "Item successfully added";
            } else {
                $result = "Error reading item";
            }
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("form-users.php", $data);
    }

    public function doFindProduct() {
        $id2Find = ProductFormValidation::getId2Find();
        $result = null;
        var_dump($id2Find);
        if (is_null($id2Find)) {
            $result = "Error finding product";
        } else {
            $productFound = $this->model->searchProductById($id2Find);
            if (!is_null($productFound)) {
                //pass data to template.
                $data['product'] = $productFound;
                $data['action'] = "change";
            } else {
                $result = "product not found";
            }            
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("form-products.php", $data);         
    }

    public function doFindUser() {
        $id2Find = UserFormValidation::getId2Find();
        $result = null;
        if (is_null($id2Find)) {
            $result = "Error finding user";
        } else {
            $userFound = $this->model->searchUsertById($id2Find);
            if (!is_null($userFound)) {
                //pass data to template.
                $data['user'] = $userFound;
                $data['action'] = "change";
            } else {
                $result = "user not found";
            }            
        }
        //pass data to template.
        $data['result'] = $result;
        $data['id2'] = $id2Find;
        //show the template with the given data.
        $this->view->show("form-users.php", $data);         
    }


    public function doLoginUser()
    {
        $result = "";
        $userCredentials = UserLoginForm::getFormCredentials();
        list($user, $pass) = $userCredentials;
        $userFound = $this->model->validateLogin($user, $pass);
        if ($userFound == 1) {
            $role = $this->model->getRole($user);

            $_SESSION['role'] = $role;
            $_SESSION['username'] = $user;

            $result = 'Logged succesfuly';
            header("Location: index.php");
        } elseif ($userFound == -1) {
            $result = 'User not found';

        } elseif ($userFound == 0) {
            $result = 'Wrong Password';
        }
        $data['message'] = $result;
        $this->view->show("login-form.php", $data);

    }


    public function doModifyUser() {
        $user = UserFormValidation::getDataForm();
        $result = null;
        var_dump($user);
        if (is_null($user)) {
            $result = "Error reading user";
        } else {
            $numAffected = $this->model->modifyUser($user);
            if ($numAffected>0) {
                $result = "user successfully modified";
            } else {
                $result = "Error modifying user";
            }            
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("form-users.php", $data);        
    }

    public function doModifyProduct() {
        $product = ProductFormValidation::getDataForm();
        $result = null;
        var_dump($product);
        if (is_null($product)) {
            $result = "Error reading product";
        } else {
            $numAffected = $this->model->modifyProduct($product);
            if ($numAffected>0) {
                $result = "product successfully modified";
            } else {
                $result = "Error modifying product";
            }            
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("form-products.php", $data);        
    }


    public function doRemoveUser() {
        $user = UserFormValidation::getDataForm();
        $result = null;
        if (is_null($user)) {
            $result = "Error reading user";
        } else {
            $numAffected = $this->model->removeUser($user);
            if ($numAffected>0) {
                $result = "user successfully removed";
            } else {
                $result = "Error removing user";
            }
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("form-users.php", $data);          
    }
    public function doRemoveProduct() {
        $product = ProductFormValidation::getDataForm();
        $result = null;
        if (is_null($product)) {
            $result = "Error reading product";
        } else {
            $numAffected = $this->model->removeProduct($product);
            if ($numAffected>0) {
                $result = "product successfully removed";
            } else {
                $result = "Error removing product";
            }
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("form-products.php", $data);          
    }
    public function doLogout()
    {
        session_destroy();
        header("Location: index.php ");
    }

    public function doLogoutForm()
    {
        $this->view->show("logout-form.php");
    }
}