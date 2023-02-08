<?php
require_once "lib/Debug.php";
use proven\lib\debug;
use proven\store\model\Product;
debug\Debug::iniset();

require_once "model/persist/ProductDao.php";
require_once "model/Product.php";

use proven\store\model\persist\ProductDao;

$dao = new ProductDao();

debug\Debug::printr("Select all");
debug\Debug::display($dao->selectAll());
debug\Debug::printr("----------------------------");
debug\Debug::printr("Select all");

debug\Debug::display($dao->select(new Product(5)));
debug\Debug::printr("----------------------------");
debug\Debug::printr("Select where");
debug\Debug::display($dao->selectWhere("code", "prodcode03"));
debug\Debug::printr("----------------------------");


debug\Debug::printr("Delete sccess");
echo($dao->delete(new Product(10, 2, 'prodesc10', 10, 1)));
debug\Debug::printr("Delete not found");
echo($dao->delete(new Product(100, 2, 'prodesc10', 10, 1)));
debug\Debug::printr("----------------------------");
debug\Debug::printr("Insert sccess");
echo($dao->insert(new Product(10, 10,'descripion', 1, 1)));
debug\Debug::printr("Insert Already Exists");
echo($dao->insert(new Product(10, 10,'descripion', 1, 1)));
debug\Debug::printr("----------------------------");

debug\Debug::printr("Update success");
echo($dao->update(new Product(10, 2, 'prodesc10', 10, 1)));
debug\Debug::printr("----------------------------");



// debug\Debug::display($dao->delete(new Product(3)));
// debug\Debug::display($dao->update());

