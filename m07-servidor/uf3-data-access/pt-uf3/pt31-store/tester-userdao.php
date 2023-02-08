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

debug\Debug::printr("Select ");
debug\Debug::display($dao->select(new User(2)));

debug\Debug::printr("Select Where ");
debug\Debug::printr("(found) ");
debug\Debug::display($dao->selectWhere("username", "user05"));
debug\Debug::printr("(not found) void array ");
debug\Debug::printr($dao->selectWhere("username123", "user05"));
debug\Debug::printr("----------------------------");
debug\Debug::printr("Delete ");
echo($dao->insert(new User(0, "peter01", "ppass01", "peter", "frampton", "registered")));
debug\Debug::printr("Insert ");
echo($dao->delete(new User(0, "peter01", "ppass01", "peter", "frampton", "registered")));
debug\Debug::printr("Update ");
echo($dao->update(new User(0, "peter01", "ppass01", "Peter", "Frampton", "registered")));
debug\Debug::printr("----------------------------");

debug\Debug::printr("Select where username and password");

debug\Debug::printr($dao->selectWhereUsernamePassword(new User(0, "peter01", "ppass01")));

debug\Debug::printr("Select where ");
debug\Debug::printr("Success ");
debug\Debug::printr($dao->selectWhere("username", "vic"));
debug\Debug::printr("Not found ");
debug\Debug::printr($dao->selectWhere("username", "vic123"));

//debug\Debug::print_r($dao->delete(new User(7)));
