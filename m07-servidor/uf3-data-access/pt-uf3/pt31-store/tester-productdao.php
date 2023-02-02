<?php
require_once "lib/Debug.php";
use proven\lib\debug;
use proven\store\model\Product;
debug\Debug::iniset();

require_once "model/persist/ProductDao.php";
require_once "model/Product.php";

use proven\store\model\persist\ProductDao;

$dao = new ProductDao();
//debug\Debug::display($dao->selectAll());
debug\Debug::display($dao->select(new Product(5)));
debug\Debug::display($dao->selectWhere("code", "prodcode03"));
echo($dao->delete(new Product(10, 2, 'prodesc10', 10, 1)));
echo($dao->insert(new Product(10, 10,'descripion', 1, 1)));
echo($dao->update(new Product(10, 2, 'prodesc10', 10, 1)));

// debug\Debug::display($dao->delete(new Product(3)));
// debug\Debug::display($dao->update());

