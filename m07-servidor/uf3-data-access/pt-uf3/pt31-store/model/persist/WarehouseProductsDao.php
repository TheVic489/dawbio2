<?php
namespace proven\store\model\persist;

require_once 'model/persist/StoreDb.php';
require_once 'model/WarehouseProducts.php';
require_once 'model/Product.php';

use proven\store\model\persist\StoreDb   as DbConnect;
use proven\store\model\Warehouse;
use proven\store\model\WarehouseProducts as WarehouseProducts;
use proven\store\model\Product as Product;

/**
 * WarehouseProducts database persistence class.
 * @author ProvenSoft
 * 
 * TODO
 */
class WarehouseProductsDao {

    /**
     * Encapsulates connection data to database.
     */
    private DbConnect $dbConnect;
    /**
     * table name for warehouseProducts.
     */
    private static string $TABLE_NAME = 'warehousesproducts';
    /**
     * queries to database.
     */
    private array $queries;
    
    /**
     * constructor.
     */
    public function __construct() { 
        $this->dbConnect = new DbConnect();
        $this->queries = array();
        $this->initQueries();    
    }

    /**
     * defines queries to database.
     */
    private function initQueries() {
        //query definition.
        $this->queries['SELECT_ALL'] = \sprintf(
                "select * from %s", 
                self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_WAREHOUSE_ID'] = \sprintf(
                "select * from %s where warehouse_id = :warehouse_id", 
                self::$TABLE_NAME
        );
        $this->queries['SELECT_WHERE_PRODUCT_ID'] = \sprintf(
            "select * from %s where product_id = :product_id", 
            self::$TABLE_NAME
        );
        $this->queries['INSERT'] = \sprintf(
                "insert into %s (warehouse_id, product_id, stock) values (:warehouse_id, :product_id, :stock)", 
                self::$TABLE_NAME
        );
        $this->queries['UPDATE'] = \sprintf(
                "update %s set warehouse_id = :warehouse_id, product_id = :product_id, stock = :stock where warehouse_id = :warehouse_id", 
                self::$TABLE_NAME
        );
        $this->queries['DELETE'] = \sprintf(
                "delete from %s where warehouse_id = :warehouse_id", 
                self::$TABLE_NAME
        );              
    }

    /**
     * fetches a row from PDOStatement and converts it into an warehouseproduct object.
     * @param $statement the statement with query data.
     * @return WarehouseProducts|false object with retrieved data or false in case of error.
     */
    private function fetchToEntity($statement): mixed {
        $row = $statement->fetch();
        if ($row) {
            $warehouseid = intval($row['warehouse_id']);
            $productid = $row['product_id'];
            $stock = $row['stock'];

            return new WarehouseProducts($warehouseid, $productid, $stock);
        } else {
            return false;
        }
    }    
   
    /**
     * selects all entitites in database.
     * return array of warehouseProducts objects.
     */
    public function selectAll(): ?Array {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_ALL']);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                   //fetch in class mode and get array with all data.                   
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProducts::class);
                    $data = $stmt->fetchAll(); 
                    //or in one single sentence:
                    //$data = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProducts::class);
                    while ($p = $this->fetchToEntity($stmt)) {
                        $data = array_push($data, $p);
                    }
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
           print "Error Message <br>".$e->getMessage();
           print "Stack Trace <br>".nl2br($e->getTraceAsString());
            $data = array();
        }   
        return $data;   
    }
    /**
     * selects WarehouseProduct entity with given product.
     * @param Product $product 
     * @return warehouseProducts object or void array if not finds it.
     */
    public function selectWhereProduct( Product $product): ?array {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_WHERE_PRODUCT_ID']);
            $stmt->bindValue(':product_id', $product->getId(), \PDO::PARAM_INT);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    // //set fetch mode.
                    // $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                    // // get one row at the time
                    // if ($u = $this->fetchToEntity($stmt)){
                    //     $data = $u;
                    // }

                    // $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProducts::class);
                    // $data = $stmt->fetch();

                    while ($u = $this->fetchToEntity($stmt)){
                        // $data = $u;
                        array_push($data,$u);
                    }   
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }

        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getProductId();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $data = null;
        }   
        return $data;
    }

        /**
     * selects WarehouseProduct entity with given warehouse id.
     * @param Warehouse $warehouse object 
     * @return warehouseProducts object.
     */
    public function selectWhereWarehouseId( Warehouse $warehouse): ?WarehouseProducts {
        $data = null;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['SELECT_WHERE_WAREHOUSE_ID']);
            $stmt->bindValue(':warehouse_id', $warehouse->getId(), \PDO::PARAM_INT);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    // //set fetch mode.
                    // $stmt->setFetchMode(\PDO::FETCH_ASSOC);
                    // // get one row at the time
                    // if ($u = $this->fetchToEntity($stmt)){
                    //     $data = $u;
                    // }
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProducts::class);
                    $data = $stmt->fetch();
                } else {
                    $data = null;
                }
            } else {
                $data = null;
            }

        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getProductId();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $data = null;
        }   
        return $data;
    }
    /**
     * selects entitites in database where field value.
     * return array of warehouseProducts objects.
     */
    public function selectWhere(string $fieldname, string $fieldvalue): array {
        $data = array();
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $query = sprintf("select * from %s where %s = '%s'", 
                self::$TABLE_NAME, $fieldname, $fieldvalue);
            $stmt = $connection->prepare($query);
            //query execution.
            $success = $stmt->execute(); //bool
            //Statement data recovery.
            if ($success) {
                if ($stmt->rowCount()>0) {
                    // $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, WarehouseProducts::class);
                    // $data = $stmt->fetchAll(); 

                    while ($u = $this->fetchToEntity($stmt)){
                        // $data = $u;
                        array_push($data,$u);
                    }   

                    // //or in one single sentence:
                    //$data = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'WarehouseProducts');
                } else {
                    $data = array();
                }
            } else {
                $data = array();
            }
        } catch (\PDOException $e) {
//            print "Error Code <br>".$e->getProductId();
//            print "Error Message <br>".$e->getMessage();
//            print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $data = array();
        }   
        return $data;   
    }

    /**
     * inserts a new warehouseProducts in database.
     * @param warehouseProducts the warehouseProducts object to insert.
     * @return number of rows affected.
     */
    public function insert(WarehouseProducts $warehouseProducts): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['INSERT']);
            $stmt->bindValue(':warehouse_id', $warehouseProducts->getWarehouseId(), \PDO::PARAM_STR);
            $stmt->bindValue(':product_id', $warehouseProducts->getProductId(), \PDO::PARAM_STR);
            $stmt->bindValue(':stock', $warehouseProducts->getStock(), \PDO::PARAM_STR);
            //query execution.
            $success = $stmt->execute(); //bool
            $numAffected = $success ? $stmt->rowCount() : 0;
        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getProductId();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $numAffected = 0;
        }
        return $numAffected;
    }

    /**
     * updates warehouseProducts in database.
     * @param warehouseProducts the warehouseProducts object to update.
     * @return number of rows affected.
     */
    public function update(WarehouseProducts $warehouseProducts): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.
            $stmt = $connection->prepare($this->queries['UPDATE']);
            $stmt->bindValue(':warehouse_id', $warehouseProducts->getWarehouseId(), \PDO::PARAM_STR);
            $stmt->bindValue(':product_id', $warehouseProducts->getProductId(), \PDO::PARAM_STR);
            $stmt->bindValue(':stock', $warehouseProducts->getStock(), \PDO::PARAM_STR);
            //query execution.
            $success = $stmt->execute(); //bool
            $numAffected = $success ? $stmt->rowCount() : 0;
        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getProductId();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $numAffected = 0;
        }
        return $numAffected;  
    }

    /**
     * deletes warehouseProducts from database.
     * @param warehouseProducts the warehouseProducts object to delete.
     * @return number of rows affected.
     */
    public function delete(WarehouseProducts $warehouseProducts): int {
        $numAffected = 0;
        try {
            //PDO object creation.
            $connection = $this->dbConnect->getConnection(); 
            //query preparation.            
            $stmt = $connection->prepare($this->queries['DELETE']);
            $stmt->bindValue(':warehouse_id', $warehouseProducts->getWarehouseId(), \PDO::PARAM_INT);
            $success = $stmt->execute(); //bool
            $numAffected = $success ? $stmt->rowCount() : 0;
        } catch (\PDOException $e) {
            // print "Error Code <br>".$e->getProductId();
            // print "Error Message <br>".$e->getMessage();
            // print "Strack Trace <br>".nl2br($e->getTraceAsString());
            $numAffected = 0;
        }
        return $numAffected;        
    }    
    
}
