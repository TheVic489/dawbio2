<?php
require_once "lib/Debug.php";
use proven\lib\debug;
debug\Debug::iniset();

require_once "model/persist/UserDao.php";
require_once "model/User.php";

use proven\store\model\persist\UserDao;
use proven\store\model\User;

$dao = new UserDao();
//debug\Debug::printr($dao->selectAll());
debug\Debug::display($dao->select(new User(2)));
debug\Debug::display($dao->selectWhere("username", "user05"));
echo($dao->delete(new User(0, "peter01", "ppass01", "peter", "frampton", "registered")));
echo($dao->insert(new User(0, "peter01", "ppass01", "peter", "frampton", "registered")));
echo($dao->update(new User(0, "peter01", "ppass01", "Peter", "Frampton", "registered")));

debug\Debug::display($dao->selectWhereUsernamePassword(new User(0, "peter01", "ppass01")));
debug\Debug::vardump($dao->selectWhere("username", "id"));
//debug\Debug::print_r($dao->delete(new User(7)));
