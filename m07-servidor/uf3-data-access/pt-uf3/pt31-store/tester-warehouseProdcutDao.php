<?php
require_once "lib/Debug.php";
use proven\lib\debug;
debug\Debug::iniset();

require_once "model/Product.php";
require_once "model/persist/ProductDao.php";

require_once "model/WarehouseProducts.php";
require_once "model/persist/WarehouseProductsDao.php";

require_once "model/Warehouse.php";
require_once "model/persist/WarehouseDao.php";

use proven\store\model\WarehouseProducts;
use proven\store\model\persist\WarehouseProductsDao;

use proven\store\model\Product;
use proven\store\model\persist\ProductDao;

use proven\store\model\Warehouse;
use proven\store\model\persist\WarehouseDao;


$dao = new WarehouseProductsDao();
// Select all 
//debug\Debug::printr("Select All");
//var_dump($dao->selectAll());

debug\Debug::printr("Select where product");
debug\Debug::printr("Exisisting Product: ");
var_dump($dao->selectWhereProduct(new Product(3)));
debug\Debug::printr("Not found product:");
var_dump($dao->selectWhereProduct(new Product(99)));
debug\Debug::printr("----------------------------");

debug\Debug::printr("Select where Warehouse ID\n");
debug\Debug::printr("Exisisting Warehouse\n");
var_dump($dao->selectWhereWarehouseId(new Warehouse(1)));
debug\Debug::printr("Not found Warehouse:");
var_dump($dao->selectWhereWarehouseId(new Warehouse(99)));
debug\Debug::printr("----------------------------");

debug\Debug::printr("Select where\n");
debug\Debug::printr("Select where Warehouse id = 1\n");
var_dump($dao->selectWhere('warehouse_id', 1));
debug\Debug::printr("Select where stock = 0\n");
debug\Debug::printr("(no data)");
var_dump($dao->selectWhere('stock', 0));
debug\Debug::printr("Select where stock = 21\n");
debug\Debug::printr("(Found data)");
var_dump($dao->selectWhere('stock', 21));

debug\Debug::printr("----------------------------");

debug\Debug::printr("DELETE:");
debug\Debug::printr("--Success:");
echo($dao->delete(new WarehouseProducts(1, 1, 99)));
debug\Debug::printr("--Not found:");
echo($dao->delete(new WarehouseProducts(123, 1, 0)));

debug\Debug::printr("INSERT:");
debug\Debug::printr("--Success:");
echo($dao->insert(new WarehouseProducts(1, 1, 99)));
debug\Debug::printr("--Already exists:");
echo($dao->insert(new WarehouseProducts(1, 1, 99)));

debug\Debug::printr("Update:");
echo($dao->update(new WarehouseProducts(1232, 2, 100)));
    
// debug\Debug::display($dao->select(new WarehouseProducts(5)));
// debug\Debug::vardump($dao->selectWhere('product_id', '2'));
// debug\Debug::vardump($dao->selectWhere('warehouse_id', '2'));
// echo($dao->delete(new WarehouseProducts(10, 10, 'address10')));
// echo($dao->insert(new WarehouseProducts(10, 10, 'address10')));
// echo($dao->update(new WarehouseProducts(10, 10, 'address10')));


//warehouseId ?int
//productid ?int
//stock ?int
