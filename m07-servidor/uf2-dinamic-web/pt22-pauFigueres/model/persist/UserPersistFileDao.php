<?php
require_once "model/User.php";
/**
 *  DAO for user persistence in file.
 *
 * @author ProvenSoft
 */
class UserPersistFileDao
{

    /**
     * the path to file.
     */
    private string $filename;
    /**
     * the delimiter used to split fields.
     */
    private string $delimiter;

    public function __construct(string $filename, string $delimiter)
    {
        $this->filename = $filename;
        $this->delimiter = $delimiter;
    }

    /**
     * selects all objects.
     * @return array with all fields.
     */
    public function selectAll(): array {
		$objList = array();
		if (is_file($this->filename)) {
			$handle = fopen($this->filename, "r");
			
			if ($handle !== false) {
				while (($fields = fgetcsv($handle, 0, $this->delimiter)) !== false) {
					//instanciate an object with given data.
					$obj = $this->fromFieldsToObj($fields);
					//add object to array.
					array_push($objList, $obj);
				}
				fclose($handle);
			}
		}
        return $objList;
    }

    /**
	 * Reuturns the next ID (highes ID + 1)
	 * @return int The next ID number
     */
	public function getNextId(): int {
		$list = $this->selectAll();
		$id = -1;
		foreach ($list as $user) {
			($user->getId() > $id) ? $id = $user->getId() : $id = $id;
		}
        return $id + 1;
    }

    /**
     * selects object.
     * @param User $obj the object to get from file.
     * @return object from file equal to the given one or null if not found.
     */
    public function select(User $obj): ?User
    {
        $resultObj = null;
        //get all data.
        $objList = $this->selectAll();
        //get position of object.
        $index = $this->arraySearchIndex($objList, $obj);
        if ($index >= 0) { //if found.
            $resultObj = $objList[$index]; //get object.
        }
        return $resultObj;
    }

    /**
     * saves array with all data in file.
     * @param array $data the array to save to file.
     * @return int number of elements written.
     */
    public function saveAll($data): int
    {
        $handle = fopen($this->filename, "w"); //open file to read.
        $count = 0;
        foreach ($data as $obj) {
            //convert object to csv.
            $success = fputcsv($handle, (array) $obj, $this->delimiter);
            $count += ($success) ? 1 : 0;
        }
        fclose($handle);
        return $count;
    }

    /**
     * inserts a new object in file.
     * @param User $obj the object to insert.
     * @return number of objects written.
     */
    public function insert(User $obj): int
    {
        $handle = fopen($this->filename, "a"); //open file to read.
        //convert object to csv.
        $success = fputcsv($handle, (array) $obj, $this->delimiter);
        fclose($handle);
        return ($success) ? 1 : 0;
    }

    /**
     * deletes object from file.
     * @param User $obj the object to delete.
     * @return number of objects deleted.
     */
    public function delete(User $obj): int {
        $result = 0;
        //get all data.
        $objList = $this->selectAll();
        //get object position.
        $index = $this->arraySearchIndex($objList, $obj);
        if ($index >= 0) { //if found.
            array_splice($objList, $index, 1); //remove object.
            $result = 1;
            $this->saveAll($objList); //save list to file.
        }
        return $result;
    }

    /**
     * updates object in file.
     * @param  User $obj the object to update.
     * @return number of objects updated.
     */
    public function update(User $obj): int
    {
        $result = 0;
        //get all data.
        $objList = $this->selectAll();
        //get object position.
        $index = $this->arraySearchIndex($objList, $obj);
        if ($index >= 0) { //if found.
            $objList[$index] = $obj; //replace object.
            $result = 1;
            $this->saveAll($objList); //save list to file.
        }
        return $result;
    }

    /**
     * searches object in array.
     * @param $list array, the array to search in.
     * @param User $obj the object to search.
     * @return int object position or -1 if not found.
     */
    private function arraySearchIndex(array $list, User $obj): int {
        $index = -1;
        for ($i = 0; $i < count($list); $i++) {
            if ($list[$i]->getId() == $obj->getId()) {
                $index = $i;
            }
        }
        return $index;
	}

	/**
	 * Authenticate user
	 *
	 * @param string $username	The username
	 * @param string $password	The password
	 * @return User|int			Returns:
	 * 								User => The user to be logged as
	 * 								1 => Username not found
	 * 								2 => Username OK, password not correct
	 */
	public function doLogin(string $username, string $password): User|int {
		$users = $this->selectAll();
		$userNotFound = false;
		$index = 0;
		$userObj = null;
		do {
			$retCode = 1;
			if ($username == $users[$index]->getUsername()) {
				$retCode = 0;
			}
			if ($retCode == 0 && $password == $users[$index]->getPassword()) {
				$userObj = $users[$index];
				$userNotFound = false;
			}
			$index++;
		} while ($userNotFound || $index < count($users));
		if (is_null($userObj)) {
			return $retCode;
		}
		return $userObj;
	}

	/**
	 * Searches the user by ID
	 * @param int $id The id of the desired User
	 * @return ?User The user or null if not found
	 */
	public function searchUserById(int $id): ?User {
		$users = $this->selectAll();
		$userNotFound = false;
		$index = 0;
		$userObj = null;
		do {
			if ($id == $users[$index]->getId()) {
				$userObj = $users[$index];
			}
			$index++;
		} while ($userNotFound || $index < count($users));
		return $userObj;
	}

	/**
	 * Searches the user by it's username
	 * @param string $username The username of the target User
	 * @return ?User The user or null if not found
	 */
	public function searchUserByUsername(string $username): ?User {
		$users = $this->selectAll();
		$userNotFound = false;
		$index = 0;
		$userObj = null;
		do {
			if ($username === $users[$index]->getUsername()) {
				$userObj = $users[$index];
			}
			$index++;
		} while ($userNotFound || $index < count($users));
		return $userObj;
	}

    /**
     * converts array to object
     * @param $fields array, the fields to convert to object.
     * @return object or null in case of error.
     */
    protected function fromFieldsToObj(array $fields): ?User {
        $id       = intval($fields[0]);
        $username = $fields[1];
        $password = $fields[2];
        $role     = $fields[3];
        $name     = $fields[4];
        $surname  = $fields[5];
        $obj = new User($id, $username, $password, $role, $name, $surname);
        return $obj;
	}
}
