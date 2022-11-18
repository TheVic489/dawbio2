<?php
/**
 * Searches username and password in user's file
 * @param string $username the username to search
 * @param string $password the password to search
 * @return array with the data of the user or empty array if dosent find.
 */
function searchUser(string $username, string $password): array {
    $filename = "files/users.txt";
    $delimiter = ";";
    $result = [];
    if (\file_exists($filename) && \is_readable($filename)) {
        $handle = \fopen($filename, 'r');  //returns false on error.
        if ($handle) {
            while (!\feof($handle)) {
                //$line = \fgets($handle);
                fscanf($handle, "%s\n", $line);
                if ($line) {
                    list($usr, $psw, $role, $fname, $lname) = \explode($delimiter, $line);
                    if (($usr==$username) && ($psw==$password)) {
                        $result = [
                            'username' => $usr,
                            'password' => $psw, 
                            'role' => $role, 
                            'fname' => $fname, 
                            'lname' => $lname
                        ];
                        break;
                    }
                }
            }
            \fclose($handle);            
        }
    }  
    return $result;
}

/**
 * Function to register a user
 * @param string $username the username to search
 * @param string $password the password to search
 * @param string $username,
 * @param string $password,
 * @param string $role,
 * @param string $name,
 * @param string $surname
 * @return bool  true if successfuly inserted, false otherwise.
 */
function registerUser(
    string $username,
    string $password,
    string $role,
    string $name,
    string $surname ): bool {
    $filename = "files/users.txt";
    $delimiter = ";";
    if (\file_exists($filename) && \is_readable($filename)) {
        $handle = \fopen($filename, 'r+w');  //returns false on error.
        if ($handle) {
            // Iterates all lines
            while (!\feof($handle)) {
                //$line = \fgets($handle);
                fscanf($handle, "%s\n", $line);
                if ($line) {
                    // Check if the username is the sameñ
                    list($usr, $psw, $rle, $nme, $srname) = \explode($delimiter, $line);
                    if ($usr==$username) {
                        // $result = '<b>'.$username.'</b>' . ' already exsist!';
                        // throw new Error('This username already exsist');
                        return $result = false;
                        break;
                    }
                }
            }
            fprintf($handle, "%s%s%s%s%s%s%s%s%s\n",$username, $delimiter, $password, $delimiter, $role, $delimiter, $name, $delimiter, $surname);

            $result = true;

            \fclose($handle);            
        }
    }  
    return $result;
}

