<?php
require_once 'lib/UserFormValidator.php';
require_once 'lib/ViewLoader.php';
require_once 'model/Model.php';
require_once 'lib/UserLoginForm.php';

/**
 * Main controller for store application.
 *
 * @author ProvenSoft
 */
class MainController
{
    /**
     * @var Model $model. The model to provide data services. 
     */
    private Model $model;
    /**
     * @var ViewLoader $view. The loader to forward views. 
     */
    private ViewLoader $view;
    /**
     * @var string $action. The action requested by client. 
     */
    private string $action;

    public function __construct()
    {
        //instantiate the view loader.
        $this->view = new ViewLoader();
        //instantiate the model.
        $this->model = new Model();
    }

    /**
     * processes requests made by client.
     */
    public function processRequest()
    {
        $requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        switch ($requestMethod) {
            case 'GET':
            case 'get':
                $this->processGet();
                break;
            case 'POST':
            case 'post':
                $this->processPost();
                break;
            default:
                $this->processError();
                break;
        }
    }

    /**
     * processes get request made by client.
     */
    private function processGet()
    {
        $this->action = "";
        if (filter_has_var(INPUT_GET, 'action')) {
            $this->action = filter_input(INPUT_GET, 'action');
        }
        switch ($this->action) {
            case 'home': //home page.
                $this->doHomePage();
                break;
            case 'login/form':
                $this->doLoginForm(); //show product form.
                break;
            case 'logout/form':
                $this->doLogoutForm(); //show product form.
                break;
            case 'logout':
                $this->doLogout(); //show product form.
                break;
            case 'user/listAll':
                $this->doListAllUsers();
                break;
            case 'user/form':
                $this->doFormUser(); //show product form.
                break;
            //TODO
            default: //processing default action.
                $this->doHomePage();
                break;
        }
    }

    /**
     * processes post request made by client.
     */
    private function processPost()
    {
        $this->action = "";
        if (filter_has_var(INPUT_POST, 'action')) {
            $this->action = filter_input(INPUT_POST, 'action');
        }
        switch ($this->action) {
            case 'user/find':
                $this->doFindUser();
                break;
            case 'login/submit':
                $this->doLoginUser();
                break;
            case 'user/add':
                $this->doAddUser(); //show product form.
                break;
            default: //processing default action.
                $this->doHomePage();
                break;
        }
    }

    /**
     * processes error.
     */
    private function processError()
    {
        trigger_error("Bad method", E_USER_NOTICE);
    }

    private function doHomePage()
    {
        $this->view->show('home.php');
    }

    private function doLoginForm()
    {
        $this->view->show('login-form.php');
    }

    public function doLogoutForm()
    {
        $this->view->show("logout-form.php");
    }

    public function doLogout()
    {
        session_destroy();
        header("Location: index.php ");
    }

    // Do login page
    public function doLoginUser()
    {
        $result = "";
        $userCredentials   = UserLoginForm::getFormCredentials(); //Get data form
        list($user, $pass) = $userCredentials; // Separate user and password
        $userFound = $this->model->searchUserByUsernameAndPassword($user, $pass);
        
        if ($userFound !== null) { // If user found
            $age = $this->model->getAge($user);

            $_SESSION['age']      = $age;
            $_SESSION['username'] = $user;

            $result = 'Logged succesfuly';
            header("Location: index.php");

        } elseif ($userFound == null) { // If user not found
            $result = 'User not found';
        }
        $data['message'] = $result;
        $this->view->show("login-form.php", $data);

    }
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

    private function doFormUser()
    {
        if (!isset($_SESSION['username'])) {
            $data['message'] = "You don't have enough permisions";
            $this->view->show("insufficient-permissions.php", $data);
        } else {
            $user = UserFormValidation::getDataForm();
            $data['user'] = $user;
            $data['action'] = $this->action;
            $this->view->show('form-users.php', $data);
        }

    }
    public function doFindUser()
    {
        $username2Find = UserFormValidation::getUsername2Find();
        $result = null;
        if (($username2Find) == "") {
            $result = "Username field is void";
        } else {
            $userFound = $this->model->searchUserByUsername($username2Find);
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
        $data['username2'] = $username2Find;
        //show the template with the given data.
        $this->view->show("form-users.php", $data);
    }

    public function doAddUser()
    {
        $user = UserFormValidation::getData();
        $result = null;
        if (is_null($user)) {
            $result = "User already exists";
        } elseif ($user->getUsername() == '' || $user->getPassword() == '' || $user->getAge() == 0 ) {
            $result = "Please enter a valid data";
        }else {
            $numAffected = $this->model->addUser($user);
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
}