<?php
require_once 'model/User.php';
require_once 'model/persist/UserPersistFileDao.php';

/**
 * Description of UserFormValidation
 * Provides validation to get data from User form.
 * @author ProvenSoft
 * @author Pau Figueras
 */
class UserFormValidation {
    
    /**
     * validates and gets data from User form.
     * @return User the User with the given data or null if data is not present and valid.
     */
	public static function getData(): User {
		$fileDao = new UserPersistFileDao('files/users.txt', ';');
		$users = $fileDao->selectAll();
        $UserObj = null;
        // $id = $fileDao->getNextId();

        //retrieve id sent by client.
		$id = (filter_has_var(INPUT_POST, 'id')) ? htmlspecialchars($_POST['id']) : throw new Exception("id invalid");
		$username = (filter_has_var(INPUT_POST, 'username')) ? htmlspecialchars($_POST['username']) : throw new Exception("username invalid");
		$password = (filter_has_var(INPUT_POST, 'password')) ? htmlspecialchars($_POST['password']) : throw new Exception("password invalid");
		$name = (filter_has_var(INPUT_POST, 'name')) ? htmlspecialchars($_POST['name']) : throw new Exception("name invalid");
		$surname = (filter_has_var(INPUT_POST, 'surname')) ? htmlspecialchars($_POST['surname']) : throw new Exception("surname invalid");

		// Assure ID is an int
		$id = intval($id);

		if ($id == 0) {
			throw new Exception("id invalid");
		}

		// Validate id and username are unique
		foreach ($users as $user) {
			if ($user->getId() == $id) {
				throw new Exception("ID already exists");
			} else if ($user->getUsername() === $username) {
				throw new Exception("Username already exists");
			}
		}

		$UserObj = new User($id, $username, $password, 'registered', $name, $surname);
        return $UserObj;
    }
    
    /**
	 * retrieves and validates the data from the login form
	 * @return array This array: [username => ..., password => ...]
     */
	public static function getLoginData(): array {
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'username') && filter_has_var(INPUT_POST, 'password')) {
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['password']);
        }
		return ['username' => $username, 'password' => $password];
	}

	/**
	 * Grabs the ID field from the form, and returns that user
	 * @return User matching user by ID
	 */
	public static function getFindData(): User {
		$fileDao = new UserPersistFileDao('files/users.txt', ';');
		if (filter_has_var(INPUT_POST, 'id')) {
			$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
		} else {
			throw new Exception("No ID provided");
		}
		if ($id == 0) {
			throw new Exception("id invalid");
		}

		$user = $fileDao->searchUserById(intval($id));
		if (!is_null($user)) {
			return $user;
		} else {
			throw new Exception("User not found");
		}
	}

	/**
	 * Grabs all form data and builds a user with it or the corresponding exception
	 * @return User A User object from the form data
	 */
	public static function getModDelData(): User {
		// $fileDao = new UserPersistFileDao('files/users.txt', ';');
		$id = (filter_has_var(INPUT_POST, 'id')) ? htmlspecialchars($_POST['id']) : throw new Exception("id invalid");
		$username = (filter_has_var(INPUT_POST, 'username')) ? htmlspecialchars($_POST['username']) : throw new Exception("username invalid");
		$password = (filter_has_var(INPUT_POST, 'password')) ? htmlspecialchars($_POST['password']) : throw new Exception("password invalid");
		$role = (filter_has_var(INPUT_POST, 'role')) ? htmlspecialchars($_POST['role']) : throw new Exception("role invalid");
		$name = (filter_has_var(INPUT_POST, 'name')) ? htmlspecialchars($_POST['name']) : throw new Exception("name invalid");
		$surname = (filter_has_var(INPUT_POST, 'surname')) ? htmlspecialchars($_POST['surname']) : throw new Exception("surname invalid");

		if ($id == 0) {
			throw new Exception("id invalid");
		}

		$updatedUser = new User(intval($id), $username, $password, $role, $name, $surname);
		return $updatedUser;
	}
    
}
