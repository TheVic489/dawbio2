<?php
require_once 'model/User.php';
require_once 'model/persist/UserPersistFileDao.php';

/**
 * Description of UserFormValidation
 * Provides validation to get data from User form.
 * @author Victor
 */
class UserFormValidation {

    /**
     * validates and gets data from User form.
     * @return User|null the User with the given data or null if data is not present and valid.
     */
    public static function getData(): User|null {

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
        $role = "";
        //retrieve User sent by client.
        if (filter_has_var(INPUT_POST, 'role')) {
            $role = filter_input(INPUT_POST, 'role'); 
        }
        $id = 0;
        if (filter_has_var(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
        }

        
        if ((!$dao->repeatedId($id)) && (!$dao->repeatedUsername($username))) { 
            //they exists and they are not empty
            $UserObj = new User($id, $username, $password, $role, $name, $surname);
        
        }else{
            $UserObj = null;
        }
        return $UserObj;
    }
    /**
     * Get if from form and returns it
     * @return int $id
     */
    public static function getId2Find() {
        $id = null;
        if (filter_has_var(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
        }
        return $id;
    }

    public static function getDataForm(): User|null {

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
        $role = "";
        //retrieve User sent by client.
        if (filter_has_var(INPUT_POST, 'role')) {
            $role = filter_input(INPUT_POST, 'role'); 
        }
        $id = 0;
        if (filter_has_var(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
        }

        //they exists and they are not empty
        $UserObj = new User($id, $username, $password, $role, $name, $surname);
        
        return $UserObj;
    }
}