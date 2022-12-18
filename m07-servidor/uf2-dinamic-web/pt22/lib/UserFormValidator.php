<?php
require_once 'model/User.php';
require_once 'model/persist/UserPersistFileDao.php';

/**
 * Description of UserFormValidation
 * Provides validation to get data from User form.
 * @author ProvenSoft
 */
class UserFormValidation {

    /**
     * validates and gets data from User form.
     * @return User the User with the given data or null if data is not present and valid.
     */
    public static function getData() {

        $defaultRole = "registered";
        $UserObj = null;
        $dao = new UserPersistFileDao("files/users.txt" , ";");

        $username = "";
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'username')) {
            $username = filter_input(INPUT_POST, 'username'); 
        }
        $password = "";
        //retrieve User sent by client.
        if (filter_has_var(INPUT_POST, 'password')) {
            $password = filter_input(INPUT_POST, 'password'); 
        }
        $name = "";
        //retrieve User sent by client.
        if (filter_has_var(INPUT_POST, 'name')) {
            $name = filter_input(INPUT_POST, 'name'); 
        }
        $surname = "";
        //retrieve User sent by client.
        if (filter_has_var(INPUT_POST, 'surname')) {
            $surname = filter_input(INPUT_POST, 'surname'); 
        }
        $id = 0;
        if (filter_has_var(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id'); 
        }

        if (!$dao->repeatedId($id)) { 
            //they exists and they are not empty
            $UserObj = new User($id, $username, $password, $defaultRole, $name, $surname);
        
        }else{
            $UserObj = null;
        }
        return $UserObj;
    }
    
}