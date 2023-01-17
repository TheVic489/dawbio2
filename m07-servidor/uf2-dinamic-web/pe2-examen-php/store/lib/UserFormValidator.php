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

        $age = 0;
        if (filter_has_var(INPUT_POST, 'age')) {
            $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT); 
        }

        
        if ((!$dao->repeatedUsername($username))) { 
            $UserObj = new User($username, $password, $age);
        
        }else{
            // User already exists
            $UserObj = null;
        }
        return $UserObj;
    }
    /**
     * Get if from form and returns it
     * @return int $id
     */
    public static function getUsername2Find() {
        $username = "";
        if (filter_has_var(INPUT_POST, 'username')) {
            $username = filter_input(INPUT_POST, 'username'); 
        }
        return $username;
    }

    /**
     * gets data from User form with no validation
     * @return User User
     */
    public static function getDataForm(): User|null {

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

        $age = 0;
        if (filter_has_var(INPUT_POST, 'age')) {
            $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT); 
        }

        //they exists and they are not empty
        $UserObj = new User($username, $password, $age);
        
        return $UserObj;
    }
}