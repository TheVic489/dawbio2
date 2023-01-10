<?php
require_once 'lib/ViewLoader.php';
require_once 'lib/UserFormValidator.php';
require_once 'lib/ProductFormValidator.php';
require_once 'model/Model.php';
require_once 'model/persist/UserPersistFileDao.php';
/**
 * Main controller for store application.
 *
 * @author Pau Figueras
 * @github https://github.com/pswsm
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

    public function processRequest() {
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

	/**
	 * Process GET petitions
	 */
    public function processGET() {
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
                $this->doProductForm();
                break;
            case 'user/form':
                $this->doFormUser();
                break;
            case 'login/form':
                $this->showLoginForm();
                break;
            case 'logout':
                $this->showLogout();
                break;
            default:
                $this->doHomePage();
                break;
        }
    }

	/**
	 * Process POST petitions
	 */
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
            case 'user/add':
                $this->doAddUser();
                break;
            case 'user/login':
                $this->doLoginUser();
				break;
			case 'user/find':
				$this->doFindUser();
				break;
			case 'user/modify':
				$this->doModUser();
				break;
			case 'user/remove':
				$this->doDelUser();
				break;
            case 'product/add':
                $this->doAddProduct();
                break;
			case 'product/find':
				$this->doFindProduct();
				break;
			case 'product/modify':
				$this->doModProduct();
				break;
			case 'product/remove':
				$this->doDelProduct();
				break;
			case 'user/logout':
				$this->doLogout();
				break;
            default:
                $this->doHomePage();
                break;
        }
	}

	#region get methods

	/*
	 * Load home page
	 */
    private function doHomePage() {
        $this->view->show('home.php');
    }

	/*
	 * Load user add, modify and delete form
	 */
    private function doFormUser() {
		if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
			$this->view->show('form-users.php');
		} else {
			$this->view->show('home.php');
		}
	}

    /**
     *  List all users from data source
     */
    private function doListAllUsers() {
		$userList = $this->model->searchAllUsers();
		if (isset($_SESSION['role']) && ($_SESSION['role'] === 'staff' || $_SESSION['role'] === 'admin')) {
			if (!is_null($userList)) {
				$data['userList'] = $userList;
				$this->view->show("list-users.php", $data);
			} else {
				$data['userList'] = array();
				$data['message'] = "Data is null";
				$this->view->show("list-users.php", $data);
			}
		} else {
			$this->view->show('home.php');
		}
	}

    /**
     *  List all products from data source
     */
    private function doListAllProducts() {
		$prodList = $this->model->searchAllProds();
		if (!is_null($prodList)) {
			$data['prodList'] = $prodList;
			$this->view->show("list-products.php", $data);
		} else {
			$data['prodList'] = array();
			$data['message'] = "Data is null";
			$this->view->show("list-products.php", $data);
		}
	}

	/*
	 * Show the login form
	 */
	private function showLoginForm() {
		$this->view->show('login.php');
	}

    /**
     * Displays page with product form
     */
	private function doProductForm() {
		if (isset($_SESSION['role']) && ($_SESSION['role'] === 'staff' || $_SESSION['role'] === 'admin')) {
			$this->view->show('form-products.php');
		} else {
			$this->view->show('home.php');
		}
	}

	/*
	 * Load logout page
	 */
	private function showLogout() {
		if (isset($_SESSION['username'])) {
			$this->view->show('logout.php');
		} else {
			$this->view->show('home.php');
		}
	}

	#endregion get methods

	#region post methods

	/*
	 * Both product and user controllers are essentially the same, wiht minor adaptations
	 */

	/**
	 * Adds a user controller
	 */
    public function doAddUser() {
		try {
			$user = UserFormValidation::getData();
		} catch (Exception $th) {
			$result = $th->getMessage();
		}

		if (isset($result)) {
			$data['result'] = $result;
			$this->view->show('form-users.php', $data);
		} else {
			$numAffected = $this->model->addItem($user);
            if ($numAffected>0) {
                $result = "User successfully added";
            }
			$data['result'] = 'User successfully added';
			$this->view->show('form-users.php', $data);
		}
	}

	/**
	 * Login controller function
	 */
	public function doLoginUser() {
		$loginData = UserFormValidation::getLoginData();
		$loginRes = $this->model->loginUser($loginData['username'], $loginData['password']);
		if (is_int($loginRes)) {
			$params['message'] = ($loginRes === 1) ? 'User not found' : 'Incorrect password';
			$this->view->show('login.php', $params);
		} else {
			$_SESSION['username'] = $loginRes->getUsername();
			$_SESSION['role'] = $loginRes->getRole();
			$this->view->show('home.php');
			header('Location: index.php');
		}
	}


	/**
	 * User finding controller, for the user form
	 */
	public function doFindUser() {
		try {
			$data['user'] = UserFormValidation::getFindData();
		} catch (Exception $ex) {
			$data['result'] = $ex->getMessage();
		}
		$this->view->show('form-users.php', $data);
	}

	/**
	 * User modification controller.
	 * Gets the data from the form and calls model->modUser() with the resulting user as param
	 */
	public function doModUser() {
		try {
			$modUser = UserFormValidation::getModDelData();
			try {
				$altObjs = $this->model->modUser($modUser);
			} catch (Exception $ex) {
				$data['result'] = $ex->getMessage();
				//$this->view->show('form-users.php', $data);
			}
			if ($altObjs > 0) {
				$data['result'] = 'User edited ok.';
			}
		} catch (Exception $ex) {
			$data['result'] = $ex->getMessage();
			//$this->view->show('form-users.php', $data);
		}
		$this->view->show('form-users.php', $data);
	}

	/**
	 * User deletion handle
	 * Gets the data from the form and calls model->delUser() with the resulting user as param
	 */
	public function doDelUser() {
		try {
			$delUser = UserFormValidation::getModDelData();
			try {
				$altObjs = $this->model->delUser($delUser);
			} catch (Exception $ex) {
				$data['result'] = $ex->getMessage();
				//$this->view->show('form-users.php', $data);
			}
			if ($altObjs > 0) {
				$data['result'] = 'User deleted ok.';
			}
		} catch (Exception $ex) {
			$data['result'] = $ex->getMessage();
			//$this->view->show('form-users.php', $data);
		}
		$this->view->show('form-users.php', $data);
	}

	/**
	 * Product addition controller
	 */
    public function doAddProduct() {
		try {
			$prod = ProductFormValidation::getData();
		} catch (Exception $th) {
			$result = $th->getMessage();
		}

		if (isset($result)) {
			$data['result'] = $result;
			$this->view->show('form-products.php', $data);
		} else {
			$numAffected = $this->model->addProduct($prod);
            if ($numAffected>0) {
                $result = "Product successfully added";
            }
			$data['result'] = 'Product successfully added';
			$this->view->show('form-products.php', $data);
		}
	}

	/**
	 * Finds a product from the forms ID
	 */
	public function doFindProduct() {
		try {
			$data['user'] = ProductFormValidation::getFindData();
		} catch (Exception $ex) {
			$data['result'] = $ex->getMessage();
		}
		$this->view->show('form-products.php', $data);
	}

	/**
	 * Product modification controller
	 */
	public function doModProduct() {
		try {
			$modProd = ProductFormValidation::getData();
			try {
				$altObjs = $this->model->modProd($modProd);
			} catch (Exception $ex) {
				$data['result'] = $ex->getMessage();
				//$this->view->show('form-users.php', $data);
			}
			if ($altObjs > 0) {
				$data['result'] = 'Product edited ok.';
			}
		} catch (Exception $ex) {
			$data['result'] = $ex->getMessage();
			//$this->view->show('form-users.php', $data);
		}
		$this->view->show('form-products.php', $data);
	}

	/**
	 * Product deleton controller
	 */
	public function doDelProduct() {
		try {
			$delProd = ProductFormValidation::getData();
			try {
				$altObjs = $this->model->delProd($delProd);
			} catch (Exception $ex) {
				$data['result'] = $ex->getMessage();
				//$this->view->show('form-users.php', $data);
			}
			if ($altObjs > 0) {
				$data['result'] = 'Product deleted ok.';
			}
		} catch (Exception $ex) {
			$data['result'] = $ex->getMessage();
			//$this->view->show('form-users.php', $data);
		}
		$this->view->show('form-products.php', $data);
	}

	/**
	 * Logout controller
	 */
	private function doLogout() {
		$this->view->show('home.php');
		if (isset($_COOKIE["PHPSESSID"])) {
			session_unset();
			session_destroy();
			header("Location: index.php");
		}
	}

	#endregion post methods
}
