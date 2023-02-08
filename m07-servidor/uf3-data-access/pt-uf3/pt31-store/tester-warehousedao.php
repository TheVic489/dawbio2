<?php
require_once "lib/Debug.php";
use proven\lib\debug;
debug\Debug::iniset();
use proven\store\model\Warehouse;

require_once "model/persist/WarehouseDao.php";
require_once "model/Warehouse.php";

use proven\store\model\persist\WarehouseDao;

$dao = new WarehouseDao();
debug\Debug::printr("Select");
debug\Debug::display($dao->select(new Warehouse(5)));
debug\Debug::printr("----------------------------");
debug\Debug::printr("Select all");
debug\Debug::vardump($dao->selectAll());
debug\Debug::printr("----------------------------");

debug\Debug::printr("Select where");
debug\Debug::vardump($dao->selectWhere('product_id', '2'));
debug\Debug::printr("----------------------------");

// debug\Debug::vardump($dao->selectWhere('warehouse_id', '2'));
debug\Debug::printr("delete");
echo($dao->delete(new Warehouse(10, 10, 'address10')));

debug\Debug::printr("(not found)");
echo($dao->delete(new Warehouse(1000, 10, 'address10')));
debug\Debug::printr("----------------------------");

debug\Debug::printr("insert");

echo($dao->insert(new Warehouse(10, 10, 'address10')));
debug\Debug::printr("(not found)");
echo($dao->insert(new Warehouse(1000, 10, 'address10')));

debug\Debug::printr("----------------------------");

debug\Debug::printr("Update");
echo($dao->update(new Warehouse(10, 10, 'address10')));
debug\Debug::printr("(not found)");
echo($dao->update(new Warehouse(100, 10, 'address10')));


//warehouseId ?int
//productid ?int
//stock ?int
