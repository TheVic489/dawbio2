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
//var_dump($dao->selectAll());
//var_dump($dao->selectWhereProductId(new Product(3)));
var_dump($dao->selectWhereWarehouseId(new Warehouse(// echo($dao->delete(new WarehouseProducts(10, 10, 'address10')));
    // echo($dao->insert(new WarehouseProducts(10, 10, 'address10')));
    // echo($dao->update(new WarehouseProducts(10, 10, 'address10')));
    
    
    //warehouseId ?int
    //productid ?int
    //stock ?int
    )));
// debug\Debug::display($dao->select(new WarehouseProducts(5)));
// debug\Debug::vardump($dao->selectWhere('product_id', '2'));
// debug\Debug::vardump($dao->selectWhere('warehouse_id', '2'));
// echo($dao->delete(new WarehouseProducts(10, 10, 'address10')));
// echo($dao->insert(new WarehouseProducts(10, 10, 'address10')));
// echo($dao->update(new WarehouseProducts(10, 10, 'address10')));


//warehouseId ?int
//productid ?int
//stock ?int
