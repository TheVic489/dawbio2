<?php
class User {
   private $name;
   private $age;

   function __construct($name, $age) {
       $this->name = $name;
       $this->age = $age;
   }

   function getName() {
       return $this->name;
   }

   function getAge() {
       return $this->age;
   }
   
   function __toString() {
       return sprintf("{User: name=%s, age=%d}", $this->name, $this->age);
   }

}