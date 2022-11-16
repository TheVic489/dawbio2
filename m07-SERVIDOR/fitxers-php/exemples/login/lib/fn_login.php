<?php
/**
 * searches username and password in user's file
 * @param string $username the username to search
 * @param string $password the password to search
 * @return bool true if credentials are found, false otherwise
 */
function chekCredentials(string $username, string $password): bool {
    $filename = "files/users.txt";
    $delimiter = ":";
    $result = false;
    if (\file_exists($filename) && \is_readable($filename)) {
        $handle = \fopen($filename, 'r');  //returns false on error.
        if ($handle) {
            while (!\feof($handle)) {
                //$line = \fgets($handle);
                fscanf($handle, "%s\n", $line);
                if ($line) {
                    list($usr, $psw) = \explode($delimiter, $line);
                    if (($usr==$username) && ($psw==$password)) {
                        $result = true;
                        break;
                    }
                }
            }
            \fclose($handle);            
        }
    }  
    return $result ;
}

