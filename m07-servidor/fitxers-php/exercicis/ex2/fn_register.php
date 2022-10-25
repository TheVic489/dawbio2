<?php
/**
 * Ex2: Programa que envia un nom d'usuari i una paraula de pas i les afegeix al fitxer d'usuaris.
 * searches username and password in user's file
 * @param string $username the username to search
 * @param string $password the password to search
 * @return string return a message if the users has been created, or if already exist.
 */
function registerUser(string $username, string $password): string {
    $filename = "files/users.txt";
    $delimiter = ":";
    $result = "";
    if (\file_exists($filename) && \is_readable($filename)) {
        $handle = \fopen($filename, 'r+w');  //returns false on error.
        if ($handle) {
            // Iterates all lines
              while (!\feof($handle)) {
                //$line = \fgets($handle);
                fscanf($handle, "%s\n", $line);
                if ($line) {
                    // Check if the username is the sameñ
                    list($usr, $psw) = \explode($delimiter, $line);
                    if ($usr==$username) {
                        $result = '<b>'.$username.'</b>' . ' already exsist!';
                        // throw new Error('This username already exsist');
                        return $result;
                        break;
                    }
                }
            }
            fprintf($handle, "%s%s%s\n", $username, $delimiter, $password);
            $result = 'User succesfuly created.';

            \fclose($handle);            
        }
    }  
    return $result;
}

