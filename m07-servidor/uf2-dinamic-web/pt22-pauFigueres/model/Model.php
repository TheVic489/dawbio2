<?php
require_once 'lib/ViewLoader.php';
require_once 'persist/UserPersistFileDao.php';
require_once 'persist/ProductPersistFileDao.php';

/**
 * Interaction layer between controller and DAO
 */
class Model
{
    private string $userFile;
    private string $userFileDelimiter;
    private UserPersistFileDao $userDao;
    private ProductPersistFileDao $prodDao;
    
    public function __construct() {
        $this->userFile = "files/users.txt";
        $this->userFileDelimiter = ";";
        $this->prodFile = "files/products.txt";
        $this->prodFileDelimiter = ";";
        $this->userDao = new UserPersistFileDao($this->userFile, $this->userFileDelimiter);
        $this->prodDao = new ProductPersistFileDao($this->prodFile, $this->prodFileDelimiter);
    }

	/**
	 * In contradiction with it's name, it actually is called when adding a User.
	 * @param User $user The user object to add
	 * @return int The number of rows added
	 */
    public function addItem(User $user): int {
        $numAffected = 0;
        if ($user !== null) {
            $numAffected = $this->userDao->insert($user);            
        }
        return $numAffected;
    }

	/**
	 * Wrapper funtion for userDao->searchAllUsers()
	 * Returns an array of all users or null
	 * @return ?array An array of users or null
	 */
    public function searchAllUsers(): ?array {
        $data = $this->userDao->selectAll()??null;
        return $data;
	}

	/**
	 * Handles the interaction between DAO and controller about the login
	 * @param string $username The username
	 * @param string $password The password
	 * @return int User object if login ok, 1 if password incorrect, 2 if username not found
	 */
	public function loginUser(string $username, string $password): User|int {
		$loginResult = $this->userDao->doLogin($username, $password);
		if (!is_int($loginResult)) {
			$loginResult = $this->userDao->select($loginResult);
		}
		return $loginResult;
	}

	/**
	 * Handles the interaction between DAO and controller concerning user editing
	 * @param User The edited user substitute
	 * @return int Number of altered users (normally 1)
	 */
	public function modUser(User $user): int {
		if (is_null($user)) {
			throw new Exception("User not valid");
		} else {
			$alteredElems = $this->userDao->update($user);
		}
		return $alteredElems;
	}

	/**
	 * Handles the interaction between DAO and controller concerning user deletion
	 * @param User The edited user substitute
	 * @return int Number of altered users (normally 1)
	 */
	public function delUser(User $user): int {
		if (is_null($user)) {
			throw new Exception("User not valid");
		} else {
			$alteredElems = $this->userDao->delete($user);
		}
		return $alteredElems;
	}

	/**
	 * Adds the given product
	 * @param Product $prod The product to add
	 * @return int The number of products added
	 */
    public function addProduct(Product $prod): int {
        $numAffected = 0;
        if ($prod !== null) {
            $numAffected = $this->prodDao->insert($prod);            
        }
        return $numAffected;
    }

	/**
	 * Wrapper funtion for prodDao->searchAllProds()
	 * Returns an array of all products or null
	 * @return ?array An array of products or null
	 */
    public function searchAllProds(): ?array {
        $data = $this->prodDao->selectAll()??null;
        return $data;
	}

	/**
	 * Handles the interaction between DAO and controller concerning product editing
	 * @param Product The edited product substitute
	 * @return int Number of altered users (normally 1)
	 */
	public function modProd(Product $prod): int {
		if (is_null($prod)) {
			throw new Exception("User not valid");
		} else {
			$alteredElems = $this->prodDao->update($prod);
		}
		return $alteredElems;
	}

	/**
	 * Handles the interaction between DAO and controller concerning product deletion
	 * @param Product The edited product substitute
	 * @return int Number of altered users (normally 1)
	 */
	public function delProd(Product $prod): int {
		if (is_null($prod)) {
			throw new Exception("User not valid");
		} else {
			$alteredElems = $this->prodDao->delete($prod);
		}
		return $alteredElems;
	}
}
