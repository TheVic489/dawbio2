<?php

/**
 * ADT for user.
 *
 * @author ProvenSoft
 */
class User {

    private ?string $username; //UNIQUE
    private ?string $password;
    private ?int $age;

    public function __construct(string $username = null, string $password = null, int $age = null) {
        $this->username = $username;
        $this->password = $password;
        $this->age = $age;
    }

   
    public function getUsername(): ?string {
        return $this->username;
    }

    public function getPassword(): ?string {
        return $this->password;
    }
    
    public function getAge(): ?int {
        return $this->age;
    }
    
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }
    
    public function setAge(?int $age): void {
        $this->age = $age;
    }

    
    public function __toString(): string {
        $result = "User{";
        $result .= sprintf("[username=%s]", $this->username);
        $result .= sprintf("[password=%s]", $this->password);
        $result .= sprintf("[age=%s]", $this->age);
        $result .= "}";
        return $result;
    }

}