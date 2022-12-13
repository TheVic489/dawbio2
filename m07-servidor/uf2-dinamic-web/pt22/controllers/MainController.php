<?php
require_once 'lib/ViewLoader.php';
require_once 'lib/UserFormValidator.php';
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
        $userList = $this->model->searchAllUsers();
        if (!is_null($userList)) {
            $data['userList'] = $userList;
            $this->view->show("list-users.php", $data);
        } else {
            $data['userList'] = array();
            $data['message'] = "Data is null";
            $this->view->show("list-users.php", $data);
        }
    }

    /**
     * Displays page with product form
     */
    private function doProductForm()
    {
        $this->view->show('form-users.php');
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
            $result = "Error reading user";
        } else {
            $numAffected = $this->model->addItem($user);
            if ($numAffected>0) {
                $result = "Item successfully added";
            } else {
                $result = "Error adding item";
            }            
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("form-users.php", $data);
    }
}