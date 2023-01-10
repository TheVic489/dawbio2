<?php
require_once "model/User.php";
/**
 *  DAO for user persistence in file.
 *
 * @author ProvenSoft
 */
class UserPersistFileDao {

    /**
     * the path to file.
     */
    private string $filename;
    /**
     * the delimiter used to split fields.
     */
    private string $delimiter;

    public function __construct(string $filename, string $delimiter) {
        $this->filename = $filename;
        $this->delimiter = $delimiter;       
    }
    
    /**
     * selects all objects.
     * @return array with all fields.
     */
    public function selectAll(): array {
        $objList = array();  //array to return.
        $handle = fopen($this->filename, "rb");  //open file to read.
        if ($handle !== false) { //if open.
            while (($fields = fgetcsv($handle, 0,  $this->delimiter)) !== false) { //read a csv line into array of fields.
                //instanciate an object with given data.
                $obj = $this->fromFieldsToObj($fields);
                //add object to array.
                array_push($objList, $obj);
            }
            fclose($handle);
        }
        return $objList;
    }

     /**
     * inserts a new object in file.
     * @param $obj the object to insert.
     * @return number of objects written.
     */
    public function insert(User $obj): int {
        $handle = fopen($this->filename, "ab");  //open file to read.
        //convert object to csv.
        $success = fputcsv($handle, (array) $obj, $this->delimiter);
        fclose($handle);
        return ($success) ? 1 : 0;
    }

    /**
     * converts array to object
     * @param $fields the fields to convert to object.
     * @return object or null in case of error.
     */
    protected function fromFieldsToObj(array $fields): ?User {
        
        $username = $fields[0];
        $password = $fields[1];
        $age = intval($fields[2]);
        $obj = new User($username, $password, $age);
        return $obj;
    }
    
    /**
     * searches a user with the given username
     * @param string $username the username to search
     * @return user found or null if not found
     */
    public function selectWhereUsername(string $username): ?User {
        $found = null;
        $objList = $this->selectAll();
        foreach ($objList as $u) {
            if ($u->getUsername() === $username) {
                $found = $u;
                break;
            }
        }
        return $found;
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