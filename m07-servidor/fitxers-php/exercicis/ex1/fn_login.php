<?php

/**
 * 
 * @param type $usr the user that the client input
 * @param type $psw the password that the clint input.
 * @return bool Return true if the user,password is in the file.
 */
function checkLogin($usr, $psw): bool
{
    $userPassArray = array();
    $file_open = fopen("./files/users_data.txt", "r"); // Abrir el archivo,
    // Put each line of the file in array(key,value), separated by : 
    if ($file_open) {
        while (!\feof($file_open)) {
            $line = \fgets($file_open);
            if ($line) {
                list($key, $value) = explode(":", $line);
                $userPassArray["$key"] = $value;
            }
        }
    }

    // Check if user exists
    if (array_key_exists($usr, $userPassArray)) {
        // Then check if password match with inserted one.
        if ($userPassArray[$usr] = $psw) {
            // True if exists
            return true;
        } else {
            // False if not
            return false;
        }
    } else {
        return false;
    }
}
