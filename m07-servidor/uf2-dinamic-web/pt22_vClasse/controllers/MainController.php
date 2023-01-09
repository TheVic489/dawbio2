<?php

require_once 'lib/ViewLoader.php';
require_once 'model/Model.php';

class MainController {

    private ViewLoader $view;
    private Model $model;
    private string $action;

    public function __construct() {
        $this->view = new ViewLoader();
        $this->model = new Model();
    }

    public function processRequest() {
        //get request method
        $requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        switch ($requestMethod) {
            case 'get':
            case 'GET':
                $this->processGet();
                break;
            case 'post':
            case 'POST':
                $this->processPost();
                break;
            default:
                break;
        }
    }

    private function processGet() {
        $this->action = "";
        if (filter_has_var(INPUT_GET, 'action')) {
            $this->action = filter_input(INPUT_GET, 'action');
        }
        switch ($this->action) {
            case 'home':
                $this->doHomePage();
                break;
            case 'user/listAll':
                $this->doListAllUsers();
                break;
            case 'login/form':
                $this->doLoginForm();
                break;
            case 'product/listAll':
                $this->doListAllProducts();
                break;
            case 'user/form':
                $this->doUserForm();   //show user form.
                break;
            case 'product/form':
                $this->doProductForm();   //show product form.
                break;
            default:
                break;
        }
    }

    private function processPost() {
        $this->action = "";
        if (filter_has_var(INPUT_POST, 'action')) {
            $this->action = filter_input(INPUT_POST, 'action');
        }
        switch ($this->action) {
            case 'user/add': //add user.
                $this->doAddUser();
                break;
            case 'user/login': //add user.
                $this->doUserLogin();
                break;
            case 'product/add':
                $this->doAddProduct();
                break;
            default:
                break;
        }
    }

    private function doHomePage() {
        $this->view->show('home.php');
    }

    private function doLoginForm() {
        $this->view->show('login-form.php');
    }

    /**
     * list all users from data source
     */
    private function doListAllUsers() {
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

    private function doListAllProducts() {
        $productList = $this->model->searchAllProducts();
        if (!is_null($productList)) {
            $data['prodList'] = $productList;
            $this->view->show('list-products.php', $data);
        } else {
            $data['message'] = 'Null data';
            $this->view->show('list-products.php', $data);
        }
    }

    /**
     * displays user form
     */
    private function doUserForm() {
        $this->view->show("user-form.php", ['action' => 'user/form']);
    }

    private function doUserLogin() {
        //get data from form
        //TODO
        $username = "user2";  //fake data
        $password = "pass2";  //fake data
        //ask model to check search user with given credentials
        $userFound = 
                $this->model->searchUserByUsernameAndPassword(
                        $username, $password);
        if (!is_null($userFound)) {
            //start session and data
            $_SESSION['username'] = $userFound->getUsername();
            //TODO save proper data to session
            //forward to view
            $this->view->show("home.php");
        } else {
            $data['result'] = "Invalid credentials";
            $this->view->show("login-form.php", $data);
        }
    }

    /**
     * adds a user sent by user form
     */
    private function doAddUser() {
        //TODO
        $data['message'] = "No implemented yet!";
        $this->view->show("not-implemented.php", $data);
    }

    /**
     * displays page with product form
     */
    private function doProductForm() {
        $this->view->show('form-product.php');
    }

    private function doAddProduct() {
        //TODO
        $data['message'] = "add product not implemented yet!";
        $this->view->show('not-implemented.php', $data);
    }

    private function validateUserForm(): ?User {
        $id = filter_input(INPUT_POST, 'id');

        return new User($id);
    }

}
