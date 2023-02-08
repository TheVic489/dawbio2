<?php
require_once "lib/Debug.php";
use proven\lib\debug;
debug\Debug::iniset();

require_once "model/Product.php";
require_once "model/Warehouse.php";
require_once "model/StoreModel.php";

use proven\store\model\StoreModel;
use proven\store\model\Product;
use proven\store\model\Warehouse;

$model = new StoreModel();

debug\Debug::printr("Find user by id");
debug\Debug::printr($model->findUserById(1));
debug\Debug::printr("----------------------------");
debug\Debug::printr("Find Category by ");
debug\Debug::printr("Category Code:");
debug\Debug::printr($model->findCategoryByCatCode('catcode01'));
debug\Debug::printr("ID:");
debug\Debug::printr($model->findCategoryById('1'));
debug\Debug::printr("----------------------------");
debug\Debug::printr("Find Product by ");
debug\Debug::printr("Category Code:");
debug\Debug::printr($model->findProductByCategoryCode('catcode01'));
debug\Debug::printr("Category ID:");
debug\Debug::printr($model->findProductByCatId('catcode01'));
debug\Debug::printr("----------------------------");
debug\Debug::printr("Find Warehouse by ");
debug\Debug::printr("ID:");
debug\Debug::printr($model->findWarehouseById('1'));
debug\Debug::printr("By Product:");
debug\Debug::printr($model->findWarehouseProductbyProduct(new Product(1)));
debug\Debug::printr("----------------------------");
debug\Debug::printr("Find User by id ");
debug\Debug::printr($model->findUserById('1'));