<?php
require_once 'model/User.php';

/**
 * Description of ItemFormValidation
 * Provides validation to get data from item form.
 * @author ProvenSoft
 */
class UserFormValidation {
    
    /**
     * validates and gets data from item form.
     * @return User the item with the given data or null if data is not present and valid.
     */
    public static function getData() {
        $userObj = null;
        $id = 0;
        //retrieve id sent by client.
        if (filter_has_var(INPUT_POST, 'id')) {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
        }
        $username = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_POST, 'username')) {
            $username = filter_input(INPUT_POST, 'username'); 
        }
        $password = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_POST, 'password')) {
            $password = filter_input(INPUT_POST, 'password'); 
        }
        $role = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_POST, 'role')) {
            $role = filter_input(INPUT_POST, 'role'); 
        }
        $name = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_POST, 'name')) {
            $name = filter_input(INPUT_POST, 'name'); 
        }
        $surname = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_POST, 'surname')) {
            $surname = filter_input(INPUT_POST, 'surname'); 
        }
        //if (!empty($id) && !empty($title) && !empty($content)) { 
            //they exists and they are not empty
            $userObj = new User($id,$username,$password,$role,$name,$surname);
        //}
        return $userObj;
    }
    
}
