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
    public function selectAll(): array
    {
        $objList = array(); //array to return.
        $handle = fopen($this->filename, "rb"); //open file to read.
        
        if ($handle !== false) { //if open.
            while (($fields = fgetcsv($handle, 0, $this->delimiter)) !== false) { //read a csv line into array of fields "line".
                //instanciate an object with given data.
                $obj = $this->fromFieldsToObj($fields);
                //add object to array.
                array_push($objList, $obj);
            }
            fclose($handle);
        }
        return $objList;
    }
    public function getLastId(): int
    {
        $id = 0;
        $usersList = $this->selectAll();
        foreach ($usersList as $user) {
            if ($user->getId() > $id) {
                $id = $user->getId();
            }
        }
        return $id;
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
        $handle = fopen($this->filename, "wb"); //open file to read.
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
        $handle = fopen($this->filename, "ab"); //open file to read.
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
    public function delete(User $obj): int
    {
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
    private function arraySearchIndex(array $list, User $obj): int
    {
        $index = -1;
        for ($i = 0; $i < count($list); $i++) {
            if ($list[$i]->getId() == $obj->getId()) {
                $index = $i;
            }
        }
        return $index;
    }

    /**
     * converts array to object
     * @param $fields array, the fields to convert to object.
     * @return object or null in case of error.
     */
    protected function fromFieldsToObj(array $fields): ?User
    {
        $id       = intval($fields[0]);
        $username = $fields[1];
        $password = $fields[2];
        $role     = $fields[3];
        $name     = $fields[4];
        $surname  = $fields[5];
        $obj = new User($id, $username, $password, $role, $name, $surname);
        return $obj;
    }
    /**
     * Returns the user if exist from given username
     * @param string $username
     * @param string $password
     * @return User|int User if exists user, -1 if do not
     */
    public function getUserbyUsername(string $username): User|int {
        $objList = $this->selectAll();
        $result = -1;
        foreach ($objList as $user) {
            if ($user->getUsername() == $username) {
                $result = $user;
            }
        }
        return $result;
    }
    /**
     * Check from given id if exisist in data source 
     * @param integer $id
     * @return bool true if exisist false if doesn't
     */
    public function repeatedId($id): bool
    {
       $objList = $this->selectAll();
       $result = false;
       foreach ($objList as $user) {
           if ($user->getId() == $id) {
               $result = true;
           }
       }
       return $result;
    }

    /**
     * Check from given username if exisist in data source 
     * @param integer $username
     * @return bool true if exisist false if doesn't
     */
    public function repeatedUsername($username): bool
    {
       $objList = $this->selectAll();
       $result = false;
       foreach ($objList as $user) {
           if ($user->getUsername() == $username) {
               $result = true;
           }
       }
       return $result;
    }
}