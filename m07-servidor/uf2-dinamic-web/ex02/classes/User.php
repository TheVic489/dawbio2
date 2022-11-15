<?php
// Class User
class User {
    /**
     * class User
     * @param string username
     * @param string password
     */

    public function __construct(private string $username, private string $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setUsername(string $username): string {
        return $this->username = $username;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function __toString() {
        return sprintf("User: {username=%s, password=%s}", 
                $this->username, $this->password);
    }    
}


?>