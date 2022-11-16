<?php
require_once './Speaker.php';

abstract class Animal implements Speaker 
{
    public abstract function talk();
}