<?php
// require_once 'model/User.php';

/**
 * Description of ItemFormValidation
 * Provides validation to get data from item form.
 * @author ProvenSoft
 */
class LoginFormValidation {
    
    /**
     * validates and gets data from item form.
     * @return array the item with the given data or null if data is not present and valid.
     */
    public static function getData() {
        $loginarray = null;

        $username = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_POST, 'username')) {
            $username = filter_input(INPUT_POST, 'username'); 
            $username = trim($username);
        }
        $password = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_POST, 'password')) {
            $password = filter_input(INPUT_POST, 'password'); 
            $password = trim($password);
        }
        $loginarray = array($username,$password);
        //}
        return $loginarray;
    }
    
}