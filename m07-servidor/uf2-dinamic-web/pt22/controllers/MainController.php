<?php
require_once 'lib/ViewLoader.php';
require_once 'lib/UserFormValidator.php';
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
            case 'user/add':
                $this->doAddUser(); //show product form.
                break;
            case 'login/submit':
                $this->doLoginUser(); //show product form.
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
        $user = UserFormValidation::getData();
        $data['user'] = $user;
        $data['action'] = $this->action;
        $this->view->show('form-users.php', $data);
    }

    /**
     *  List all users from data source
     */
    private function doListAllUsers()
    {
        if (($_SESSION['role'] == 'admin') || ($_SESSION['role'] == 'staff')) {
            $userList = $this->model->searchAllUsers();
            if (!is_null($userList)) {
                $data['userList'] = $userList;
                $this->view->show("list-users.php", $data);
            } else {
                $data['userList'] = array();
                $data['message'] = "Data is null";
                $this->view->show("list-users.php", $data);
            }
        }else{
                $data['message'] = "You don't have enough permisions";
            $this->view->show("insufficient-permissions.php", $data);

        }
    }

    /**
     * Displays page with product form
     */
    private function doProductForm()
    {
        $this->view->show('form-users.php');
    }
    private function doLoginForm()
    {
        $this->view->show('login-form.php');
    }
    private function doAddProduct()
    {
        $data['message'] = "Add product not implemented";
        $this->view->show('not-implemented.php', $data);
    }

    public function doAddUser()
    {
        $user = UserFormValidation::getData();
        $result = null;
        if (is_null($user)) {
            $result = "Error adding user";
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